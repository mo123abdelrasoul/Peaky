<div class="nav-bar">
	<nav>
		<input type="checkbox" id="check">
		<label for="check" class="checkbtn">
			<i class="fas fa-bars"></i>
		</label>
		<label class="logo"><img src="layout/imags/Peaky Zone.png" alt="" decoding="async" loading="lazy"></label>
		<ul>
			<li><a href="dash.php">Home</a></li>
			<li><a href="members.php">Members</a></li>
			<li><a href="categories.php">Categories</a></li>
			<li><a href="items.php">Items</a></li>
			<li><a href="comments.php">Comments</a></li>
			<li><a href="orders.php">Orders</a></li>
			<?php
			if (isset($_SESSION['admin'])) {
			?>
				<li class="profile-show"><a href="profile.php">My Profile</a></li>
			<?php
			}
			?>
		</ul>
	</nav>
</div>