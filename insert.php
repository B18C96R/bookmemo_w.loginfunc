<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


//1. POSTデータ取得
$name   = $_POST["name"];
$email  = $_POST["email"];
$naiyou = $_POST["naiyou"];
// $age    = $_POST["age"]; //追加されています

//*** 外部ファイルを読み込む ***
include("funcs.php");
$pdo = db_conn();

//2. DB接続します
//*** function化を使う！  ***
// try {
//     $db_name = "gs_db3";    //データベース名
//     $db_id   = "root";      //アカウント名
//     $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
//     $db_host = "localhost"; //DBホスト
//     $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
// } catch (PDOException $e) {
//     exit('DB Connection Error:'.$e->getMessage());
// }


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_an_table(name,email,naiyou,indate)VALUES(:name,:email,:naiyou,now())");
$stmt->bindValue(':name',   $name,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email',  $email,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':naiyou', $naiyou, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行



//４．データ登録処理後
if($status==false){
    //*** function化を使う！*****************
    sql_error($stmt);
    // $error = $stmt->errorInfo();
    // exit("SQLError:".$error[2]);
}else{
    //*** function化を使う！*****************
    // header("Location: index.php");
    redirect("index.php");
    exit();
}

?>
