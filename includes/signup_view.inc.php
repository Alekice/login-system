<?php

declare(strict_types=1); // we let our code have type declaration

function signup_input() {
	if (isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["error_signup"]["username_taken"])) {
		echo '<input type="text" name="username" placeholder="Username" value="' . $_SESSION["signup_data"]["username"] . '">';
	} else {
		echo '<input type="text" name="username" placeholder="Username">';
	}

	echo '<input type="password" name="pwd" placeholder="Password">';

	if (isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["error_signup"]["email_used"]) && !isset($_SESSION["error_signup"]["invalid_email"])) {
		echo '<input type="text" name="email" placeholder="E-Mail" value="' . $_SESSION["signup_data"]["email"] . '">';
	} else {
		echo '<input type="text" name="email" placeholder="E-Mail">';
	}
}

function check_signup_errors() {
	if (isset($_SESSION["error_signup"])) {
		$errors = $_SESSION["error_signup"];

		echo "<br>";

		foreach ($errors as $error) {
			echo '<p class="form-error">' . $error . '</p>';
		}

		unset($_SESSION["error_signup"]); // unset session variable
	} else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
		echo "<br>";
		echo '<p class="form-success">Signup success!</p>';
	}
}