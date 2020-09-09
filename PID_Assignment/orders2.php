<?php
require_once("connDB.php");

session_start();
//如果有管理員登入就記住會員帳號，如果沒有登入就跳轉到登入頁
if (isset($_SESSION["maaccount"])) {
  $maaccount = $_SESSION["maaccount"];
} else {
  if (!isset($_SESSION["maaccount"])) {

    header("Location: login2.php");
    exit();
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <style>
    body {
      background-color: lightblue;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2
    }

    th {
      background-color: #4CAF50;
      color: white;
    }
  </style>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>訂單查詢</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

</head>

<body style="background:url('./img/bookindex.jpg')round">
  <h1 align="center">線上購書商城</h1>
  <form id="form1" name="form1" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
    <div align="center" bgcolor="#CCCCCC" style="background-color:SlateBlue;">
      <font color="#FFFFFF"><?= $maaccount . "   管理員訂單查詢"  ?></font>
    </div>
    <div align="center" bgcolor="#CCCCCC"><a href="index2.php">回首頁</a><a>/</a><a href="member.php">回會員管理</a></div>
    <div style="width:auto;height:600px;">
      <div style="width:auto;height:600px;text-align:center;margin:0 auto;">
        <label>
          <font color="#000000">訂單查詢結果 :
        </label>
        <?php
        // 比對會員帳號，顯示此會員的訂單明細
        $meaccount = $_SESSION["meaccount"];
        $id = $_GET["id"];
        $sqlo = "SELECT * FROM orders WHERE meaccount ='$id'";
        $result = mysqli_query($link, $sqlo); 
        $total_records = mysqli_num_rows($result);  // 取得記錄數

        echo ($total_records);
        ?>
        <table border="1" cellspacing=0 cellspadding=0>
          <tr>
            <td>訂單編號</td>
            <td>會員名稱</td>
            <td>會員編號</td>
            <td>產品編號</td>
            <td>產品名稱</td>
            <td>產品價格</td>
            <td>購買數量</td>
            <td>產品描述</td>
            <td>產品圖片</td>
            <td>訂單日期</td>
          </tr>
          <?php
          for ($i = 0; $i < $total_records; $i++) {
            $row = mysqli_fetch_assoc($result); //將陣列以欄位名索引   
          ?>
            <tr>
              <td>
                <?php echo $row['orid'];   ?>
              </td>
              <td>
                <?php echo $row['meaccount'];   ?>
              </td>
              <td>
                <?php echo $row['caid']; ?>
              </td>
              <td>
                <?php echo $row['prid']; ?>
              </td>
              <td>
                <?php echo $row['prname']; ?>
              </td>
              <td>
                <?php echo $row['prprice']; ?>
              </td>
              <td>
                <?php echo $row['caquantity']; ?>
              </td>
              <td>
                <?php echo $row['prdescript']; ?>
              </td>
              <td>
                <img id=<?php echo $row['primg']; ?> src="./img/<?php echo $row['primg']; ?>" width="10%" height="10%">
              </td>
              <td>
                <?php echo $row['ordate']; ?>
              </td>
            </tr>
          <?php    }   ?>
        </table>
      </div>
    </div>
  </form>
</body>
</html>