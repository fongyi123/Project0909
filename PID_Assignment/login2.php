<?php
require_once("connDB.php");
session_start();
//如果按下登出按鈕，跳轉頁面到管理者首頁
if (isset($_GET["logout"])) {
  $_SESSION["maaccount"] = $maaccount;
  header("Location: index2.php");
  exit();
}
//如果按下回首頁按鈕，跳轉頁面到管理者首頁
if (isset($_POST["btnHome"])) {
  header("Location: index2.php");
  exit();
}
//如果按下登入按鈕，先比對輸入的帳號有無註冊
if (isset($_POST["btnOK"])) {
  $maaccount = $_POST["maaccount"];
  $mapassword = $_POST["maPassword"];
  $sql = "select maaccount, mapassword from manager where maaccount='$maaccount' and mapassword='$mapassword' ";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  // 如果帳號密碼都有輸入，並且此帳號密碼都有註冊過，及可成功登入，要不然就跳出提示框顯示'帳號密碼錯誤'
  if ($maaccount != null  &&  $mapassword != null && $row['maaccount'] == $maaccount && $row['mapassword'] == $mapassword) {
    // 除去輸入帳號時不必要的空白字元
    if (trim($maaccount) != "") {
      $_SESSION["maaccount"] = $maaccount;
      unset($_SESSION["lastPage"]);
      if (isset($_SESSION["lastPage"]))
        header(sprintf("Location: %s", $_SESSION["lastPage"]));
      else
        header("Location: index2.php");
      exit();
    } 
  }else {
    echo "<script>alert('帳號密碼錯誤');parent.location.href='login2.php' </script>";
  }
}
?>

<!DOCTYPE html>

<head>
  <style>
    body {
      background-color: lightblue;
    }
  </style>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>管理者登入</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

</head>

<body style="background:url('./img/bookindex.jpg')round">
  <h1 align="center">線上購物商城</h1>

  <form id="form1" name="form1" method="post" action="login2.php" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
    <div align="center" bgcolor="#CCCCCC" style="background-color:SlateBlue;">
      <font color="#FFFFFF">管理員系統 - 登入</font>
    </div>
    <div class="form-group row">
      <div class="offset-4 col-8">

      </div>
    </div>
    <div style="width:50%;height:600px;text-align:center;margin:0 auto;"><br><br><br><br>
      <div>
        <label>
          <font color="#000000">帳號 :
        </label>
        <!-- 必須輸入１到１４個字的帳號 -->
        <input type="text" name="maaccount" id="maUserName" pattern="\w{1,14}" required />
      </div><br><br><div>
        <label>
          <font color="#000000">密碼 :
        </label>
        <!-- 必須輸入１到１４個字的密碼 -->
        <input type="password" name="maPassword" id="maPassword" pattern="\w{1,14}" required />
      </div><br><br><br>
      <div>
        <input type="submit" name="btnOK" id="btnOK" value="登入" />
        <input type="reset" name="btnReset" id="btnReset" value="重設" />
        <!-- 不必輸入帳號和密碼就可以直接回到首頁 -->
        <button type="button" name="btnHome" id="btnHome" onclick="window.location='index2.php'" >回首頁</button>
      </div>
    </div>
    <div style="background-color:SlateBlue;">
      <font color="#FFFFFF">歡迎進入線上購書商城管理系統</font>
    </div>

  </form>
</body>

</html>