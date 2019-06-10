<?
/***mypage.php***/
/***역할: 개인정보 확인 및 변경화면으로 이동 ***/
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<html>
<head>
<title>마이 페이지</title>
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

	<h1>수공예 장터 iDBus</h1>
<div id="content">
	<section id="main-section">

	<br></br>

			<?
			/*현재 비밀번호를 입력받고 개인정보 변경에 필요한 다른 정보들과 함께 다음 페이지로 전달.*/
			/*이동 정보: 로그인 된 아이디, 비밀번호, 구매자인지 판매자인지 확인하는 변수(login_check_info), 카테고리를 나타내는 변수(모든 카테고리)*/
			?>
      <form action="./check_right_pwd.php" name="change_user_info" method='post'>
				<input type='hidden' name='login_id' value=<?=$_POST['login_id']?>>
				<input type='hidden' name='login_pwd' value=<?=$_POST['login_pwd']?>>
				<input type='hidden' name='login_check_info' value=<?=$_POST['login_check_info']?>>

				<h2>개인정보 변경</h2>
		    비밀번호를 입력하세요
	      <h4>비밀번호</h4>
				<p>현재 비밀번호 <input type="password" name="PW_old"></p>

				<br>
	      <input type="submit" value="변경하기">

      </form>
			<?
			include './dbcon.php';//db연결

			$login_id=$_POST['login_id'];
			/*사용자가 판매자일 경우 구매 상품 목록 출력*/
			if($_POST['login_check_info']=='buyer'){
			?>
				<br><br>
				<h2> 나의 구매 상품 </h2>
				<table width= "800" border="1" cellspacing="0" cellpadding="5">
				<tr align="center">
					<td bgcolor="#cccccc">주문 번호</td>
					<td bgcolor="#cccccc">상품이름</td>
					<td bgcolor="#cccccc">카테고리</td>
					<td bgcolor="#cccccc">구매 수</td>
					<td bgcolor="#cccccc">옵션</td>
					<td bgcolor="#cccccc">판매자</td>
					<td bgcolor="#cccccc">구매일자</td>
					<td bgcolor="#cccccc">후기 작성</td>
				</tr>
			<?
				//db의 상품 목록과 구매목록의 조인에서 상품과 구매정보를 가져오는 질의문
				$query = "SELECT * FROM purchase JOIN item ON purchase.item_num = item.item_num WHERE buyer_ID = '$login_id' ORDER BY purchase_date DESC";
			  $result = mysqli_query($connect, $query);

				/*db에서 가져온 상품들 출력*/
			  while ($row = mysqli_fetch_array($result)) {
					?>
					<tr>
						<td><?=$row['purchase_num']?></td>
						<td><?=$row['product_name']?></td>
						<td><?=$row['category']?></td>
						<td><?=$row['order_num']?></td>
						<?
						/*옵션 출력*/
						if($row['option_num']==0){
						?>
							<td>없음</td>
						<?
						}
						elseif ($row['option_num']==1) {
						?>
							<td><?=$row['option1']?></td>
						<?
						}
						elseif ($row['option_num']==2) {
						?>
							<td><?=$row['option2']?></td>
						<?
						}
						else{
						?>
							<td><?=$row['option3']?></td>
						<?
						}
						?>
						<td><?=$row['seller_ID']?></td>
						<td><?=$row['purchase_date']?></td>
						<?
						/*구매한 상품들 후기작성 페이지로 이동할 수 있는 버튼 생성*/
						?>
				    <td><form action="write_review.php" method="post">
							<?/*다음 페이지로 로그인 된 아이디, 비밀번호, 구매자인지 판매자인지 확인하는 변수(login_check_info) 전달*/?>
							<input type='hidden' name='login_id' value=<?=$_POST['login_id']?>>
							<input type='hidden' name='login_pwd' value=<?=$_POST['login_pwd']?>>
							<input type='hidden' name='login_check_info' value=<?=$_POST['login_check_info']?>>
							<input type='hidden' name='item_num' value=<?=$_POST['item_num']?>>
							<CENTER><button type="submit">후기 작성</button>
						</form></td>
				  </tr>
			<?
			  }
			}
			/*사용자가 구매자일 경우 판매 상품 목록 출력*/
			else {
			?>
				<br><br>
				<h2> 나의 판매 상품 </h2>
				<table width= "800" border="1" cellspacing="0" cellpadding="5">
				<tr align="center">
					<td bgcolor="#cccccc">상품 번호</td>
					<td bgcolor="#cccccc">상품이름</td>
					<td bgcolor="#cccccc">카테고리</td>
					<td bgcolor="#cccccc">재고수</td>
					<td bgcolor="#cccccc">평점</td>
					<td bgcolor="#cccccc">상품 내리기</td>
					<td bgcolor="#cccccc">상품 수정</td>
				</tr>
				<?
					/*사용자가 올린 상품 목록을 db에서 가져오는 질의문*/
					$query = "SELECT * FROM item WHERE seller_ID = '$login_id'";
				  $result = mysqli_query($connect, $query);

					/*db에서 가져온 상품들 출력*/
				  while ($row = mysqli_fetch_array($result)) {
						?>
						<tr>
							<td><?=$row['item_num']?></td>
							<td><?=$row['product_name']?></td>
							<td><?=$row['category']?></td>
							<td><?=$row['stock']?></td>
							<td><?=$row['score']?></td>
							<?
							/*상품 판매를 중지할 수 있는 버튼 생성*/
							?>
					    <td><form action="remove_item.php" method="post">
								<?/*다음 페이지로 로그인 된 아이디, 비밀번호, 구매자인지 판매자인지 확인하는 변수(login_check_info) 전달*/?>
								<input type='hidden' name='product_num' value=<?=$_POST['product_name']?>>
								<input type='hidden' name='login_id' value=<?=$_POST['login_id']?>>
								<input type='hidden' name='login_pwd' value=<?=$_POST['login_pwd']?>>
								<input type='hidden' name='login_check_info' value=<?=$_POST['login_check_info']?>>
								<input type='hidden' name='item_num' value=<?=$_POST['item_num']?>>

								<CENTER><button type="submit">상품 내리기</button>
							</form></td>
							<?
							/*상품 판매를 수정할 수 있는 버튼 생성*/
							?>
							<td><form action="renew_item.html" method="post">
								<?/*다음 페이지로 로그인 된 아이디, 비밀번호, 구매자인지 판매자인지 확인하는 변수(login_check_info) 전달*/?>
								<input type='hidden' name='product_num' value=<?=$_POST['product_name']?>>
								<input type='hidden' name='login_id' value=<?=$_POST['login_id']?>>
								<input type='hidden' name='login_pwd' value=<?=$_POST['login_pwd']?>>
								<input type='hidden' name='login_check_info' value=<?=$_POST['login_check_info']?>>
								<input type='hidden' name='item_num' value=<?=$_POST['item_num']?>>

								<CENTER><button type="submit">상품 수정</button>
							</form></td>
					  </tr>
				<?
				  }
			}
			?>

	</section>

</div>
</div>
</body>
</html>
