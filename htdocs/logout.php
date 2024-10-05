<?php
    session_start();
    $_SESSION = array();
    session_destroy();
?>

<p>ログアウトしました</p>
<a href="login.php">ログインへ</a>