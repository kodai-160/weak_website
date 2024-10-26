<!DOCTYPE html>
<html>

	<head>
		<meta charaset="utf-8">
		<title>セキプロ図書館</title>
		<meta name="viewport" content="width=device-width, inital-scale=1">
		<link rel="stylesheet" href="style.css">
	</head>

	<body>
		<h1>セキプロ図書館</h1>
		<p>ようこそ！セキプロ図書館へ！！</p>
	</body>
</html>
<?php
if (isset($_COOKIE['is_Admin']) && $_COOKIE['is_Admin'] === "0") {
    echo "<h1>Your Flag is kitsec{check_your_cookie_success}</h1>";
} elseif (isset($_COOKIE['isAdmin']) && $_COOKIE['isAdmin'] === "1") {
    echo "<h1>Hello, you are normal user.</h1><br><h1>Try login as a admin!!</h1>";
} else {
    echo "<h1>This is Invalid user. Please login correct user.";
}
?>
