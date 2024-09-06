<?php

session_start();
$pagetitle = "Comments";
include "ini.php";
if (isset($_SESSION['admin'])) {
    $do = '';
    if (isset($_GET['do'])) {
        $do = $_GET['do'];
    } else {
        $do = "Manage";
    }

    if ($do == 'Manage') { // Manage Members Page 

        $stmt = $con->prepare("SELECT 
                                comments.* , 
                                items.name AS item ,
                                members.name AS member
                            FROM
                                comments
                            INNER JOIN 
                                items
                            ON
                                items.id = comments.item_id
                            INNER JOIN
                                members
                            ON
                                members.id = comments.member_id");
        $stmt->execute();
        $comments = $stmt->fetchAll();
        $count = $stmt->rowCount();
        if (! empty($comments)) { ?>
            <div class="table-response text-center">
                <h1>Manage Comments</h1>
                <div class="row col-lg-12 table-row-response">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-tr">
                                <th>ID</th>
                                <th>Comment</th>
                                <th>Item</th>
                                <th>Mmeber</th>
                                <th>Date</th>
                                <th>Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php


                            foreach ($comments as $comment) { ?>
                                <tr class="table-tr-td">
                                    <td><?php echo $comment['id']; ?></td>
                                    <td><?php echo $comment['comment']; ?></td>
                                    <td><?php echo $comment['item']; ?></td>
                                    <td><?php echo $comment['member']; ?></td>
                                    <td><?php echo $comment['date']; ?></td>
                                    <td>
                                        <a class='btn btn-danger' href='comments.php?do=Delete&commentid=<?php echo $comment['id'] ?>'>Delete</a>
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
            <div class='alert alert-danger'>There's No Comments To Show</div>
<?php
        }
    } elseif ($do == 'Delete') { // Delete Items Page 

        if (isset($_GET['commentid']) && intval($_GET['commentid'])) {
            $commentid = $_GET['commentid'];
            $stmt = $con->prepare("DELETE FROM comments WHERE id = ?");
            $stmt->execute(array($commentid));
            $count = $stmt->rowCount();
            if ($count > 0) {
                $themsg = "<div class='alert alert-success'>Comment Deleted</div>";
                redirect($themsg);
            }
        } else {
            $themsg = "<div class='alert alert-danger'>You Have No Access To This Page</div>";
            redirect($themsg);
        }
    }
} else {
    $themsg = "<div class='alert alert-danger'>You Have No Access To This Page</div>";
    redirect($themsg);
}
