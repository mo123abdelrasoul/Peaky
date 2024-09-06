<?php
session_start();
$pagetitle = "Dashboard";
include "ini.php";

if (isset($_SESSION['admin'])) {
?>
    <div class="headline-admin">
        <h1 class="text-center">Dashboard</h1>
    </div>
    <div class="dash-admin">
        <!-- Start Total Members Field -->
        <div class="total-members public-feature">
            <?php
            $stmt = $con->prepare("SELECT * FROM members WHERE groupid = 0");
            $stmt->execute();
            $members = $stmt->rowCount();
            ?>
            <a href="members.php?do=Manage">
                <p>Total Members</p>
                <span><?php echo $members; ?></span>
            </a>
        </div>
        <!-- End Total Members Field -->

        <!-- Start Total Items Field -->
        <div class="total-items public-feature">
            <?php
            $stmt = $con->prepare("SELECT * FROM items");
            $stmt->execute();
            $items = $stmt->rowCount();
            ?>
            <a href="items.php">
                <p>Total Items</p>
                <span><?php echo $items; ?></span>
            </a>
        </div>
        <!-- End Total Items Field -->

        <!-- Start Total Comments Field -->
        <div class="total-comments public-feature">
            <?php
            $stmt = $con->prepare("SELECT * FROM comments");
            $stmt->execute();
            $comments = $stmt->rowCount();
            ?>
            <a href="comments.php">
                <p>Total Comments</p>
                <span><?php echo $comments; ?></span>
            </a>
        </div>
        <!-- End Total Comments Field -->

        <!-- Start Total Orders Field -->
        <div class="total-orders public-feature">
            <?php
            $stmt = $con->prepare("SELECT * FROM orders");
            $stmt->execute();
            $count = $stmt->rowCount();
            ?>
            <a href="orders.php">
                <p>Total Orders</p>
                <span><?php echo $count; ?></span>
            </a>
        </div>
        <!-- End Total Orders Field -->

    </div>
    <!-- Start Total Members Field -->


<?php

} else {
    header("Location:admin.php");
}

include "footer.php";

?>