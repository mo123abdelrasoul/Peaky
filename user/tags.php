<?php
session_start();

$pagetitle = "Tags";
include "ini.php";


if (isset($_GET['name']) && strval($_GET['name'])) {
    $tagname = $_GET['name'];
    $cats = selectquery("name , translate_name , id", "categories");
    $items = selectquery("*", "items", "WHERE tags LIKE '%$tagname%' Or tag_trans LIKE '%$tagname%'");
?>
    <div class="main-store">

        <!-- Start SideBar -->

        <div class="store-sidebar">
            <div class="search-sidebar">
                <form action="">
                    <input type="text" placeholder="<?php echo lang("Search For Products") ?>" id="search-item" onkeyup="search()" autocomplete="off" class="search-input">
                    <button><i class="fas fa-search"></i></button>
                    <div class="search-list" id="search-list">
                        <?php
                        $items_search = selectquery("*", "items");
                        foreach ($items_search as $item) { ?>
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
                $tags = selectquery("tags , tag_trans", "items");
                $string_tags = "";
                foreach ($tags as $tag) {
                    if (isset($_GET['lang']) && $_GET['lang'] == "ar") {
                        $string_tags .= $tag['tag_trans'] . " ";
                    } else {
                        $string_tags .= $tag['tags'] . " ";
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

        <!-- End SideBar -->

        <div class="Store">
            <h1 class="text-center"><?php echo $tagname ?></h1>
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
                        <div class="card-price"><?php echo number_format($item['price'], 2) . lang("EGP"); ?></div>
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
} else {
    echo "<div class='alert alert-danger text-center'>You Should Write Tag Name</div>";
}

include "footer.php";
// End Store Page
