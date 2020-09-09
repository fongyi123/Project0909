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
// 如果按下加入購物車的按鈕
if (isset($_GET["gocart"])) {
  $gocart = $_GET["gocart"];
  $sqladdr1 = "SELECT * FROM cart WHERE prid = '$gocart'";
  $result1 = mysqli_query($link, $sqladdr1);
  $row1 = mysqli_fetch_assoc($result1);
  //同一項商品的購買數量會相加，而不會在購物車出項同商品出現多欄的情況
  if ($row1["prid"] == $gocart) {
    $sqladdr = "SELECT caquantity FROM cart WHERE prid = '$gocart'";
    $result = mysqli_query($link, $sqladdr);
    $row = mysqli_fetch_assoc($result);
    $impcaq = implode("", $row);
    // var_dump("$impcaq");
    $sqladd = "SELECT caquantity from cart where prid = '$gocart'";
    $result22 = mysqli_query($link, $sqladd);
    $row22 = mysqli_fetch_assoc($result22);
    $i = implode(" ", $row22);
    $sqlprq = "SELECT prquantity from cart where prid = '$gocart'";
    $result11 = mysqli_query($link, $sqlprq);
    $row11 = mysqli_fetch_assoc($result11);
    $prquantity = implode(" ", $row11);
    //如果點擊同項商品加入購物車的次數小於庫存量的話，購物車中此項商品的購買數量增加，同時並跳出提示框顯示“已經加入購物車”
    if ($i < $prquantity) {
      $impcaq = $impcaq + 1;
      $sqlupaddr = "UPDATE cart set caquantity = '$impcaq' WHERE prid = '$gocart'";
      mysqli_query($link, $sqlupaddr);
    }
  } else {
    //如果點擊加入購物車的那項商品還沒有在購物車中，就把此項商品加到購物車並跳轉到購物車的頁面
    $sqlgocart = "INSERT INTO cart (prid, prname, prprice, prquantity, prdescript, primg) SELECT prid, prname, prprice, prquantity, prdescript, primg FROM product WHERE prid = '$gocart'";
    mysqli_query($link, $sqlgocart);
    header("Location: cart.php"); 
  }
  echo "<script>alert('已經加入購物車');parent.location.href='meproduct.php' </script>";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <style>
    body {
      background-color: lightblue;
    }
  </style>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>商品選購</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

</head>

<body style="background:url('./img/bookindex.jpg')round">
  <h1 align="center">線上購書商城</h1>
  <form id="form1" name="form1" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
    <div align="center" bgcolor="#CCCCCC" style="background-color:SlateBlue;">
      <font color="#FFFFFF">商品選購</font>
    </div>
    <div align="center" bgcolor="#CCCCCC"><a href="index.php">回首頁</a><a>/</a><a href="cart.php">查看購物車</a></div>
    <?php
    $link = @mysqli_connect("localhost", "root", "root", "shopping", 8889) or die(mysqli_connect_error());
    $result = mysqli_query($link, "set names utf8");
    $meaccount = $_SESSION["meaccount"];
    $sqlsecret = "SELECT * from product";
    $result = mysqli_query($link, $sqlsecret);
    $total_records = mysqli_num_rows($result);  // 取得記錄數
    // echo ($total_records);
    ?>
    <table border="1" cellspacing=0 cellspadding=0>
      <tr>
        <td>商品編號</td>
        <td>商品名稱</td>
        <td>商品價格</td>
        <td>目前數量</td>
        <td>商品描述</td>
        <td>商品圖片</td>
        <td>編輯功能</td>
      </tr>
      <?php
      while ($row = mysqli_fetch_assoc($result)) {
      ?>
        <tr>
          <td>
            <?php echo $row['prid'];   ?>
          </td>
          <td>
            <?php echo $row['prname'];   ?>
          </td>
          <td>
            <?php echo $row['prprice']; ?>
          </td>
          <td>
            <?php echo $row['prquantity'];   ?>
          </td>
          <td>
            <?php echo $row['prdescript']; ?>
          </td>
          <td>
            <img id=<?php echo $row['primg']; ?> src="./img/<?php echo $row['primg']; ?>" width="10%" height="10%">
          </td>
          <td>
            <button type="submit" name="gocart" id="gocart" class="btn btn-danger" value="<?php echo $row['prid'] ?>">加入購物車</button>
            <?php
            ?>
          </td>
        </tr>
      <?php    }   ?>
    </table>

    <div style="background-color:SlateBlue;">
      <font color="#FFFFFF"><?= "Welcome! " . $meaccount ?></font>
    </div>
  </form>
</body>

</html>