<?php
//0. SESSION開始！！
session_start();

//１．関数群の読み込み
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

// kanri_flgが0の場合は権限がないとしてindex.phpにリダイレクト
if ($_SESSION["kanri_flg"] == 0) {
  header("Location: index.php");
  exit();
}

//２．データ登録SQL作成
$pdo = db_conn();
$stmt = $pdo->prepare("SELECT * FROM gs_an_table");
$status = $stmt->execute();

//３．データ表示
$view = '<table class="table table-striped">';
$view .= '<tr><th>ID</th><th>名前</th><th>Email</th><th>内容</th><th>登録日時</th><th></th><th></th></tr>';
if ($status == false) {
  sql_error($stmt);
} else {
  while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $view .= '<tr>';
    $view .= '<td>' . $r["id"] . '</td>';
    $view .= '<td>' . $r["name"] . '</td>';
    $view .= '<td>' . $r["email"] . '</td>';
    $view .= '<td>' . $r["naiyou"] . '</td>';
    $view .= '<td>' . $r["indate"] . '</td>';
    // $view .= '<td>' . $r["age"] . '</td>';
    $view .= '<td><a href="detail.php?id=' . $r["id"] . '"><button class="btn btn-primary">詳細</button></a></td>';
    $view .= '<td><a class="btn btn-danger" href="delete.php?id=' . $r["id"] . '"><i class="glyphicon glyphicon-remove"></i>削除</a></td>';
    $view .= '</tr>';
  }
}
$view .= '</table>';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      <a class="navbar-brand" href="login.php">Login</a>
      <a class="navbar-brand" href="logout.php">Logout</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>
