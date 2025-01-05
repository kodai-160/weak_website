<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>セキプロ図書館</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #444;
            margin-top: 20px;
        }

        p {
            max-width: 600px;
            margin: 20px auto;
            text-align: center;
            font-size: 16px;
            line-height: 1.6;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 14px;
        }

        input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #218838;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            text-align: left;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
        }

        th {
            background-color: #f4f4f4;
        }

        .debug-info {
            background-color: #fef3c7;
            padding: 15px;
            margin: 20px auto;
            max-width: 600px;
            border: 1px solid #f5c518;
            border-radius: 8px;
            font-family: monospace;
            font-size: 14px;
            display: none;
        }
    </style>
</head>
<body>
    <h1>セキプロ図書館</h1>
    <p>
        セキプロ図書館へようこそ！<br>
        ユーザ名とパスワードを入力してログインすることで<br>
        借りている本の名前を参照することができます<br>
        試しにユーザ名を<strong>Bob</strong>, パスワードを<strong>ZmlnaHQ</strong>にしてログインしてみよう
    </p>

    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <label for="password">Password:</label>
        <input type="text" name="password" required>
        <input type="submit" value="Login">
    </form>

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
        // echo "<div id='debug-info' class='debug-info'>";
        // echo "<strong>Debug Information:</strong><br>";
        // echo "Submitted Username: " . htmlspecialchars($username) . "<br>";
        // echo "Submitted Password: " . htmlspecialchars($password) . "<br>";
        // echo "Generated SQL Query: " . htmlspecialchars($sql) . "<br>";
        // echo "</div>";

        $result = $mysqli->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "<table>";
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
            echo "<h1 style='text-align: center; color: red;'>Login Failed. Please try again.</h1>";
        }
    }
    ?>
</body>

</html>
