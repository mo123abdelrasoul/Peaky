<?php
session_start();
$pagetitle = "Members";
include "ini.php";
if (isset($_SESSION['admin'])) {

	$do = '';
	if (isset($_GET['do'])) {
		$do = $_GET['do'];
	} else {
		$do = "Manage";
	}

	if ($do == 'Manage') { // Manage Members Page 

		$stmt = $con->prepare("SELECT * FROM members WHERE groupid = 0 AND status = 1");
		$stmt->execute();
		$members = $stmt->fetchAll();
		$count = $stmt->rowCount();

		if (!empty($members)) { ?>
			<div class="table-response text-center">
				<h1>Manage Members</h1>
				<div class="row col-lg-12 table-row-response">
					<table class="table table-bordered">
						<thead>
							<tr class="table-tr">
								<th>ID</th>
								<th>Image</th>
								<th>Full Name</th>
								<th>Email</th>
								<th>Date</th>
								<th>Control</th>
							</tr>
						</thead>
						<tbody>
							<?php


							foreach ($members as $member) { ?>
								<tr class="table-tr-td">
									<td><?php echo $member['id']; ?></td>
									<?php
									if (!empty($member['image'])) { ?>
										<td>
											<div class="item-img">
												<img src="uploads/images/<?php echo $member['image']; ?>" alt="" decoding="async" loading="lazy">
											</div>
										</td>
									<?php } else { ?>
										<td>
											<div class="item-img">
												<img src="layout/imags/profile-image.jpg" alt="" decoding="async" loading="lazy">
											</div>
										</td>
									<?php } ?>
									<td><?php echo $member['fullname']; ?></td>
									<td><?php echo $member['email']; ?></td>
									<td><?php echo $member['date']; ?></td>
									<td>
										<a class='btn btn-primary' href='members.php?do=Edit&userid=<?php echo $member['id'] ?>'>Edit</a>
										<a class='btn btn-danger' href='members.php?do=Delete&userid=<?php echo $member['id'] ?>'>Delete</a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<a href="members.php?do=Add" class="btn btn-primary newthing">New Member</a>

		<?php
		} else {
		?>
			<div class='alert alert-danger'>There's No Members To Show</div>
		<?php
		}
	} elseif ($do == 'Add') { // Add Members Page 
		?>
		<div class="new">
			<h1 class="text-center head">Add Member</h1>
			<form action="members.php?do=Insert" class="form-horizontal" method="POST" enctype="multipart/form-data">
				<div class="container">
					<div class="posit">
						<!-- Start Name Field -->
						<label class="lab">Name:</label>
						<div class="col-sm-10">
							<input type="text" name="name" class="form-control" required>
						</div>
					</div>
					<!-- End Name Field -->

					<!-- Start Password Field -->
					<div class="posit">
						<label class="">password:</label>
						<div class="col-sm-10">
							<input type="password" name="password" class="form-control" required>
						</div>
					</div>
					<!-- End Password Field -->

					<!-- Start 	Email Field -->
					<div class="posit">
						<label class="lab">Email:</label>
						<div class="col-sm-10">
							<input type="email" name="email" class="form-control" required>
						</div>
					</div>
					<!-- End Email Field -->

					<!-- Start 	Fullname Field -->
					<div class="posit">
						<label class="lab">FullName:</label>
						<div class="col-sm-10">
							<input type="text" name="fullname" class="form-control" required>
						</div>
					</div>
					<!-- End Fullname Field -->

					<!-- Start 	Image Field -->
					<div class="form-group form-group-lg user-add-image">
						<label class="col-sm-2 control-label">User Image</label>
						<div class="col-sm-10">
							<input type="file" name="image" class="form-control" required="required">
						</div>
					</div>
					<!-- End Image Field -->

					<button class="btn btn-primary save">Save</button>
				</div>
			</form>
		</div>
		<?php
	} elseif ($do == 'Insert') { // Insert Members Page 


		if ($_SERVER['REQUEST_METHOD'] == "POST") {
		?>
			<h1 class="text-center">Insert Member</h1>
			<?php

			$name 		= $_POST['name'];
			$password 	= $_POST['password'];
			$hashpass	= sha1($password);
			$email 		= filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
			$fullname 	= $_POST['fullname'];
			$image = $_FILES['image'];

			// Upload Varriables
			$imagename = $image['name'];
			$imagesize = $image['size'];
			$imagetmp  = $image['tmp_name'];
			$imagetype = $image['type'];

			// List Of Allowed File Typed To Upload
			$imageallowedextension = array("jpeg", "jpg", "png");

			// Get Image Extension
			$imageextension = strtolower(end(explode(".", $imagename)));


			$formerrors = [];
			if (empty($name)) {
				$formerrors[] = "<div>The Name Can't Be <strong>Empty</strong></div>";
			}
			if (!empty($name) && strlen($name) < 3) {
				$formerrors[] = "<div>The Name Should Be More Than<strong> 3 Characters</strong></div>";
			}
			if (!empty($name) && strlen($name) > 10) {
				$formerrors[] = "<div>The Name Should Be Less Than<strong> 10 Characters</strong></div>";
			}
			if (empty($password)) {
				$formerrors[] = "<div>The Password Can't Be <strong>Empty</strong></div>";
			}
			if (!empty($password) && strlen($password) < 8) {
				$formerrors[] = "<div>The Password Should Be More Than<strong> 7 Characters</strong></div>";
			}
			if (!empty($password) && strlen($password) > 20) {
				$formerrors[] = "<div>The Password Should Be Less Than<strong> 20 Characters</strong></div>";
			}
			if (empty($email)) {
				$formerrors[] = "<div>The Email Can't Be <strong>Empty</strong></div>";
			}
			if (empty($fullname)) {
				$formerrors[] = "<div>The FullName Can't Be <strong>Empty</strong></div>";
			}
			if (!empty($fullname) && strlen($fullname) < 5) {
				$formerrors[] = "<div>The FullName Should Be More Than<strong> 4 Characters</strong></div>";
			}
			if (!empty($imagename) && !in_array($imageextension, $imageallowedextension)) {
				$formerrors[] = "This Extension Is Not <strong>Allowed</strong>";
			}
			if (empty($imagename)) {
				$formerrors[] = "Image Is <strong>Required</strong>";
			}
			if ($imagesize > 4194304) {
				$formerrors[] = "Image Cant Be Larger Than <strong>4MB</strong>";
			}
			if (!getimagesize($imagetmp)) {
				$formerrors[] = "You Should Upload<strong> Image</strong> Not <strong>File</strong>";
			}

			if (!empty($formerrors)) {
				foreach ($formerrors as $error) {
					$themsg = "<div class='alert alert-danger'>$error</div>";
					redirect($themsg);
				}
			}

			if (empty($formerrors)) {
				$check  = checkMember("name", "members", $name);
				if ($check == 1) {

					$themsg = "<div class='alert alert-danger'>Soory This User Is Exist</div>";
					redirect($themsg);
				} else {

					$image = rand(0, 100000) . '_' . $imagename;
					move_uploaded_file($imagetmp, "uploads\images\\" . $image);

					$stmt = $con->prepare("INSERT INTO 
			`members` (`image` , `name`, `password`, `email`, `fullname`, `groupid`, `status`, `date`)
			VALUES (:zimage, :zname, :zpass, :zemail, :zfull, '0', '1', now())");

					$stmt->execute(array(
						'zimage' => $image,
						'zname' => $name,
						'zpass' => $hashpass,
						'zemail' => $email,
						'zfull' => $fullname
					));
					$count = $stmt->rowCount();

					if ($count > 0) {

						$themsg = "<div class='alert alert-success'>Member Inserted</div>";
						redirect($themsg);
					}
				}
			}
		} else {

			$themsg = "<div class='alert alert-danger'>You Have No Access To This Page</div>";
			echo redirect($themsg);
		}
	} elseif ($do == "Edit") { // Edit Members Page
		if (isset($_GET['userid']) && intval($_GET['userid'])) { ?>
			<div class="new">
				<h1 class="text-center head">Edit Member</h1>
				<?php
				$userid = $_GET['userid'];
				$stmt = $con->prepare("SELECT * FROM members WHERE id = ?");
				$stmt->execute(array($userid));
				$member = $stmt->fetch(); ?>

				<form action="members.php?do=Update" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="container edit-member" style="display:flex">
						<div class="col-lg-8 col-md-9">
							<!-- Start Name Field -->
							<div class="posit">
								<label class="lab">Name:</label>
								<div>
									<input type="text" name="id" value="<?php echo $member['id'] ?>" hidden>
									<input type="text" name="name" class="form-control" value="<?php echo $member["name"]; ?>">
								</div>
							</div>
							<!-- End Name Field -->

							<!-- Start Password Field -->
							<div class="posit">
								<label class="">password:</label>
								<div>
									<input type="password" name="new-password" class="form-control">
									<input type="password" hidden name="password" class="form-control" value="<?php echo $member["password"]; ?>">
								</div>
							</div>
							<!-- End Password Field -->

							<!-- Start Email Field -->
							<div class="posit">
								<label class="lab">Email:</label>
								<div>
									<input type="email" name="email" class="form-control" value="<?php echo $member["email"]; ?>">
								</div>
							</div>
							<!-- End Email Field -->

							<!-- Start Image Field -->
							<?php
							if (empty($member['image']) || isset($_GET['del-image'])) { ?>
								<div class="form-group form-group-lg">
									<label class="col-sm-2 control-label">Add Image:</label>
									<div class="col-sm-12">
										<input type="file" name="image" class="form-control" required="required">
									</div>
								</div>
							<?php }
							?>
							<!-- Start Image Field -->
							<!-- Start Fullname Field -->
							<div class="posit">
								<label class="lab">FullName:</label>
								<div>
									<input type="text" name="fullname" class="form-control" value="<?php echo $member["fullname"]; ?>">
								</div>
							</div>
							<!-- End Fullname Field -->



							<!-- Start Date Field -->
							<div>
								<label class="lab">Date:</label>
								<input type="date" id="date" name="date" class="form-control" value="<?php echo $member["date"]; ?>">
							</div>
							<!-- End Date Field -->

							<!-- Start Groupid Field -->
							<div class="form-group form-group-lg">
								<label class="col-sm-2 control-label">groupid</label>
								<div>
									<div>
										<input id="groupid0" type="radio" name="groupid" value="0" <?php if ($member["groupid"] == 0) {
																										echo "checked";
																									} ?>>
										<label for="groupid0">0</label>
									</div>
									<div>
										<input id="groupid1" type="radio" name="groupid" value="1" <?php if ($member["groupid"] == 1) {
																										echo "checked";
																									} ?>>
										<label for="groupid1">1</label>
									</div>
								</div>
							</div>
							<!-- End Groupid Field -->

							<!-- Start Status Field -->
							<div class="form-group form-group-lg">
								<label class="group">status</label>
								<div>
									<div>
										<input id="status0" type="radio" name="status" value="0" <?php if ($member["status"] == 0) {
																										echo "checked";
																									} ?>>
										<label for="status0">0</label>
									</div>
									<div>
										<input id="status1" type="radio" name="status" value="1" <?php if ($member["status"] == 1) {
																										echo "checked";
																									} ?>>
										<label for="status1 ">1</label>
									</div>
								</div>
							</div>
							<!-- End Status Field -->
							<button class="btn btn-primary save">Save</button>
						</div>
						<?php
						if (!empty($member['image']) && !isset($_GET['del-image'])) { ?>

							<div class="col-lg-4 col-md-3">
								<div class="edit-member-image">
									<img src="uploads/images/<?php echo $member['image'] ?>">

									<!-- Start Image Field -->
									<div class="user-add-image">
										<div class="label-image">
											<label for="image" class="file-label">Edit</label>
											<input type="file" name="image" id="image" class="form-control file-input">
											<a href="members.php?do=Edit&userid=<?php echo $member['id'] ?>&del-image" class="delete-image">Delete</a>
										</div>
										<div>
											<input type="hidden" name="old-image" value="<?php echo $member['image']; ?>" class="hide-imagefile">
										</div>
									</div>
									<!-- End Image Field -->

								</div>
							</div>
						<?php
						}

						if (isset($_GET['del-image'])) {
							$stmt = $con->prepare("UPDATE members SET image = 0 WHERE id = ?");
							$stmt->bindParam(1, $userid, PDO::PARAM_INT);
							$stmt->execute();
							$count = $stmt->rowCount();
							header("Location: members.php?do=Edit&userid=" . $member['id']);
							exit;
						}
						?>
					</div>
				</form>
			</div>
		<?php
		} else {
			$themsg = "There's No Such ID";
			redirect($themsg);
		}
	} elseif ($do == "Update") {	// Update Members Page

		if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
			<h1 class="text-center">Update Member</h1>
			<?php
			$id 		= $_POST['id'];
			$name 		= $_POST['name'];

			if (empty($_POST['new-password'])) {
				$password 	= $_POST['password'];
			} else {
				$password = sha1($_POST['new-password']);
			}

			$email 		= $_POST['email'];
			$fullname 	= $_POST['fullname'];
			$date 		= $_POST['date'];
			$groupid 	= $_POST['groupid'];
			$status 	= $_POST['status'];

			$formerrors = [];

			// Start Image Codes
			if (!empty($_FILES['image']['tmp_name'])) {
				$image = $_FILES['image'];

				// Upload Variables
				$imagename = $image['name'];
				$imagesize = $image['size'];
				$imagetmp = $image['tmp_name'];
				$imagetype = $image['type'];

				// List Of Allowed File Types To Upload
				$imageallowedextension = array("jpeg", "jpg", "png");

				// Get Image Extension
				$extension_array = explode(".", $imagename);
				$imageextension = strtolower(end($extension_array));

				if (!in_array($imageextension, $imageallowedextension)) {
					$formerrors[] = "This Extension Is Not <strong>Allowed</strong>";
				}

				if ($imagesize > 4194304) {
					$formerrors[] = "Image Can't Be Larger Than <strong>4MB</strong>";
				}

				if (!getimagesize($imagetmp)) {
					$formerrors[] = "You Should Upload<strong> Image</strong> Not <strong>File</strong>";
				}

				// Move uploaded file and update image path
				$image = rand(0, 100000) . '_' . $imagename;
				move_uploaded_file($imagetmp, "uploads/images/" . $image);
			} else {
				// No new image provided, retain the old image path
				$image = $_POST['old-image'];
			}
			// End Image Codes


			if (empty($name)) {
				$formerrors[] = "<div>The Name Can't Be <strong>Empty</strong></div>";
			}
			if (!empty($name) && strlen($name) < 3) {
				$formerrors[] = "<div>The Name Should Be More Than<strong> 3 Characters</strong></div>";
			}
			if (!empty($name) && strlen($name) > 10) {
				$formerrors[] = "<div>The Name Should Be Less Than<strong> 10 Characters</strong></div>";
			}
			if (!empty($_POST['new-password']) && strlen($_POST['new-password']) < 8) {
				$formerrors[] = "<div>The Password Should Be More Than<strong> 7 Characters</strong></div>";
			}
			if (!empty($_POST['new-password']) && strlen($_POST['new-password']) > 20) {
				$formerrors[] = "<div>The Password Should Be Less Than<strong> 20 Characters</strong></div>";
			}
			if (empty($email)) {
				$formerrors[] = "<div>The Email Can't Be <strong>Empty</strong></div>";
			}
			if (empty($fullname)) {
				$formerrors[] = "<div>The FullName Can't Be <strong>Empty</strong></div>";
			}
			if (!empty($fullname) && strlen($fullname) < 5) {
				$formerrors[] = "<div>The FullName Should Be More Than<strong> 4 Characters</strong></div>";
			}
			if (empty($date)) {
				$formerrors[] = "<div>The Date Can't Be <strong>Empty</strong></div>";
			}
			if (!empty($formerrors)) {
				foreach ($formerrors as $error) {
			?>
					<div class="alert alert-danger"><?php echo $error; ?><br></div>
<?php
				}
			}
			if (empty($formerrors)) {

				$stmt = $con->prepare("UPDATE 
											members
										SET 
											name = ? ,
											password = ? , 
											email = ? , 
											fullname = ? ,
											image = ? ,
											date = ? ,
											groupid = ? ,
											status = ? 
										WHERE id = ?");

				$stmt->execute(array($name, $password, $email, $fullname, $image, $date, $groupid, $status, $id));
				$themsg = "<div class='alert alert-success'>Member Updated</div>";
				redirect($themsg);
			}
		} else {
			$themsg = "<div class='alert alert-danger'>You Have No Access To This Page</div>";
			redirect($themsg);
		}
	} elseif ($do == "Delete") {

		if (isset($_GET['userid']) && intval($_GET['userid'])) {
			$userid = $_GET['userid'];
			$stmt = $con->prepare("DELETE FROM members WHERE id = ?");
			$stmt->execute(array($userid));
			$count = $stmt->rowCount();
			if ($count > 0) {
				$themsg = "<div class='alert alert-success'>Member Deleted</div>";
				redirect($themsg);
			}
		} else {
			$themsg = "<div class='alert alert-danger'>You Have No Access To This Page</div>";
			redirect($themsg);
		}
	} elseif ($do == "Approve") {

		if (isset($_GET['userid']) && intval($_GET['userid'])) {

			$userid = $_GET['userid'];
			$stmt = $con->prepare("UPDATE members SET status = 1 WHERE id = ?");
			$stmt->execute(array($userid));
			$count = $stmt->rowCount();
			if ($count > 0) {
				$themsg = "<div class='alert alert-success'>Member Approved</div>";
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
