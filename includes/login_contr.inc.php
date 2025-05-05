<?php

declare(strict_types=1); // we let our code have type declaration

function is_input_empty(array $params) {
	foreach ($params as $param) {
		if (empty($param)) {
			return true;
		}
	}
	return false;
}

function is_username_wrong($result) // if we want to except several data types - bool|array $result (works with PHP >=8.0)
{
	return !$result;
}

function is_password_wrong(string $pwd, string $hashedPwd)
{
	return !password_verify($pwd, $hashedPwd);
}