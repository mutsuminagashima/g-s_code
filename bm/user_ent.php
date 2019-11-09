<?php
session_start();
include("funcs.php");
login_chk();
$kanri_flg = $_SESSION['kanri_flg'];
if($kanri_flg === '0') {
  header('location: logout.php');
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
    <?php echo $_SESSION["u_name"]; ?>さん
    <?php include("menu.php"); ?>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="user_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー登録</legend>
     <label>名前：<input type="text" name="u_name"></label><br>
     <label>ログインID：<input type="text" name="lid"></label><br>
     <label>パスワード：<input type="text" name="lpw"></label><br>
    <label>
        <input type="checkbox" name="kanri_flg" value="1">管理者
    </label>
    <label>
        <input type="checkbox" name="kanri_flg" value="0">一般
    </label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
