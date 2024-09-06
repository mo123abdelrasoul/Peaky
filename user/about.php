<?php
session_start();
$pagetitle = "About Us";

include "ini.php";
?>
<h1 class="text-center about-heading"><?php echo lang("About Us") ?></h1>
<div class="about">
	<div class="content">
		<span><?php echo lang("The Mission") ?></span>
		<p>
			<?php echo lang("About Message 1") ?>____
		</p>
		<div><?php echo lang("About Message 2") ?></div>
	</div>
	<div class="image">
		<img src="layout/imags/arrival-bg.jpg" alt="" decoding="async" loading="lazy">
	</div>
</div>
<div class="clearfix"></div>
<?php
include "footer.php";

?>