<?php
session_start();
// For Page Header
$pagetitle = "HomePage";
// Include Function And Header And Conn And Translate File and navbar
include "ini.php";

?>

<!-- Start HomePage -->
<div class="container home-page">
    <div class="row begining">
        <div class="col-lg-6 begining-content">
            <p><?php echo lang("WE MAKE"); ?><br><?php echo lang("AWESOME PRODUCTS"); ?><br><?php echo lang("JUST FOR YOU"); ?></p>
            <?php
            $store_lang = isset($_GET['lang']) ? "store.php?lang=" . $_GET['lang'] : "store.php";
            ?>
            <a href="<?php echo $store_lang ?>">
                <button><?php echo lang("Shop Now"); ?></button>
            </a>

        </div>
        <div class="col-lg-6 begining-image">
            <img src="layout/imags/04_Man-1536x1536.png" alt="" decoding="async" loading="lazy">
        </div>
    </div>

    <!-- Start Featured Products -->
    <div class="row feature">
        <h3 class="text-center"><?php echo lang("Feature Products"); ?></h3>
        <?php
        $items = selectquery("*", "items", '', 'LIMIT 9');
        foreach ($items as $item) {
        ?>
            <div class="feature-card col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <div class="feature-image">
                    <?php
                    $store_id_lang = isset($_GET['lang']) ? "store.php?lang=" . $_GET['lang'] . "&id=" . $item['id'] : "store.php?id=" . $item['id'];
                    ?>
                    <a href="<?php echo $store_id_lang ?>">
                        <?php
                        if (empty($item['image'])) { ?>
                            <img src="layout/imags/notfound.png" alt="" decoding="async" loading="lazy">
                        <?php
                        } else { ?>
                            <img src="../admin/uploads/images/products/<?php echo $item['image']; ?>" alt="" class="img-responsive" decoding="async" loading="lazy">
                        <?php } ?>
                    </a>
                    <div class="ferature-price"><?php echo translate_numbers(number_format($item['price'], 2)) . " " . lang("EGP"); ?></div>
                </div>
                <div class="feature-content">
                    <a href="<?php echo $store_id_lang ?>">
                        <p class="feature-name">
                            <?php
                            if (isset($_GET['lang']) && $_GET['lang'] == "ar") {
                                echo $item['translation'];
                            } else {
                                echo $item['name'];
                            } ?>
                        </p>
                        <p>
                            <?php
                            if (isset($_GET['lang']) && $_GET['lang'] == "ar") {
                                echo $item['desc_trans'];
                            } else {
                                echo $item['description'];
                            } ?>
                        </p>
                    </a>
                    <a href="<?php echo $store_id_lang ?>"><?php echo lang("Buy Now"); ?></a>
                </div>
            </div>
        <?php }
        // $jsonData = json_encode($items);
        // header('Content-Type: application/json');
        // echo $jsonData;

        ?>
    </div>
    <!-- End Featured Products -->
</div>
<!-- End HomePage -->



<?php
include "footer.php";
?>