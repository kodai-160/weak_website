<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$userUsername = "admin";
	$userPassword = "admin";

	if ($userUsername === $username && $userPassword === $password) {
		setcookie("is_Admin", "1", time() + 3600, "/");
        header("Location: result.php");
	} else {
		header("Location: result.php");
	}
}
