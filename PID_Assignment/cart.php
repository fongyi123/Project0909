<?php
require_once("connDB.php");
session_start();
//如果有會員登入就記住會員帳號，如果沒有登入就跳轉到登入頁
if (isset($_SESSION["meaccount"])) {
  $meaccount = $_SESSION["meaccount"];
  
} else {
  if (!isset($_SESSION["meaccount"])) {
    header("Location: login.php");
    exit();
  }
}
//如果按下商品選購按鈕，跳轉頁面到商品選購頁面
if (isset($_GET["gopro"])) {
  header("Location: meproduct.php");
}
//如果按下刪除按鈕，那一項商品刪除
if (isset($_GET["deletenew"])) {
  $deleten = $_GET["deletenew"];
  $sqldelete = "DELETE  FROM cart WHERE caid = '$deleten' ";
  mysqli_query($link, $sqldelete);
}
//如果按下‘＋’按鈕
if (isset($_GET["caquantityadd"])) {
  $caquantityadd = $_GET["caquantityadd"];
  $caquantityt = $_GET['caquantityt'];
  // 取得資料庫中購買量的欄位內容
  $sqladd = "SELECT caquantity from cart where caid = '$caquantityadd'";
  $result = mysqli_query($link, $sqladd);
  $row = mysqli_fetch_assoc($result);
  $i = implode(" ", $row);
  // 取得資料庫中庫存量的欄位內容
  $sqlprq = "SELECT prquantity from cart where caid = '$caquantityadd'";
  $result1 = mysqli_query($link, $sqlprq);
  $row1 = mysqli_fetch_assoc($result1);
  $prquantity = implode(" ", $row1);
  //如果購買量小於庫存量，購買量每按一次‘＋’按鈕購買量加一，並更新資料庫內容
  if ($i < $prquantity) {
    $i = $i + 1;
    $caquantityt = $_GET['caquantityt'];
    $caquantitya = "UPDATE `cart` SET `caquantity` = '$i' WHERE `caid` = '$caquantityadd' ";
    mysqli_query($link, $caquantitya);
  }
}
//如果按下‘－’按鈕
if (isset($_GET["caquantityr"])) {
  $caquantityr = $_GET["caquantityr"];
  $caquantityt = $_GET['caquantityt'];
  // 取得資料庫中購買量的欄位內容
  $sqlr = "SELECT caquantity from cart where caid = '$caquantityr'";
  $result = mysqli_query($link, $sqlr);
  $row = mysqli_fetch_assoc($result);
  $i = implode(" ", $row);
  //如果購買量大於零，購買量每按一次‘－’按鈕購買量減一，並更新資料庫內容
  if ($i > 0) {
    $i = $i - 1;
    $caquantityt = $_GET['caquantityt'];
    $caquantitya = "UPDATE `cart` SET `caquantity` = '$i' WHERE `caid` = '$caquantityr' ";
    mysqli_query($link, $caquantitya);
  }
}
//如果按下‘送出訂單’按鈕
if (isset($_GET["cartok"])) {
  $meaccount = $_SESSION["meaccount"];
  // 記下按下‘送出訂單’按鈕當下系統時間
  $ordate = date('Y-m-d h:i:s');
  // 把購物車的資料加進訂單的表中
  $sqlorders = "INSERT INTO orders (meaccount,	caid,	prid,	prname,	prprice,	caquantity,	prdescript,	primg, ordate
  ) SELECT '$meaccount', caid,	prid,	prname,	prprice,	caquantity,	prdescript,	primg, '$ordate' FROM cart ";
  mysqli_query($link, $sqlorders);
  // 並清空購物車的內容，同時跳轉到查看訂單的頁面
  $sqlclear = "TRUNCATE table cart";
  mysqli_query($link, $sqlclear);
  header("Location: orders.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
    }
  </style>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>我的購物車</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

</head>

<body style="background:url('./img/bookindex.jpg')round">
  <h1 align="center">線上購書商城</h1>
  <form id="form1" name="form1" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">

    <div align="center" bgcolor="#CCCCCC" style="background-color:SlateBlue;">
      <font color="#FFFFFF"><?= "歡迎 " . $meaccount . "  進入購物車" ?></font>
    </div>
    <div align="center" bgcolor="#CCCCCC"><a href="index.php">回首頁</a></div>
    <div align="center" bgcolor="#CCCCCC">
    </div>
    <div style="width:auto;height:600px;">
      <div style="width:auto;height:600px;text-align:center;margin:0 auto;">
        <?php
        $meaccount = $_SESSION["meaccount"];
        $sqlcar = "SELECT * from cart";
        $result = mysqli_query($link, $sqlcar);
        $total_records = mysqli_num_rows($result);  // 取得記錄數
        // echo ($total_records);
        ?>
        <table border="1">
          <tr>
            <td>商品編號</td>
            <td>商品名稱</td>
            <td>商品價格</td>
            <td>購買數量</td>
            <td>每項總額</td>
            <td>商品描述</td>
            <td>商品圖片</td>
            <td>編輯功能</td>
          </tr>
          <?php
          while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
              <?php
              $total = $row['caquantity'] * $row['prprice'];
              // 錯誤訊息Notice: Undefined variable:關掉
              error_reporting(E_ALL & ~E_NOTICE);
              $all = $all + $total;
              ?>
              <td>
                <?php echo $row['prid'];   ?>
              </td>
              <td>
                <?php echo $row['prname'];   ?>
              </td>
              <td>
                <input type="text" name="prprice" style="background-color: transparent;" id="prprice" class="form-control" placeholder="0" value="<?php echo $row['prprice']; ?>" onfocus="this.blur()" />
              </td>
              <td>
                <span class="input-group">
                  <button type="submit" name="caquantityadd" id="caquantityadd" value="<?php echo $row['caid'] ?>" class="input-group-addon">+</button>
                  <input type="text" name="caquantityt" id="caquantityt" class="form-control" placeholder="0" value="<?php echo $row['caquantity'] ?>" />
                  <button type="submit" name="caquantityr" id="caquantityr" value="<?php echo $row['caid'] ?>">-</button>
                </span>
              </td>
              <td>
                <input type="text" name="catotal" style="background-color: transparent;" id="catotal" class="form-control" placeholder="0" value="<?php echo $total; ?>" onfocus="this.blur()" />
              </td>
              <td>
                <?php echo $row['prdescript']; ?>
              </td>
              <td>
                <img id=<?php echo $row['primg']; ?> src="./img/<?php echo $row['primg']; ?>" width="10%" height="10%">
              </td>
              <td>
                <button type="submit" name="gopro" id="gocart" class="btn btn-info">繼續購物</button>
                <button type="submit" name="deletenew" id="deletenew" class="btn btn-danger" value="<?php echo $row['caid'] ?>">刪除商品</button>
                <?php
                ?>
              </td>
            </tr>
          <?php    }   ?>
        </table>
        <input type="text" name="alltotal" id="alltotal" class="form-control" style="background-color: transparent;" placeholder="合計" value="<?php error_reporting(E_ALL & ~E_NOTICE);echo "合計： " . $all ?>" onfocus="this.blur()" />
        <button type="submit" name="cartok" id="cartok" class="btn btn-success">送出訂單</button>
      </div>
    </div>
  </form>
</body>
</html>