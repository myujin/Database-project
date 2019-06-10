<?
/***buy.php***/
/***역할: 상품 구매에 필요한 정보들을 입력받는다.***/
?>

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

<?
/*홈페이지, 아이템페이지, 마이페이지 이동 버튼 구현 및 다음 페이지로 정보를 전달*/
/*이동 정보: 로그인 된 아이디, 비밀번호, 구매자인지 판매자인지 확인하는 변수(login_check_info)*/
?>
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

  include './dbcon.php'; //db연결

  $item_num=$_POST['item_num']; //이전 페이지에서 구매를 선택한 상품의 번호

/*구매할 상품의 데이터를 가져오는 질의문*/
  $query = "SELECT * FROM item WHERE item_num = '$item_num'";
  $result = mysqli_query($connect, $query);
  $row = mysqli_fetch_array($result);
  ?>

	<h1>상품 구매</h1>
	<div id="content">
		<br><br>
		<?
		/*구매에 필요한 정보들을 입력받고 다음 페이지로 넘기기*/
		?>
		  	<form action="./update_purchase_table.php" method="post">
					<?
					/*다음 페이지로 정보 이동*/
					/*이동 정보: 로그인 된 아이디, 비밀번호, 구매자인지 판매자인지 확인하는 변수(login_check_info),*/
					/*					db로 부터 받은 선택한 상품의 재고수, 선택한 상품의 고유번호*/
					?>
					<input type='hidden' name='login_id' value=<?=$_POST['login_id']?>>
					<input type='hidden' name='login_pwd' value=<?=$_POST['login_pwd']?>>
					<input type='hidden' name='login_check_info' value=<?=$_POST['login_check_info']?>>
		      <input type='hidden' name='stock' value=<?=$row['stock']?>>
					<input type='hidden' name='item_num' value=<?=$row['item_num']?>>

					<?
					/*구매수량 입력*/
					?>

		      <CENTER><h2>구매할 수량</h2>
					<CENTER><input type="text" name="order_num">
					<br><br>

					<?
					/*라디오버튼으로 옵션 선택.*/
					/*조건문을 사용하여 db로 부터 받은 상품의 정보에 옵션이 존재할 경우에만, 그 옵션에 해당하는 라이오 버튼이 나타나도록 함.*/
					?>
		      <CENTER>옵션
		      <br>
		      <input type="radio" name="option" value=0 checked="checked">옵션없음
		      <?
		      if($row['option1']){
		      ?>
		      	<br>
		      	<input type="radio" name="option" value=1><?=$row['option1']?>
		      <?
		      }
		      if($row['option2']){
		      ?>
		      	<br>
		      	<input type="radio" name="option" value=2><?=$row['option2']?>
		      <?
		      }
		      if($row['option3']){
		      ?>
		      	<br>
		      	<input type="radio" name="option" value=3><?=$row['option3']?>
		      <?
		      }
		      ?>
		      <br><br>

					<?
					/*선택한 값을 submit해주는 버튼*/
					?>
		      <button type="submit">구매</button>
				</form>
				<?
				/*상품정보 출력*/
				?>
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
						</table>

						<h2> 상품 설명 </h2>
						<table width= "800" border="1" cellspacing="0" cellpadding="5">
						 <tr align="center">
							 <td bgcolor="#cccccc">설명</td>
						 </tr>
						 <td><?=$row['contents']?></td>
					 </table>
				<br><br>
				<CENTER><h2>후기</h2>
					<table width= "800" border="1" cellspacing="0" cellpadding="5">
						<tr align="center">
							<td bgcolor="#cccccc">후기 번호</td>
							<td bgcolor="#cccccc">구매자</td>
							<td bgcolor="#cccccc">리뷰</td>
							<td bgcolor="#cccccc">평점</td>
							<td bgcolor="#cccccc">작성일</td>
						</tr>

						<?
						//db의 후기 목록에서 검색 조건에 맞는 후기들을 가져오는 질의문
						$query2 = "SELECT * FROM review JOIN purchase ON review.purchase_num = purchase.purchase_num WHERE purchase.item_num = '$item_num' ORDER BY review_date DESC LIMIT 5";
					  $result2 = mysqli_query($connect, $query2);

						/*db에서 가져온 후기들 리스트 출력*/
					  while ($row2 = mysqli_fetch_array($result2)) {
					?><tr>
								<td><?=$row2['review_num']?></td>
					      <td><?=$row2['buyer_ID']?></td>
								<td><?=$row2['review']?></td>
								<td><?=$row2['score']?></td>
								<td><?=$row2['review_date']?></td>
								</tr><?
					  }
					?>
				</table>
			</div>
		</div>
	</body>
</html>
