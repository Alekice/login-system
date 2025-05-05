<?php

declare(strict_types=1); // we let our code have type declaration

function get_user(object $pdo, string $username) {
	$query = "SELECT * FROM users WHERE username = :username;";
	$stmt = $pdo->prepare($query);
	$stmt->bindParam(":username", $username);
	$stmt->execute();

	$result = $stmt->fetch();
	return $result;
}