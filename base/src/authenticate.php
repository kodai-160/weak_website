<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$adminUsername = "admin";
	$adminPassword = "adminpass";

	$userUsername = "user";
	$userPassword = "userpass";

	if ($username === $adminUsername && $password === $adminPassword) {
		setcookie("is_Admin", "1", time() + 3600, "/");
        header("Location: result.php");
	} elseif ($username === $userUsername && $password === $userPassword) {
		setcookie("is_Admin", "1", time() + 3600, "/");
        header("Location: result.php");
	} else {
		header("Location: result.php");
	}
}
