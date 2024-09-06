<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
$pagetitle = "Cart";
include "ini.php";
ob_start(); // Start output buffering

if (!empty($_SESSION['cart'])) {
?>
    <div class="show-carts">
        <h1 class="text-center"><?php echo lang("My Carts") ?></h1>
        <table>
            <thead>
                <tr>
                    <th><?php echo lang("ID") ?></th>
                    <th><?php echo lang("Image") ?></th>
                    <th><?php echo lang("Product") ?></th>
                    <th><?php echo lang("Price") ?></th>
                    <th><?php echo lang("Color") ?></th>
                    <th><?php echo lang("Size") ?></th>
                    <th><?php echo lang("Quantity") ?></th>
                    <th><?php echo lang("Subtotal") ?></th>
                    <th><?php echo lang("Control") ?></th>
                </tr>
            </thead>
            <tbody>

                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $key => $value) {

                    if (is_array($value)) {

                        echo "<tr>";
                        echo "<td>" . translate_numbers($value['id'], 2) . "</td>";
                        echo "<td>";
                        $item = getvalue("*", "items", "id", $value['id']);
                ?>
                        <div class="image-cart">
                            <?php
                            if (empty($item['image'])) { ?>
                                <div><?php echo lang("No Image") ?></div>
                            <?php } else { ?>
                                <img src="../admin/uploads/images/products/<?php echo $item['image']; ?>" alt="" class="image-member img-responsive" decoding="async" loading="lazy">
                            <?php } ?>
                        </div>
                <?php
                        $subtotal = $value['price'] * $value['quantity'];

                        echo "</td>";
                        echo "<td>";
                        if (isset($_GET['lang']) && $_GET['lang'] == "ar") {
                            echo $value['nameTranslation'];
                        } else {
                            echo $value['name'];
                        }
                        echo "</td>";
                        echo "<td>" . translate_numbers(number_format($value['price'], 2)) . " " . lang("EGP") . "</td>";
                        echo "<td>";
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

                        echo "</td>";
                        echo "<td>" . $value['size'] . "</td>";
                        echo "<td>" . translate_numbers($value['quantity'], 2) . "</td>";
                        echo "<td>" . translate_numbers(number_format($subtotal, 2)) . " " . lang("EGP") . "</td>";
                        echo "<td>";
                        $delete_cart_lang = isset($_GET['lang']) ? "?lang=" . $_GET['lang'] . "&" : "?";
                        echo '<a href="cart.php' . $delete_cart_lang . 'action=delete&id=' . $value['id'] . '&color=' . $value['color'] . '&size=' . $value['size'] . '" class="btn btn-danger show-carts-del">' . lang("Delete") . '</a>';
                        echo "</td>";
                        echo "</tr>";
                    }
                    /*
                    ////////////////// if There's Errors 
*/
                    $total = $total + $subtotal;
                }
                ?>


                <tr>
                    <td colspan="9" class="text-center total">
                        <?php echo lang("Total Price") ?>: <?php if (isset($total)) {
                                                                echo translate_numbers(number_format($total, 2));
                                                            }
                                                            echo " " . lang("EGP") ?></td>
                </tr>
        </table>
    <?php
    $checkout_lang = isset($_GET['lang']) ? "checkout.php?lang=" . $_GET['lang'] : "checkout.php";
    echo '<a href="' . $checkout_lang . '" class="proceed">' . lang("Proceed To Checkout") . '</a>';
} else {
    echo "<div class='empty-card'><div class='alert alert-success text-center'>" . lang("Empty Cart") . "</div></div>";
}
    ?>
    </div>
    <div class='full-height'></div>
    <?php
    if (isset($_SESSION['cart'])) {
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $color = $_GET['color'];
            $size = $_GET['size'];

            foreach ($_SESSION['cart'] as $key => $item) {
                if (is_array($item)) {
                    if ($item['id'] === $_GET['id'] && $item['color'] === $color && $item['size'] === $size) {
                        unset($_SESSION['cart'][$key]);
                        header("Refresh:0");
                        // unset($_SESSION['cart'][$key]); // حذف المنتج المحدد من العربة
                    }
                } else {
                    if ($_SESSION['cart']['id'] === $_GET['id'] && $_SESSION['cart']['color'] === $color && $_SESSION['cart']['size'] === $size) {
                        if ($_SESSION['cart']['id'] == $_GET['id']) {
                            unset($_SESSION['cart'][$key]);
                            header("Refresh:0");
                        }
                        // unset($_SESSION['cart']); // حذف المنتج المحدد من العربة
                    }
                }
            }
        }
    }
    ob_end_flush(); // Send buffered output
    ?>

    <?php
    include "footer.php";
