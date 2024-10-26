<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>セキプロ図書館</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="style.css">
	</head>

	<body>
		<h1>セキプロ図書館</h1>
		<p>
			ようこそ！セキプロ図書館へ！！<br>
		    本を借りる場合はログインしてください。ログインするとあなたの借りている本を参照できます。<br>
		</p>
		<form method="POST">
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

<?php
$mysqli = new mysqli("db", "kitsec", "kitsec", "sql_injection1");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    // デバッグ情報の表示
    echo "<div style='background-color: #f0f0f0; padding: 10px; margin: 10px 0; font-family: monospace;'>";
    echo "<strong>Debug Information:</strong><br>";
    echo "Submitted Username: " . htmlspecialchars($username) . "<br>";
    echo "Submitted Password: " . htmlspecialchars($password) . "<br>";
    echo "Generated SQL Query: " . htmlspecialchars($sql) . "<br>";
    echo "</div>";

    $result = $mysqli->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Username</th><th>rentalbook</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
            echo "<td>" . htmlspecialchars($row['rental']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<h1>login Failed. Please try again</h1>";
    }
}