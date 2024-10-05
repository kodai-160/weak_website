<h1>新規登録</h1>
<form action="register.php" method="post">
    <div>
        <label>
            名前:
            <input type="text" name="name" required>
        </label>
    </div>
    <div>
        <label>
            メールアドレス:
            <input type="text" name="mail" required>
        </label>
    </div>
    <div>
        <label>
            パスワード:
            <input type="text" name="password"required>
        </label>
    </div>
    <input type="submit" value="新規登録">
</form>
<p>すでに登録済みの方は<a href=login.php>こちら</a></p>