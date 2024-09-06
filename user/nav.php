<div class="nav-bar">
	<nav>
		<input type="checkbox" id="check">
		<label for="check" class="checkbtn">
			<i class="fas fa-bars">
    			<?php if (!empty($_SESSION['cart'])) { ?>
					<div class="cart-alert"></div>
				<?php
				}
				?>
            </i>
		</label>
		<?php $nav_lang = isset($_GET['lang']) ? "?lang=" . $_GET['lang'] : ""; ?>
		<label class="logo">
			<a href="home.php<?php echo $nav_lang ?>">
				<img src="layout/imags/Peaky Zone.png" alt="" decoding="async" loading="lazy">
			</a>
		</label>
		<ul>
			<li><a href="home.php<?php echo $nav_lang ?>"><?php echo lang("Home"); ?></a></li>
			<li><a href="store.php<?php echo $nav_lang ?>"><?php echo lang("Store"); ?></a></li>
			<li><a href="about.php<?php echo $nav_lang ?>"><?php echo lang("About Us"); ?></a></li>
			<li><a href="contact.php<?php echo $nav_lang ?>"><?php echo lang("Contact Us"); ?></a></li>
			<li><a class="cart" href="cart.php<?php echo $nav_lang ?>"><i class="fa-solid fa-cart-shopping">
						<?php if (!empty($_SESSION['cart'])) { ?>
							<div class="cart-alert"></div>
						<?php
						}
						?>
				</a></i></li>
			<?php
			if (isset($_GET['lang']) && $_GET['lang'] == "ar") { ?>
				<li class="lang"><a href="?lang=en"><img src="layout/imags/english.png" alt="" decoding="async" loading="lazy"></a></li>
			<?php
			} else { ?>
				<li class="lang"><a href="?lang=ar"><img src="layout/imags/arabic.png" alt="" decoding="async" loading="lazy"></a></li>
			<?php
			}
			?>
		</ul>

	</nav>
</div>

<?php
if (isset($_SESSION['username'])) {
?>

<?php
}
?>