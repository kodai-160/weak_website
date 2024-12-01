<?php
// セッション開始（クッキーを生成）
session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = "user_" . rand(1000, 9999);
}

// 投稿を保持する
$messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 投稿処理
    if (isset($_POST['name']) && isset($_POST['message'])) {
        $name = $_POST['name'];
        $message = $_POST['message'];

        // エスケープ処理をしない（脆弱性）
        $messages[] = [
            'name' => $name,
            'message' => $message,
        ];
        $_SESSION['messages'] = $messages;
    }
    // クッキー削除処理
    if (isset($_POST['delete_cookie'])) {
        setcookie("PHPSESSID", "", time() - 3600, "/"); // 有効期限を過去に設定
        session_destroy(); // セッションも破棄
        header("Location: " . $_SERVER['PHP_SELF']); // リダイレクトして画面をリフレッシュ
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>脆弱な掲示板</title>
</head>
<body>
    <h1>脆弱な掲示板</h1>
    <p>あなたのクッキー: <?= isset($_COOKIE['PHPSESSID']) ? htmlspecialchars($_COOKIE['PHPSESSID']) : 'クッキーが設定されていません'; ?></p>
    <form method="POST">
        <label for="name">名前:</label>
        <input type="text" name="name" id="name" required><br>
        <label for="message">メッセージ:</label>
        <input type="text" name="message" id="message" required><br>
        <button type="submit">投稿</button>
    </form>
    <form method="POST" style="margin-top: 20px;">
        <button type="submit" name="delete_cookie">クッキーを削除する</button>
    </form>

    <h2>投稿一覧</h2>
    <ul>
        <?php foreach ($messages as $msg): ?>
            <li>
                <strong><?= $msg['name']; ?>:</strong> <?= $msg['message']; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
