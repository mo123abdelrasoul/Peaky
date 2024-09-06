<?php
session_start();
$pagetitle = "Orders";
include "ini.php";

if (isset($_SESSION['admin'])) {

    if (isset($_POST['do'])) {
        $do = $_GET['do'];
    } else {
        $do = "Manage";
    }
    if ($do == "Manage") {
        $stmt = $con->prepare("SELECT * FROM orders");
        $stmt->execute();
        $orders = $stmt->fetchAll();
        if (!empty($orders)) {
?>
            <div class="table-response text-center">
                <h1>Manage Orders</h1>
                <div class="row col-lg-12 table-row-response">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-tr">
                                <th>ID</th>
                                <th>Fullname</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Products</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($orders as $order) { ?>
                                <tr class="table-tr-td">
                                    <td><?php echo $order['id']; ?></td>
                                    <td><?php echo $order['fullname']; ?></td>
                                    <td><?php echo $order['email']; ?></td>
                                    <td><?php echo $order['address']; ?></td>
                                    <td><?php echo $order['phone']; ?></td>
                                    <td><?php echo $order['products']; ?></td>
                                    <td><?php echo $order['total']; ?></td>
                                    <td><?php echo $order['date']; ?></td>
                                    <td>
                                        <?php
                                        if ($order['status'] == 0) { ?>
                                            <div class='delete-order'>
                                                <a href='orders.php?do=Unfinished&orderid= <?php echo $order['id']; ?> ' class='btn btn-primary'>Unfinished</a>
                                                <a href='orders.php?do=Delete&orderid=<?php echo $order['id']; ?> ' class='btn btn-danger'>Delete</a>
                                            </div>

                                        <?php } else { ?>
                                            <div class='delete-order'>
                                                <div class='btn btn-success'>
                                                    Finished
                                                </div>
                                                <a href='orders.php?do=Delete&orderid= <?php echo $order['id']; ?> ' class='btn btn-danger'>
                                                    Delete
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div class='alert alert-danger'>There's No Orders To Show</div>
<?php
        }
    } elseif ($do == "Unfinished") {
        if (isset($_GET['orderid']) && intval($_GET['orderid'])) {
            $orderid = $_GET['orderid'];
            $stmt = $con->prepare("UPDATE orders SET status = 1 WHERE id = ?");
            $stmt->execute(array($orderid));
            $count = $stmt->rowCount();
            if ($count > 0) {
                $themsg = "<div class='alert alert-success'>The Order Has Been Done</div>";
                redirect($themsg);
            }
        }
    } elseif ($do == "Delete") {
        if (isset($_GET['orderid']) && intval($_GET['orderid'])) {
            $orderid = $_GET['orderid'];
            $stmt = $con->prepare("DELETE FROM orders WHERE id = ?");
            $stmt->execute(array($orderid));
            $count = $stmt->rowCount();
            if ($count > 0) {
                $themsg = "<div class='alert alert-success'>The Order Has Been Deleted</div>";
                redirect($themsg);
            }
        }
    }
} else {
    $themsg = "<div class='alert alert-danger'>You Have No Access To This Page</div>";
    redirect($themsg);
}
