<?php

$pagetitle = "Sign Up";
include "ini.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $con->prepare("SELECT email FROM members WHERE email = '$email'");
    $stmt->execute();
    $check_email = $stmt->rowCount();

    $formerrors = array();

    if (empty($name)) {

        $formerrors[] = lang("Empty Name");
    }
    if (!empty($name) && strlen($name) < 3) {

        $formerrors[] = lang("Char Name");
    }
    if (empty($fullname)) {

        $formerrors[] = lang("Empty Fullname");
    }
    if (!empty($fullname) && strlen($fullname) < 6) {

        $formerrors[] = lang("Char Fullname");
    }
    if (empty($email)) {
        $formerrors[] = lang("Empty Email");
    }
    if ($check_email == 1) {
        $formerrors[] = lang("Email Exist");
    }
    if (empty($password)) {
        $formerrors[] = lang("Empty Password");
    }
    if (!empty($password) && strlen($password) < 8) {
        $formerrors[] = lang("Char Password");;
    }
    if (!empty($formerrors)) {
        foreach ($formerrors as $error) {
?>
            <div class="alert alert-danger text-center"><?php echo $error; ?> <br></div>
    <?php
        }
    } else {
        $stmt = $con->prepare("INSERT INTO 
                                            members (name , password , email , fullname , verify_code, groupid , status , date)
                                            VALUES (:zname , :zpass , :zemail , :zfull , 0, 0 , 1 , NOW())");
        $stmt->execute(array(
            "zname"     => $name,
            "zpass"     => $password,
            "zemail"    => $email,
            "zfull"     => $fullname
        ));
        $count = $stmt->rowCount();
        if ($count > 0) {
            $login_lang_success = isset($_GET['lang']) ? "login.php?lang=" . $_GET['lang'] : "login.php";
            echo "<div class='alert alert-success text-center'>" . lang("suc-msg-login") . "<a href='$login_lang_success'>" . lang("Login") . "</a>" . "</div>";
        }
    }
} else {
    ?>
    <div class="login-form">
        <?php
        $signup_lang = isset($_GET['lang']) ? $_SERVER['PHP_SELF'] . "?lang=" . $_GET['lang'] : $_SERVER['PHP_SELF'];
        ?>
        <form action="<?php echo $signup_lang;  ?>" method="POST">
            <h1><?php echo lang("SignUp") ?></h1>
            <div class="username">
                <input type="text" name="username" placeholder="<?php echo lang("Username") ?>" autocomplete="off" required>
            </div>
            <div class="fullname">
                <input type="text" name="fullname" placeholder="<?php echo lang("Fullname") ?>" autocomplete="off" required>
            </div>
            <div class="email-login">
                <input type="email" name="email" placeholder="<?php echo lang("Email") ?>" autocomplete="off" required>
            </div>
            <div class="password">
                <input type="password" name="password" placeholder="<?php echo lang("Password") ?>" required>
            </div>
            <button type="submit"><?php echo lang("Confirm") ?></button>
            <?php
            $login_lang = isset($_GET['lang']) ? "login.php?lang=" . $_GET['lang'] : "login.php";
            ?>
            <a href="<?php echo $login_lang ?>"><?php echo lang("Login") ?></a>
        </form>
    </div>
    </form>
<?php }
include "footer.php";
?>