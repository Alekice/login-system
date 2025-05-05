<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$username = $_POST["username"];
	$pwd = $_POST["pwd"];

	try {

		require_once 'dbh.inc.php';
		require_once 'login_model.inc.php';
		require_once 'login_contr.inc.php';

		// Error handlers
		$errors = [];

		if (is_input_empty(['$username' => $username, '$pwd' => $pwd])) {
			$errors["empty_input"] = "Fill in all fields!";
		}

		$result = get_user($pdo, $username);

		if (is_username_wrong($result)) {
			$errors["login_incorrect"] = "Incorrect login info!";
		}
		if (!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"])) { // first check if a user exists and then if theit password is correct
			$errors["login_incorrect"] = "Incorrect login info!";
		}

		require_once 'config_session.inc.php';

		if ($errors) {
			$_SESSION["error_login"] = $errors;

			header("Location: ../index.php");
			die();
		}

		// // We need to regenerate session_id whenever something changes on the website
		// $newSessionId = session_create_id();
		// $sessionId = $newSessionId . "_" . $result["id"]; // create new session id combining with the user's id from DB
		// session_id($sessionId); // set new session id

		$_SESSION["user_id"] = $result["id"];
		$_SESSION["user_username"] = $result["username"];

		$_SESSION["last_regeneration"] = time();

		header("Location: ../index.php?login=success");

		$pdo = null;
		$stmt = null;

		die();

	} catch (PDOException $e) {
		die("Query failed: " . $e->getMessage());
	}

} else {
	header("Location: ../index.php");
	die();
}