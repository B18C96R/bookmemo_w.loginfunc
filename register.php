<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザ登録画面</title>
</head>
<body>
    <?php
    session_start();
    if (isset($_SESSION['error_message'])) {
        echo '<p style="color:red;">' . $_SESSION['error_message'] . '</p>';
        unset($_SESSION['error_message']); // エラーメッセージをリセット
    }
    ?>
    <form action="register_act.php" method="post">
        <label for="name">名前：</label>
        <input type="text" name="name" required>
        <br>
        <label for="lid">LoginID：</label>
        <input type="text" name="lid" required>
        <br>
        <label for="lpw">パスワード：</label>
        <input type="text" name="lpw" required>
        <br>
        <input type="submit" value="登録">
    </form>
</body>
</html>
