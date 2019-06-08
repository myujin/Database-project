
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<html>
<head>
<title>홈 페이지</title>
<link rel="stylesheet" href="css/home.css">
<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/main.css">
</head>
<body>
<div id="page-wrapper">
	<div id="head">
		<nav>
			<form class="head" action="./home.php" name='home' method="post">
				<input type='hidden' name='login_id' value=<?=$_POST['login_id']?>>
				<input type='hidden' name='login_pwd' value=<?=$_POST['login_pwd']?>>
				<input type='hidden' name='login_check_info' value=<?=$_POST['login_check_info']?>>
				<button type="submit">홈페이지</button>
			</form>
			<form class="head" action="./item.php" name='item' method="post">
				<input type='hidden' name='login_id' value=<?=$_POST['login_id']?>>
				<input type='hidden' name='login_pwd' value=<?=$_POST['login_pwd']?>>
				<input type='hidden' name='login_check_info' value=<?=$_POST['login_check_info']?>>
					<button type="submit">아이템 목록</button>
			</form>
			<form class="head" action="./mypage.php" name='mypage' method="post">
				<input type='hidden' name='login_id' value=<?=$_POST['login_id']?>>
				<input type='hidden' name='login_pwd' value=<?=$_POST['login_pwd']?>>
				<input type='hidden' name='login_check_info' value=<?=$_POST['login_check_info']?>>
				<button type="submit">마이페이지</button>
			</form>
		</nav>
	</div>
  <?

  include './dbcon.php';
  $item_num=$_POST['item_num'];


  $query = "SELECT * FROM item WHERE item_num = '$item_num'";

  $result = mysqli_query($connect, $query);

  $row = mysqli_fetch_array($result);
  ?>
	<h1>상품 구매</h1>
	<div id="content">

        <form action="./update_purchase_table.php" method="post">
					<input type='hidden' name='login_id' value=<?=$_POST['login_id']?>>
					<input type='hidden' name='login_pwd' value=<?=$_POST['login_pwd']?>>
					<input type='hidden' name='login_check_info' value=<?=$_POST['login_check_info']?>>
          <input type='hidden' name='stock' value=<?=$row['stock']?>>

          <CENTER>구매할 수량
					<br>
					<CENTER><input type="text" name="order_num">
					<br><br>
          <CENTER>옵션
          <br>
          <input type="radio" name="option" value="opton0" checked="checked">옵션없음
          <?
          if($row['option1']){
            ?>
            <br>
            <input type="radio" name="option" value="opton1"><?=$row['option1']?>
          <?
          }
          if($row['option2']){
          ?>
            <br>
            <input type="radio" name="option" value="opton2"><?=$row['option2']?>
          <?
          }
          if($row['option3']){
          ?>
            <br>
            <input type="radio" name="option" value="opton3"><?=$row['option3']?>
          <?
          }
          ?>
          <br><br>
          <button type="submit">구매</button>

				</form>

			  <br><br>
			  <h2> 상품정보 </h2>
			  <table width= "800" border="1" cellspacing="0" cellpadding="5">
			  <tr align="center">
          <td bgcolor="#cccccc">상품이름</td>
  		    <td bgcolor="#cccccc">카테고리</td>
  			  <td bgcolor="#cccccc">판매자</td>
          <td bgcolor="#cccccc">재고</td>
          <td bgcolor="#cccccc">평점</td>
			  </tr>

      <td><?=$row['product_name']?></td>
      <td><?=$row['category']?></td>
      <td><?=$row['seller_ID']?></td>
      <td><?=$row['stock']?></td>
      <td><?=$row['score']?></td>

</div>
		</body>
	</div>
</html>
