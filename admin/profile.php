<?php
session_start();
$pagetitle = "MyProfile";
include "ini.php";
if (isset($_SESSION['admin'])) {
    $stmt = $con->prepare("SELECT * FROM members WHERE groupid = 1 AND name = ?");
    $stmt->execute(array($_SESSION['admin']));
    $admin = $stmt->fetch();
?>

    <header>
        <h1>Admin Profile</h1>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="profile-img">
                    <?php
                    if (empty($admin['image'])) { ?>
                        <img src="layout/imags/profile-image.jpg" alt="" decoding="async" loading="lazy">
                    <?php } else { ?>
                        <img src="uploads/images/<?php echo $admin['image']; ?>" alt="" decoding="async" loading="lazy">
                    <?php } ?>

                </div>
            </div>
            <div class="col-md-7">
                <div class="profile-content">
                    <h3><?php echo $admin['fullname'] ?></h3>
                    <p>Email: <?php echo $admin['email']; ?></p>
                    <p>Role: Administrator</p>
                    <a href="members.php?do=Edit&userid=<?php echo $_SESSION['id']; ?>"><button class="btn btn-primary">Edit Profile</button></a>
                    <a href="logout.php"><button class="btn btn-primary">Logout</button></a>
                </div>
            </div>
        </div>
    </div>



<?php

    if (isset($_SERVER['REQUEST_METHOD']) == "POST") {
        error_reporting(0);
        $adminid = $_POST['adminid'];
        $image = $_FILES['image'];

        // Upload Varriables
        $imagename = $image['name'];
        $imagesize = $image['size'];
        $imagetmp  = $image['tmp_name'];
        $imagetype = $image['type'];

        // List Of Allowed File Typed To Upload
        $imageallowedextension = array("jpeg", "jpg", "png");

        // Get Image Extension
        $imageextension = strtolower(end(explode(".", $imagename)));

        $formerrors = [];
        if (!empty($imagename) && !in_array($imageextension, $imageallowedextension)) {
            $formerrors[] = "This Extension Is Not <strong>Allowed</strong>";
        }
        if (empty($imagename)) {
            $formerrors[] = "Image Is <strong>Required</strong>";
        }
        if ($imagesize > 4194304) {
            $formerrors[] = "Image Cant Be Larger Than <strong>4MB</strong>";
        }
        if (!getimagesize($imagetmp)) {
            $formerrors[] = "You Should Upload<strong> Image</strong> Not <strong>File</strong>";
        }

        if (!empty($formerrors)) {
            foreach ($formerrors as $error) {
                $themsg = "<div class='alert alert-danger'>$error</div>";
                redirect($themsg);
            }
        }

        if (empty($formerrors)) {

            $image = rand(0, 100000) . '_' . $imagename;
            move_uploaded_file($imagetmp, "uploads\images\\" . $image);
            $stmt = $con->prepare("UPDATE members SET image=? WHERE id=?");
            $stmt->execute(array($image, $adminid));
            $imageAdmin = $stmt->rowCount();
            if ($imageAdmin > 0) {
                header("Refresh:0");
            }
        }
    }
} else {
    $themsg = "<div class='alert alert-danger'>You Have No Access To This Page</div>";
    redirect($themsg);
}
