<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	setcookie("is_Admin", "1", time() + 3600, "/");
    header("Location: result.php");
} else {
	header("Location: result.php");
}