<div class="text-center final-homepage">
    <div class="menu-home">
        <ul>
            <li class="menu"><?php echo lang("Menu"); ?></li>
            <?php
            $home_store_lang = isset($_GET['lang']) && $_GET['lang'] == "ar" ? "?lang=ar" : "";
            ?>
            <a href="home.php<?php echo $home_store_lang ?>">
                <li><?php echo lang("Home"); ?></li>
            </a>
            <a href="store.php<?php echo $home_store_lang ?>">
                <li><?php echo lang("Store"); ?></li>
            </a>
        </ul>
    </div>

    <div class="home-email">
        <h3><?php echo lang("Contact Us"); ?></h3>
        <p>E-MAIL: help@peakyzone.com</p>
    </div>
</div>
<div class="copy-write text-center">
    <p>Copyright © <?php echo date("Y") ?> PeakyZone</p>
</div>
<script src="layout/js/home.js"></script>
</body>

</html>