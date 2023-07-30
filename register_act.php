<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


// 1. SESSION開始
session_start();

// 2. 送られてきた値を取得
$name = $_POST["name"];
$lid  = $_POST["lid"];
$lpw  = $_POST["lpw"];
$hashed_lpw = password_hash($lpw, PASSWORD_DEFAULT); // パスワードをハッシュ化

// 3. DB接続
include("funcs.php");
$pdo = db_conn();

// 4. lidが重複していないかチェック
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE lid = :lid");
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$status = $stmt->execute();
if($stmt->fetch() > 0) {
    // lidが重複している場合、エラーメッセージをセットしてリダイレクト
    $_SESSION['error_message'] = "このログインIDは既に使用されています。";
    header("Location: register.php");
    exit();
}

// 5. ユーザー情報の登録SQL
$stmt = $pdo->prepare("INSERT INTO gs_user_table (name, lid, lpw, kanri_flg, life_flg) VALUES (:name, :lid, :lpw, :kanri_flg, :life_flg)");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $hashed_lpw, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', 0, PDO::PARAM_INT);
$stmt->bindValue(':life_flg', 0, PDO::PARAM_INT);
$status = $stmt->execute();

// ここで変数の内容を確認
var_dump($name, $lid, $hashed_lpw);

// 追加: エラー情報の出力
if($status==false) {
    echo "\nPDO::errorInfo():\n";
    print_r($stmt->errorInfo());
}

// 6. 実行後のエラーチェック
if($status==false){
    sql_error($stmt);
} else {
    header("Location: login.php");
    exit();
}
?>
