<?php
session_start();
if (isset($_SESSION['name'])) {
    $username = $_SESSION['name'];
    $msg = 'こんにちは' . htmlspecialchars($username, \ENT_QUOTES, 'UTF-8') . 'さん';
    $link = '<a href="logout.php">ログアウト</a>';
} else {
    $msg = 'ログインしていません';
    $link = '<a href="login.php">ログイン</a>';
}
?>
<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>
