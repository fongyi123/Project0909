<?php
require_once("connDB.php");
session_start();
if (isset($_SESSION["maaccount"])) {
  $meaccount = $_SESSION["maaccount"];
} else {
  if (!isset($_SESSION["maaccount"])) {
    header("Location: login2.php");
    exit();
  }
}
$maaccount = $_SESSION["maaccount"];

$upd = $_GET["id"];

if (isset($_GET["updatenewok"])) {
  $updatenewok = $_GET["updatenewok"];
  $prnamenewu = $_GET["prnamenewu"];
  $prpricenewu = $_GET["prpricenewu"];
  $prquantitynewu = $_GET["prquantitynewu"];
  $prdescriptnewu = $_GET["prdescriptnewu"];
  $primgnewu = $_GET["primgnewu"];
  $sqlupdatenewok = "UPDATE `product` SET `prname` = '$prnamenewu',`prprice` = '$prpricenewu',`prquantity` = '$prquantitynewu',`prdescript` = '$prdescriptnewu',`primg` = '$primgnewu' WHERE `product`.`prid` = '$updatenewok' ";

  mysqli_query($link, $sqlupdatenewok);
  header("Location: product.php");
}

$sqlsecret = "SELECT * from product WHERE prid = '$upd'";
$result = mysqli_query($link, $sqlsecret);
$total_records = mysqli_num_rows($result);  // 取得記錄數

?>
<!DOCTYPE html>
<html>

<head>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: lightblue;
    }
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th,td {
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
  <title>Lag - Member Page</title>
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> -->
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.toast.js"></script>

</head>

<body style="background:url('./img/bookindex.jpg')round">
  <h1 align="center">線上購書商城</h1>
  <form id="form1" name="form1" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
    <div align="center" bgcolor="#CCCCCC" style="background-color:SlateBlue;">
      <font color="#FFFFFF">商品管理</font>
    </div>
    <div align="center" bgcolor="#CCCCCC"><a href="index2.php">回首頁</a></div>

    <label>
      <font color="#000000">修改商品數量 :
    </label>
    <?php
    echo ($total_records);
    ?>
    <table border="1" id="latestNews" cellspacing=0 cellspadding=0>
      <tr>
        <td>商品編號</td>
        <td>商品名稱</td>
        <td>商品價格</td>
        <td>商品數量</td>
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
            <?php echo $row['prquantity']; ?>
          </td>
          <td>
            <?php echo $row['prdescript']; ?>
          </td>
          <td>
            <img id=<?php echo $row['primg']; ?> src="./img/<?php echo $row['primg']; ?>" width="10%" height="10%">
          </td>
          <td>
            <button type="submit" name="updatenewok" id="updatenewok" class="btn btn-info" value="<?php echo $row['prid'] ?>">編輯完成</button>
            <?php
            ?>
          </td>
        </tr>
        <div class="form-group">
          <label for="prnamenew">
            新商品名稱
          </label>
          <input type="text" name="prnamenewu" id="prnamenewu" class="form-control" placeholder="請輸入新商品名稱" value="<?php echo $row['prname']; ?>" />
        </div>
        <div class="form-group">
          <label for="prpricenew">
            新商品價格
          </label>
          <input type="text" name="prpricenewu" id="prpricenewu" class="form-control" placeholder="請輸入新商品價格" value="<?php echo $row['prprice']; ?>">
        </div>
        <div class="form-group">
          <label for="prquantitynew">
            新商品數量
          </label>
          <input type="text" name="prquantitynewu" id="prquantitynewu" class="form-control" placeholder="請輸入新商品數量" value="<?php echo $row['prquantity']; ?>">
        </div>
        <div class="form-group">
          <label for="prdescriptnew">
            新商品描述
          </label>
          <input type="text" name="prdescriptnewu" id="prdescriptnewu" class="form-control" placeholder="請輸入新商品描述" value="<?php echo $row['prdescript']; ?>">
        </div>
        <div class="form-group">
          <label for="primgnew">
            新商品圖片
          </label>
          <input type="file" name="primgnewu" id="primgnewu" class="form-control" placeholder="請輸入新商品圖片" >
        </div>
        <?php
        ?>
      <?php    }   ?>
    </table>

    </div>
    <div style=" background-color:SlateBlue;">
      <font color="#FFFFFF"><?= "Welcome! " . $maaccount ?></font>
    </div>
  </form>
  <script>
  </script>
</body>

</html>