<?
/***search.php***/
/***역할: 상품을 입력하면 상품 검색 ***/
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

	<h1>수공예 장터 iDBus</h1>
	<div id="content">

	<br></br>
				<?
				/*검색사항을 입력하고 카테고리를 선택해서 검색페이지로 넘김*/
				?>
        <form action="./search.php" method="post">
					<?
					/*다음 페이지로 로그인 된 아이디, 비밀번호, 구매자인지 판매자인지 확인하는 변수(login_check_info) 전달*/
					?>
					<input type='hidden' name='login_id' value=<?=$_POST['login_id']?>>
					<input type='hidden' name='login_pwd' value=<?=$_POST['login_pwd']?>>
					<input type='hidden' name='login_check_info' value=<?=$_POST['login_check_info']?>>

					<?
					/*검색어 입력*/
					?>
          <CENTER>검색할 내용을 입력하세요
					<br>
					<br>
					<CENTER><input type="text" name="search" ><button type="submit">검색</button>
					<br>

					<?
					/*옵션 선택*/
					?>
					<input type="radio" name="category" value="all" checked="checked">전체
					<input type="radio" name="category" value="food">food
					<input type="radio" name="category" value="clothes">clothes
					<input type="radio" name="category" value="accessory">accessory
					<input type="radio" name="category" value="decoration">decoration
					<input type="radio" name="category" value="other">other
				</form>

				<?
				/*검색결과 출력*/
				?>
			  <br><br>
			  <h2> 게시판 </h2>
			  <table width= "800" border="1" cellspacing="0" cellpadding="5">
			  <tr align="center">
					<td bgcolor="#cccccc">이동</td>
					<td bgcolor="#cccccc">상품이름</td>
			    <td bgcolor="#cccccc">카테고리</td>
			    <td bgcolor="#cccccc">판매자</td>
			  </tr>
			<?

			  include './dbcon.php';//db연결

				$category=$_POST['category'];
				$search=$_POST['search'];

				//db의 상품 목록에서 검색 조건에 맞는 상품들을 가져오는 질의문
				if($category=="all"){
					$query = "SELECT * FROM item WHERE product_name LIKE '%$search%' AND seller_ID IS NOT NULL ORDER BY score DESC LIMIT 10";
				} else{
					$query = "SELECT * FROM item WHERE category='$category' AND product_name LIKE '%$search%' AND seller_ID IS NOT NULL ORDER BY score DESC LIMIT 10";
				}

			  $result = mysqli_query($connect, $query);

				/*db에서 가져온 상품들 출력*/
			  while ($row = mysqli_fetch_array($result)) {
			?>
						<?
						/*출력된 상품들 구매페이지로 이동할 수 있는 버튼 생성*/
						?>
			      <td><form action="buy.php" method="post">
								<?/*다음 페이지로 로그인 된 아이디, 비밀번호, 구매자인지 판매자인지 확인하는 변수(login_check_info) 전달*/?>
							<input type='hidden' name='login_id' value=<?=$_POST['login_id']?>>
							<input type='hidden' name='login_pwd' value=<?=$_POST['login_pwd']?>>
							<input type='hidden' name='login_check_info' value=<?=$_POST['login_check_info']?>>
							<input type='hidden' name='item_num' value=<?=$row['item_num']?>>
							<CENTER><button type="submit">구매</button>
						</form></td>
			      <td><?=$row['product_name']?></td>
			      <td><?=$row['category']?></td>
			      <td><?=$row['seller_ID']?></td>
			    </tr>
			<?
			  }
			?>

		</div>
</div>
</body>
</html>
