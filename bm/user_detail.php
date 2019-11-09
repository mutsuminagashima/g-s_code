<?php
session_start();
$id = filter_input( INPUT_GET, "id" );
//$id = $_GET["id"]; //?id~**を受け取る
include("funcs.php");
login_chk();
$kanri_flg = $_SESSION['kanri_flg'];
if($kanri_flg === '0') {
  header('location: logout.php');
}

$pdo = db_conn();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
$stmt->bindValue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if($status==false) {
    sql_error();
}else{
    $row = $stmt->fetch();
}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  </nav>
    <?php echo $_SESSION["u_name"]; ?>さん
    <?php include("menu.php"); ?>

</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="user_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>[編集]</legend>
     <label>名前：<input type="text" name="u_name" value="<?=$row["u_name"]?>"></label><br>
     <label>ログインID：<input type="text" name="lid" value="<?=$row["lid"]?>"></label><br>
     <label>パスワード：<input type="text" name="lpw"></label><br>
    <label>
        <input type="checkbox" name="kanri_flg" value="1">管理者
    </label>
    <label>
        <input type="checkbox" name="kanri_flg" value="0">一般
    </label><br>
     <input type="submit" value="送信">
     <input type="hidden" name="id" value="<?=$id?>">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
