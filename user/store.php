<?php
session_start();

$pagetitle = "Store";
include "ini.php";

// Select The Item Depend On ItemID
if (isset($_GET['id']) && intval($_GET['id'])) {
    $itemid = $_GET['id'];
    $stmt = $con->prepare("SELECT items.* , categories.name AS category_name
                            FROM 
                                items
                        INNER JOIN
                                categories
                        ON 
                            categories.id = items.cat_id
                        WHERE
                            items.id = ?");
    $stmt->execute(array($itemid));
    $item = $stmt->fetch();

    // Start Sesstion Carts Field
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add-cart'])) {

        $id = $_GET['id'];
        $name = $_POST['name'];
        $name_translation = $_POST['nameTranslation'];
        $color = $_POST['color'];
        $size = $_POST['size'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $control = "delete";
        if (isset($_SESSION['cart'])) {

            $item_key = array_search($id, array_column($_SESSION['cart'], 'id'));

            if ($item_key !== false) {
                if ($_SESSION['cart'][$item_key]['color'] == $color && $_SESSION['cart'][$item_key]['size'] == $size) {
                    $_SESSION['cart'][$item_key]['quantity'] += $quantity;
                } else {
                    $item = array(
                        "id" => $id,
                        "img" => '',
                        "name" => $name,
                        "nameTranslation" => $name_translation,
                        "price" => $price,
                        "color" => $color,
                        "size" => $size,
                        "quantity" => $quantity,
                        "control" => $id
                    );
                    $_SESSION['cart'][] = $item;
                    header("Refresh:0");
                }
            } else {
                $session_array_id = array_column($_SESSION['cart'], "id");
                if (!in_array($_GET['id'], $session_array_id)) {

                    $item = array(
                        "id" => $id,
                        "img" => '',
                        "name" => $name,
                        "nameTranslation" => $name_translation,
                        "price" => $price,
                        "color" => $color,
                        "size" => $size,
                        "quantity" => $quantity,
                        "control" => $id
                    );
                    $_SESSION['cart'][] = $item;
                    header("Refresh:0");
                }
            }
        } else {
            $item = array(
                "id" => $id,
                "img" => '',
                "name" => $name,
                "nameTranslation" => $name_translation,
                "price" => $price,
                "color" => $color,
                "size" => $size,
                "quantity" => $quantity,
                "control" => $id
            );

            $_SESSION['cart'][] = $item;
            header("Refresh:0");
        }
    }
    $lang_form_2 = isset($_GET['lang']) ? $_SERVER['PHP_SELF'] . "?lang=" . $_GET['lang'] . "&id=" . $item['id'] : $_SERVER['PHP_SELF'] . "?id=" . $item['id'];
?>
    <form action="<?php echo $lang_form_2 ?>" method="POST" enctype="multipart/form-data">
        <h1 class="text-center item-heading">
            <?php
            if (isset($_GET['lang']) && $_GET['lang'] == "ar") {
                echo $item['translation'];
            } else {
                echo $item['name'];
            } ?>
        </h1>
        <div class="container">
            <div class="row show-item">
                <div class="col-lg-6 col-md-6 image-item">
                    <?php
                    if (empty($item['image'])) { ?>
                        <img src="layout/imags/notfound.png" alt="" decoding="async" loading="lazy">
                    <?php
                    } else {
                    ?>
                        <img src="../admin/uploads/images/products/<?php echo $item['image']; ?>" alt="" class="img-responsive" decoding="async" loading="lazy">
                    <?php } ?>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="item-content">
                        <!-- Start Name Field -->
                        <h3>
                            <?php
                            if (isset($_GET['lang']) && $_GET['lang'] == "ar") {
                                echo $item['translation'];
                            } else {
                                echo $item['name'];
                            } ?>
                        </h3>
                        <input type="hidden" value="<?php echo $item['name']; ?>" name="name">
                        <input type="hidden" value="<?php echo $item['translation']; ?>" name="nameTranslation">
                        <!-- End Name Field -->

                        <!-- Start Description Field -->
                        <p>
                            <?php
                            if (isset($_GET['lang']) && $_GET['lang'] == "ar") {
                                echo $item['desc_trans'];
                            } else {
                                echo $item['description'];
                            }
                            ?>
                        </p>
                        <!-- End Description Field -->

                        <!-- Start Price Field -->
                        <div><i class="fa-solid fa-credit-card"></i> <?php echo lang("Price"); ?>: <?php echo translate_numbers(number_format($item['price'], 2)) ?> <?php echo lang("EGP") ?></div>
                        <input type="hidden" value="<?php echo $item['price']; ?>" name="price">
                        <!-- End Price Field -->

                        <!-- Start Color Field -->
                        <ul>
                            <li class="colors">
                                <i class="fa-solid fa-palette"></i>
                                <span><?php echo lang("Color"); ?></span> :
                                <select name="color" class="color">
                                    <option value="black" class="black"><?php echo lang("Black"); ?></option>
                                    <option value="white" class="white"><?php echo lang("White"); ?></option>
                                    <option value="blue" class="blue"><?php echo lang("Blue"); ?></option>
                                </select>
                            </li>
                            <!-- End Color Field -->

                            <!-- Start Size Field -->
                            <li>
                                <i class="fa-solid fa-shirt"></i>
                                <span><?php echo lang("Size"); ?></span> :
                                <select name="size" class="size">
                                    <option value="M" class="m">M</option>
                                    <option value="L" class="l">L</option>
                                    <option value="XL" class="xl">XL</option>
                                    <option value="XXL" class="xxl">XXL</option>
                                </select>
                                <br>
                                <i class="fa-solid fa-tags"></i>
                                <span class="item-tag"><?php echo lang("Tags") ?>:
                                    <?php if (!empty($item['tags']) && !empty($item['tag_trans'])) {
                                        if (isset($_GET['lang']) && $_GET['lang'] == "ar") {
                                            $all_trans_tags = explode(" ", $item['tag_trans']);
                                            foreach ($all_trans_tags as $tag) {
                                                echo "<a href='tags.php?lang=ar&name=" . strtolower($tag) . "'>" . $tag . '</a>' . "  ";
                                            }
                                        } else {
                                            $all_tags = explode(" ", $item['tags']);
                                            foreach ($all_tags as $tag) {
                                                echo "<a href='tags.php?name=" . strtolower($tag) . "'>" . $tag . '</a>' . "  ";
                                            }
                                        }
                                    } else {
                                        echo lang("No Tag");
                                    }
                                    ?>
                                </span>
                            </li>

                            <!-- End Size Field -->

                            <!-- Start Quantity Field -->
                            <li>
                                <input type="number" name="quantity" class="input-text qty text" value="1" size="4" min="1" max step="1">
                            </li>
                            <input type="submit" value="<?php echo lang("Add To Cart"); ?>" name="add-cart" class="add-cart">
                        </ul>
                        <!-- End Quantity Field -->
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
    $cat_id = $item['cat_id'];
    $item_id = $item['id'];
    $related_items = selectquery("*", "items", "WHERE cat_id = '$cat_id' AND id != '$item_id'", "LIMIT 4");
    if (!empty($related_items)) {

    ?>
        <div class="container main-related">
            <h3 class="text-center"><?php echo lang("Related Products") ?></h3>
            <div class="row">
                <?php

                foreach ($related_items as $item) {
                    $lang_related = isset($_GET['lang']) ? "store.php?lang=" . $_GET['lang'] . "&id=" . $item['id'] : "store.php?id=" . $item['id'];
                ?>

                    <div class="col-lg-3 col-md-6 related-products">
                        <div class="related-image">
                            <a href="<?php echo $lang_related ?>">
                                <img src="../admin/uploads/images/products/<?php echo $item['image'] ?>" alt="" decoding="async" loading="lazy">
                            </a>
                        </div>
                        <div class="related-content">
                            <a href="<?php echo $lang_related ?>">
                                <?php
                                $lang_name = isset($_GET['lang']) && $_GET['lang'] == "ar" ? $item['translation'] : $item['name'];
                                ?>
                                <h5><?php echo $lang_name ?></h5>
                            </a>
                            <a href="<?php echo $lang_related ?>" class="related-button"><?php echo lang("Buy Now") ?></a>
                            <span class="price"><?php echo translate_numbers(number_format($item['price'], 2)) ?> <?php echo lang("EGP") ?></span>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

            </div>
        </div>
        <hr class="hr-item">


        <?php
        // End Sesstion Carts Field

        // Start Comment

        if (isset($_SESSION['username'])) {
        ?>

            <div class="add-comment">
                <h2><?php echo lang("Add Your Comment"); ?></h2>
                <?php
                $lang_form = isset($_GET['lang']) ? $_SERVER['PHP_SELF'] . "?lang=" . $_GET['lang'] . "&id=" . $item['id'] : $_SERVER['PHP_SELF'] . "?id=" . $item['id'];
                ?>
                <form action="<?php echo $lang_form ?>" method="POST">
                    <textarea name="comment" class="form-control" required></textarea>
                    <input type="submit" value="<?php echo lang("Add Comment") ?>" name="add-comment" class="sub-comment">
                </form>
            </div>
            <hr class="hr-item">
            <?php
            if (isset($_POST['add-comment'])) {
                $comment = $_POST['comment'];
                $itemid = $_GET['id'];
                $memberid = $_SESSION['userid'];
                if (empty($comment)) {
                    echo lang("Empty Comment");
                } else {
                    $stmt = $con->prepare("INSERT INTO 
                                        comments(comment , item_id , member_id , date)
                                    VALUES(:zcomment , :zitemid , :zmemberid , NOW())");
                    $stmt->execute(array(
                        'zcomment' => $comment,
                        'zitemid' => $itemid,
                        'zmemberid' => $memberid
                    ));
                    $count = $stmt->rowCount();
                    echo $count;
                }
            }
        } else {
            ?>
            <div class="login-comment">
                <?php echo lang("Please");
                $lang_login = isset($_GET['lang']) ? "login.php?lang=" . $_GET['lang'] : "login.php";
                ?>
                <a href="<?php echo $lang_login ?>"><?php echo lang("Login"); ?></a>
                <?php echo lang("or") ?>
                <a href="<?php echo $lang_login ?>"><?php echo lang("Register"); ?></a>
                <?php echo lang("To Add Comment"); ?>
            </div>

            <hr class="hr-item">

            <!-- Start Show Comment -->
        <?php
        }
        $stmt = $con->prepare("SELECT comments.* , members.name AS member_name , members.image AS member_image
                            FROM comments
                            INNER JOIN 
                                members
                            ON 
                                members.id = comments.member_id
                            WHERE
                                item_id = ?");
        $stmt->Execute(array($itemid));
        $comments = $stmt->fetchAll();
        foreach ($comments as $comment) {
        ?>

            <div class="show-comment">
                <div class="comment-image">
                    <?php
                    if (empty($comment['member_image'])) { ?>
                        <img src="../admin/layout/imags/profile-image.jpg   " alt="">
                    <?php } else { ?>
                        <img class="img-thumbnail" src="../admin/uploads/images/<?php echo $comment['member_image']; ?>" alt="" decoding="async" loading="lazy">
                    <?php } ?>
                </div>
                <div class="comment-content">
                    <div class="comment-member"><?php echo $comment['member_name']; ?></div>
                    <div class="the-comment">
                        <p><?php echo $comment['comment'] ?></p>
                    </div>
                </div>
            </div>
            <hr class="hr-item">
            <div class="clearfix"></div>
        <?php
        }
        ?>
        <!-- End Show Comment -->
    <?php
    // End Comment


    //  Start Main Store Page
} else {
    $cats = selectquery("name , translate_name , id", "categories");
    $items = selectquery("*", "items");
    ?>
        <div class="main-store">
            <div class="store-sidebar">
                <div class="search-sidebar">
                    <form action="">
                        <input type="text" placeholder="<?php echo lang("Search For Products") ?>" id="search-item" onkeyup="search()" autocomplete="off" class="search-input">
                        <button><i class="fas fa-search"></i></button>
                        <div class="search-list" id="search-list">
                            <?php
                            foreach ($items as $item) { ?>
                                <div class="list">
                                    <a href="store.php?id=<?php echo $item['id']; ?>">
                                        <img src="../admin/uploads/images/products/<?php echo $item['image']; ?>" decoding="async" loading="lazy">
                                    </a>
                                    <div class="details">
                                        <a href="store.php?id=<?php echo $item['id']; ?>">
                                            <h2><?php echo $item['name']; ?></h2>
                                            <h3><?php echo $item['price']; ?> <?php echo lang("EGP") ?></h3>
                                        </a>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </form>
                </div>

                <div class="sidebar-category">
                    <h4><?php echo lang("Categories") ?></h4>
                    <ul>
                        <?php
                        if ((isset($_GET['lang']) && $_GET['lang'] == "ar")) {
                            echo "<a href='categories.php?lang=ar&name=" . lang("All") . "'>";
                        } else {
                            echo "<a href='categories.php?name=" . lang("All") . "'>";
                        }
                        ?>

                        <li><?php echo lang("All") ?></li>
                        </a>
                        <?php foreach ($cats as $cat) {
                            if (isset($_GET['lang']) && $_GET['lang'] == "ar") {
                                echo "<a href='categories.php?lang=ar&name=" . $cat['translate_name'] . "&id=" . $cat['id'] . "'><li>" . $cat['translate_name'] . "</li></a>";
                            } else {
                                echo "<a href='categories.php?name=" . $cat['name'] . "&id=" . $cat['id'] . "'><li>" . $cat['name'] . "</li></a>";
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="sidebar-tags">
                    <h4><?php echo lang("Tags") ?></h4>
                    <?php
                    $string_tags = "";
                    foreach ($items as $item) {
                        if (isset($_GET['lang']) && $_GET['lang'] == "ar") {
                            $string_tags .= $item['tag_trans'] . " ";
                        } else {
                            $string_tags .= $item['tags'] . " ";
                        }
                    }
                    $true_tags = array();
                    foreach (explode(" ", $string_tags) as $str_tag) {
                        if (in_array($str_tag, $true_tags)) {
                            $false = $str_tag;
                        } else {
                            $true_tags[] = $str_tag;
                        }
                    }
                    foreach ($true_tags as $tag) {
                        if (!empty($tag)) {
                            if (isset($_GET['lang']) && $_GET['lang'] == "ar") {
                                echo "<div class='tags'><a href='tags.php?lang=ar&name=" . strtolower($tag) . "'>" . $tag . "</a>" . "</div>";
                            } else {
                                echo "<div class='tags'><a href='tags.php?name=" . strtolower($tag) . "'>" . $tag . "</a>" . "</div>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="Store">
                <h1 class="text-center"><?php echo lang("Your Store") ?></h1>
                <?php
                foreach ($items as $item) { ?>
                    <div class="card-item">
                        <div class="card-image">
                            <?php
                            $lang_store = isset($_GET['lang']) ? "store.php?lang=" . $_GET['lang'] . "&id=" . $item['id'] : "store.php?id=" . $item['id'];
                            ?>
                            <a href="<?php echo $lang_store ?>">
                                <?php
                                if (!empty($item['image'])) { ?>
                                    <img src="../admin/uploads/images/products/<?php echo $item['image']; ?>" alt="" decoding="async" loading="lazy">
                                <?php
                                } else { ?>
                                    <img src="layout/imags/notfound.png" alt="" decoding="async" loading="lazy">
                                <?php } ?>
                            </a>
                            <div class="card-price"><?php echo translate_numbers(number_format($item['price'], 2)) . " " . lang("EGP"); ?></div>
                        </div>
                        <div class="card-content">
                            <a href="<?php echo $lang_store ?>">
                                <h3 class="card-name">
                                    <?php
                                    if (isset($_GET['lang']) && $_GET['lang'] == "ar") {
                                        echo $item['translation'];
                                    } else {
                                        echo $item['name'];
                                    } ?>
                                </h3>
                                <p>
                                    <?php
                                    if (isset($_GET['lang']) && $_GET['lang'] == "ar") {
                                        echo $item['desc_trans'];
                                    } else {
                                        echo $item['description'];
                                    } ?>
                                </p>
                            </a>
                            <?php

                            ?>
                            <a href="<?php echo $lang_store ?>" class="buy"><?php echo lang("Buy Now") ?></a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="clearfix"></div>
    <?php

}

include "footer.php";
// End Store Page
