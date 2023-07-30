<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/main.css" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .container {
            max-width: 400px;
            margin: 40px auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
        }
        .btn-primary {
            width: 100%;
        }
        .register-link {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
    </style>
    <title>ログイン</title>
</head>
<body>

<header>
    <!-- <nav class="navbar navbar-light bg-light">LOGIN</nav> -->
</header>

<div class="container">
    <!-- login_act.php は認証処理用のPHPです。 -->
    <form name="form1" action="login_act.php" method="post">
        <div class="form-group">
            <label for="lid">ID:</label>
            <input type="text" class="form-control" name="lid" required>
        </div>
        <div class="form-group">
            <label for="lpw">PW:</label>
            <input type="password" class="form-control" name="lpw" required>
        </div>
        <input type="submit" value="LOGIN" class="btn btn-primary" />
    </form>
    <!-- 会員登録ページへのリンク -->
    <a href="register.php" class="register-link">新規会員登録はこちら</a>
</div>

</body>
</html>
