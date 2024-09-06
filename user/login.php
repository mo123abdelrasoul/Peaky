<?php
session_start();
$pagetitle = 'Login';
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}
include "ini.php";

// check if user coming from http or post request
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $formerrors = [];
    if (empty($email)) {
        $formerrors[] = lang("Empty Email");
    }
    if (empty($password)) {
        $formerrors[] = lang("Empty Password");
    }
    if (!empty($password) && strlen($password) < 8) {
        $formerrors[] = lang("Char Password");
    }
    if (!empty($formerrors)) {

        foreach ($formerrors as $error) {
?>
            <div class="alert alert-danger text-center"><?php echo $error; ?> <br></div>
    <?php
        }
    } else {
        // check if the admin exist in database
        $stmt = $con->prepare("SELECT * FROM members WHERE email = ? AND password = ? AND groupid = 0");
        $stmt->execute(array($email, $password));
        $user = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($count > 0) {
            $_SESSION['username'] = $user['name'];
            $_SESSION['userid'] = $user['id'];
            $_SESSION['image'] = $user['image'];
            $lang_url = isset($_GET['lang']) ? "?lang=" . $_GET['lang'] : "";
            header("refresh:5; url=home.php$lang_url");
            echo "<div class='alert alert-success text-center'>" . lang("login-suc") . "</div>";
            exit();
        } else {
            echo "<div class='alert alert-danger text-center'>" . lang("check-acc-fail") . "</div>";
            $location = isset($_GET['lang']) ? "login.php?lang=" . $_GET['lang'] : "login.php";
            header("Refresh:5; url=$location");
        }
    }
} else {
    ?>
    <div class="login-form">
        <?php
        $condition = isset($_GET['lang']) ? $_SERVER['PHP_SELF'] . "?lang=" . $_GET['lang'] : $_SERVER['PHP_SELF'];
        ?>
        <form action="<?php echo $condition ?>" method="POST">
            <h1><?php echo lang("Login Form") ?></h1>
            <div class="email-login">
                <input type="email" name="email" placeholder="<?php echo lang("Email") ?>" required>
            </div>
            <div class="password">
                <input type="password" name="password" placeholder="<?php echo lang("Password") ?>" required>
            </div>
            <button type="submit"><?php echo lang("Login") ?></button>
            <?php
            $singup_lang = isset($_GET['lang']) ? "signup.php?lang=" . $_GET['lang'] : "signup.php";
            ?>
            <a href="<?php echo $singup_lang ?>"><?php echo lang("SignUp") ?></a>
        </form>
    </div>
<?php
}
include "footer.php";
