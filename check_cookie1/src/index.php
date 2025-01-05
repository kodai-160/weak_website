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
		<p>
			ようこそ！セキプロ図書館へ！！<br>
		    本を借りる場合はログインしてください<br>
		</p>
		<form method="POST" action="authenticate.php">
			<label for="username">Username:</label>
			<input type="text" name="username" required>
			<br>
			<label for="password">Password:</label>
			<input type="text" name="password" required>
			<br>
			<input type="submit" value="Login" class="submit-btn">
		</form>
		<br>
	</body>

</html>