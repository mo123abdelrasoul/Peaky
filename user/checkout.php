<?php
session_start();
$pagetitle = "Checkout";
include "ini.php";

// To Check The Email Exist Or Not
// require "validateemail.php";


if (isset($_SESSION['cart'])) {
?>
    <h1 class="text-center check"><?php echo lang("Checkout") ?></h1>

    <div class="container checkout">
        <div class="row">
            <div class="col-lg-4">
                <div class="checkout">
                    <h3><?php echo lang("Billing Details") ?></h3>
                    <hr>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['cart'] as $value) {
                        if (is_array($value)) {
                            foreach ($value as $k => $v) {
                                if (isset($_GET['lang']) && $_GET['lang'] == "ar") {
                                    echo $value['nameTranslation'];
                                } else {
                                    echo $value['name'];
                                }
                                echo "<br>" . $value['size'] .
                                    " x " .  $value['quantity'] .
                                    "<br>" . lang("Color") . " : ";
                                if (isset($_GET['lang']) && $_GET['lang'] == "ar") {
                                    switch ($value['color']) {
                                        case "black":
                                            echo lang("Black");
                                            break;
                                        case "white":
                                            echo lang("White");
                                            break;
                                        case "blue":
                                            echo lang("Blue");
                                            break;
                                    }
                                } else {
                                    echo $value['color'];
                                }

                                echo "<br>" . lang("Price") . " : " . translate_numbers(number_format($value['price'] * $value['quantity'], 2)) . " " . lang("EGP") .
                                    "<hr>";
                                $total = $total + $value['price'] * $value['quantity'];
                                break;
                            }
                        }
                    }
                    ?>
                    <h6><?php echo lang("Shipping") ?> : <strong><?php echo lang("Free") ?></strong></h6>
                    <hr>
                    <h6><?php echo lang("Total") ?> : <?php echo translate_numbers(number_format($total, 2));  ?> <?php echo lang("EGP") ?></h6>
                    <hr>
                    <p><?php echo lang("pay cash") ?></p>
                    <hr>
                        <!--<button id="executeButton">Pay</button>-->
                    <div id="total" data-amount-cents="<?php echo $total * 100; ?>"></div>
                    <?php echo lang("paymob") ?> <button onclick="firststep()">Paymob</button>
                </div>
                <?php
                ?>
            </div>
            <div class="bill-details col-lg-8">
                <h3 class="text-center"><?php echo lang("Personal Data") ?></h3>
                <?php
                $form_lang = isset($_GET['lang']) ? $_SERVER['PHP_SELF'] . "?lang=" . $_GET['lang'] : $_SERVER['PHP_SELF'];
                ?>
                <form action="<?php echo $form_lang ?>" method="POST">
                    <div class="col-lg-6 bill-name col-md-12">
                        <input type="text" name="first-name" placeholder="<?php echo lang("First name") ?>" class="form-control" required>
                    </div>
                    <div class="col-lg-6 bill-name">
                        <input type="text" name="last-name" placeholder="<?php echo lang("Last name") ?>" class="form-control" required>
                    </div>
                    <input type="text" name="street-address" placeholder="<?php echo lang("House number and street name") ?>" class="col-lg-12 form-control" required>
                    <input type="text" name="city" placeholder="<?php echo lang("Town / City") ?>" class="col-lg-12 form-control" required>
                    <input type="text" name="country" placeholder="<?php echo lang("State / Country") ?>" class="col-lg-12 form-control" required>
                    <input type="text" name="phone" placeholder="<?php echo lang("Phone") ?>" class="col-lg-12 form-control" required>
                    <input type="email" name="email" placeholder="<?php echo lang("Email") ?>" class="col-lg-12 form-control" required>
                    <button class="proceed col-lg-12"><?php echo lang("Confirm") ?></button>
                </form>
            </div>
        </div>
    </div>


    <?php } 

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $first      = $_POST['first-name'];
        $last       = $_POST['last-name'];
        $street     = $_POST['street-address'];
        $city       = $_POST['city'];
        $country    = $_POST['country'];
        $phone      = $_POST['phone'];
        $email      = $_POST['email'];

/*
        $mail = new VerifyEmail();
        $mail->setStreamTimeoutWait(2);
        $mail->setEmailFrom("mbdalrswl24@gmail.com");
*/
        $formErrors = [];

        if (empty($first)) {
            $formErrors[] = lang("Empty Firstname");
        }
        if (empty($last)) {
            $formErrors[] = lang("Empty Lastname");
        }
        if (empty($street)) {
            $formErrors[] = lang("Empty Street");
        }
        if (empty($city)) {
            $formErrors[] = lang("Empty City");
        }
        if (empty($country)) {
            $formErrors[] = lang("Empty Country");
        }
        if (empty($phone)) {
            $formErrors[] = lang("Empty Phone");
        }
        if (!empty($phone) && !intval($phone)) {
            $formErrors[] = lang("error-phone-number");
        }
        if (empty($email)) {
            $formErrors[] = lang("Empty Email");
        }
/*
        if ($mail->check($email)) {
            echo "";
        } else {
            $formErros[] = lang("check-msg-fail");
        }
*/
        if (!empty($formErrors)) {
            foreach ($formErrors as $error) {
                echo "<div class='alert alert-danger'>" . $error . "</div>";
            }
        }else {
            $total = 0;
            $product = '';
            foreach ($_SESSION['cart'] as $key => $value) {
                $product .= $value['name'] . "-" . $value['color'] . "," . $value['size'] . " x " . $value['quantity'] . " , " . ($value['price'] * $value['quantity']) . " EGP +";
                $total = $total + ($value['price'] * $value['quantity']);
            }
            
            $stmt = $con->prepare("INSERT INTO orders(fullname, email, address, phone, products, total, date) 
                                VALUES(:zfull, :zemail, :zaddress, :zphone, :zproduct, :ztotal, NOW())");

            $stmt->execute(array(
                'zfull' => $first . " " . $last,
                'zemail' => $email,
                'zaddress' => $street . "," . $city . "," . $country,
                'zphone' => $phone,
                'zproduct' => $product, 
                'ztotal' => $total
            ));

            $count = $stmt->rowCount(); // عدد الصفوف التي تأثرت بالاستعلام

            if ($count > 0) {
                echo "<div class='alert alert-success text-center'>" . lang("check-msg-suc") . "</div>";
            } else {
                echo "Failed to insert data";
            }
                        
        }
    }

    include "footer.php";