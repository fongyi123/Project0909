<?php
require_once("connDB.php");
session_start();
// 如果管理員有登入，就記住會員帳號，要不然就記為遊客（Guest）
if (isset($_SESSION["maaccount"])) {
  $maaccount = $_SESSION["maaccount"];
} else {
  $maaccount = "Guest";
}
// 如果按下登入按鈕，就跳轉到登入頁面
if (isset($_GET["login2"])) {
  header("Location: login2.php");
  exit();
}
// 如果按下註冊按鈕，就跳轉到註冊頁面
if (isset($_GET["signup2"])) {
  header("Location: signup2.php");
  exit();
}
if (isset($_GET["logout"])) {
  header("Location: login2.php?logout=1");
  exit();
}
// 如果按下商品管理按鈕，就跳轉到商品管理頁面
if (isset($_GET["product"])) {
  header("Location: product.php");
  exit();
}
// 如果按下會員管理按鈕，就跳轉到會員管理頁面
if (isset($_GET["member"])) {
  header("Location: member.php");
  exit();
}
// 如果按下前往會員端按鈕，就跳轉到會員端首頁頁面
if (isset($_GET["gomember"])) {
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      background-color: lightblue;
    }
  </style>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>管理者首頁</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body style="background:url('./img/bookindex.jpg')round">
  <h1 align="center">線上購書商城</h1>
  <form width="100%" height="200" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
    <div align="center" bgcolor="#CCCCCC" style="background-color:SlateBlue;">
      <font color="#FFFFFF">管理員系統 - 首頁</font>
    </div>
    <div>管理選項</font>
    </div>
    <div>
      <div>
        <?php if ($maaccount == "Guest") { ?>
          <input name="login2" type="submit" class="btn btn-primary" color="white" value="登入"></input>
          <input name="signup2" type="submit" class="btn btn-primary" color="white" value="註冊"></input>
        <?php } else { ?>
          <input name="logout" type="submit" class="btn btn-primary" value="登出"></input>
        <?php } ?>
        <input name="product" type="submit" class="btn btn-primary" href="product.php" value="產品管理"></input>
        <input name="member" type="submit" class="btn btn-primary" href="member.php" value="會員管理"></input>
        <input name="gomember" type="submit" class="btn btn-primary" href="index.php" value="前往會員端"></input>
      </div>
      <div style="width:auto;height:562px;">
      </div>
      <div style="background-color:SlateBlue;">
        <font color="#FFFFFF"><?= "Welcome! " . $maaccount ?></font>
      </div>
    </div>
  </form>
</body>
</html>