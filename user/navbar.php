<div class="nav-bar">
	<div class="container">
		<input type="checkbox" id="check">
		<label for="check" class="checkbtn">
			<i class="fa-solid fa-bars"></i>
		</label>
		<div class="brand-image">
			<img src="layout/imags/Peaky Zone.png" alt="">
		</div>
		<ul class="brand-links">
			<li><a href="home.php">Home</a></li>
			<li><a href="store.php">Store</a></li>
			<li><a href="cart.php">Carts</a></li>
		</ul>
		<div class="clearfix"></div>
	</div>
</div>
















<?php
		if(isset($_SESSION['username'])){
?>
			<div class="dropdown">
				<a href="profile.php"><?php echo $_SESSION['username']; ?></a>
				<div class="dropdown-content">
					<a href="members.php?do=Edit&userid=<?php echo $_SESSION['userid']; ?>">Edit Profile</a>
					<a href="#">Setting</a>
					<a href="logout.php">Logout</a>
				</div>
			</div> -->
<?php
		}
?>
		<!-- </div>
	</div>



