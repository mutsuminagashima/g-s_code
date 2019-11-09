<?php
session_start();
include("funcs.php");
login_chk();
$kanri_flg = $_SESSION['kanri_flg'];
if($kanri_flg === '0') {
  header('location: logout.php');
}
$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();



//３．データ表示
$view="";
if($status==false) {
  sql_error();
}else{
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    if($r["kanri_flg"] === "1") {
      $kanri_flg = "管理者";
    } else {
      $kanri_flg = "一般";
    }
    $view .= '<p>';
    $view .= '<a href="user_detail.php?id='.$r["id"].'">';
    $view .= $r["id"]."|".$r["u_name"]."|".$r["lid"]."|".$kanri_flg;
    $view .= '</a>';
    $view .= " ";
    $view .= '<a class="btn btn-danger" href="user_delete.php?id='.$r["id"].'">';
    $view .= '[<i class="glyphicon glyphicon-remove"></i>削除]';
    $view .= '</a>';
    $view .= '</p>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ユーザー表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
    <?php echo $_SESSION["u_name"]; ?>さん
    <?php include("menu.php"); ?>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>
