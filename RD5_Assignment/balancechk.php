<?php
require_once("connDB.php");
session_start();
//如果有會員登入就記住會員帳號，如果沒有登入就跳轉到登入頁
if (isset($_SESSION["maccount"])) {
  $maccount = $_SESSION["maccount"];
  // 如果按下餘額查詢按鈕
  if (isset($_GET['balancechk'])) {
    $date = ('Y-m-d H:i:s');
    $maccount = $_SESSION["maccount"];
    $sql = "SELECT mbalance from member where maccount = '$maccount'";
    $result = mysqli_query($link, $sql);
    $mbalance["mbalance"] = mysqli_fetch_assoc($result);
    $intmbalance = implode(",", $mbalance["mbalance"]);
    // echo "<script>alert('尊貴的$maccount 大佬您好，您的餘額為：$intmbalance'); </script>";
  }
} else {
  if (!isset($_SESSION["maccount"])) {
    header("Location: login.php");
    exit();
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>餘額查詢</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
</head>
<body style="background:url('./img5/bank.jpg')round">
  <h1 align="center">線上網銀系統</h1>
  <form id="form1" name="form1" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
    <div align="center" bgcolor="#CCCCCC" style="background-color:SlateBlue;">
      <font color="#FFFFFF">歡迎使用網路銀行餘額查詢</font>
    </div>
    <divalign="center" bgcolor="#CCCCCC"><a href="index.php">回首頁</a></div>
      <div style="width:auto;height:600px;">
        <div style="width:50%;height:600px;text-align:center;margin:0 auto;"><br><br><br><br>
          <div>
            <label>
              <font color="#000000">餘額查詢 :
            </label>
            <input type="text" name="balancecht" id="balancecht" placeholder="請開始查詢餘額" onfocus="this.blur()" value="<?php 
            // 如果按下顯示餘額，就顯示餘額，不然就隱藏餘額
            if (isset($_GET['balancechk'])) {
              echo $intmbalance;
            }else{
              echo "****";
            }
             ?>" />
            <input type="submit" name="hidebalancechk" id="hidebalancechk" value="隱藏餘額" />
            <input type="submit" name="balancechk" id="balancechk" value="顯示餘額" />
          </div>
        </div>
      </div>
      <div style="background-color:SlateBlue;">
        <font color="#FFFFFF"><?= "Welcome! " . $maccount ?></font>
      </div>
  </form>
</body>
</html>