<?php
session_start();
// To Send PHP mail
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$pagetitle = "Contact Us";

include "ini.php";
?>

<?php
$msg_sent = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$name = $_POST['fullname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$msg = $_POST['message'];

	$contact_errors = [];
	if (empty($name)) {
		$contact_errors[] = lang("Empty Fullname");
	}
	if (strlen($name) < 3) {
		$contact_errors[] = lang("Char Fullname");
	}
	if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
		$contact_errors[] = lang("Fullname letter");
	}
	if (empty($email)) {
		$contact_errors[] = lang("Empty Email");
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$contact_errors[] = lang("Invalid Email");
	}
	if (empty($phone)) {
		$contact_errors[] = lang("Empty Phone");
	}
	if (!preg_match('/^[0-9]{11}+$/', $phone)) {
		$contact_errors[] = lang("Invalid Phone");
	}
	if (empty($msg)) {
		$contact_errors[] = lang("Empty Message");
	}
	if (strlen($msg) > 70) {
		$contact_errors[] = lang("Char Message");
	}

	if (!empty($contact_errors)) {
		foreach ($contact_errors as $error) {
			echo "<div class='alert alert-danger text-center'>" . $error . "</div>";
		}
	} else {
		$body = "";
		$body .= "From: " . $name . " \r\n";
		$body .= "Email: " . $email . " \r\n";
		$body .= "Message: " . $msg . " \r\n";
		mail("mbdalrswl24@gmail.com", "Complain", $body);
		$msg_sent = true;
	}
}

if ($msg_sent == true) {
	echo "<div class='alert alert-success text-center'>" . lang("Message Sent") . "</div>";
} else {
?>
	<div class="map">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3452.1906972750203!2d31.271379025291175!3d30.088724416472857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14583ff3646aae8b%3A0x6fbd87501283b7fc!2z2LTYp9iv2LEg2KfZhNiz2YXZgw!5e0!3m2!1sar!2seg!4v1698043841673!5m2!1sar!2seg" class="responsive-iframe" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	</div>
	<div class="container contact-page">
		<h1 class="text-center"><?php echo lang("Contact Us") ?></h1>
		<div class="contact-form">
			<form action="contact.php" class="form-group" method="POST">
				<div class="fullname col-lg-6">
					<input class="form-control" type="name" name="fullname" placeholder="<?php echo lang("Fullname") ?>" autocomplete="off" required>
				</div>
				<div class="email col-lg-6">
					<input class="form-control" type="email" name="email" placeholder="<?php echo lang("Email") ?>" autocomplete="off" required>
				</div>
				<div class="phone col-lg-6">
					<input class="form-control" type="text" name="phone" placeholder="<?php echo lang("Phone") ?>" autocomplete="off" required>
				</div>
				<div class="message col-lg-6">
					<textarea class="form-control" rows="3" cols="10" placeholder="<?php echo lang("Message") ?>" name="message" autocomplete="off" required></textarea>
				</div>
				<button class="btn btn-danger col-lg-6 col-md-12 col-sm-12 col-xs-12"><?php echo lang("Send Message") ?></button>
			</form>
		</div>
	</div>

<?php };


include "footer.php";

?>