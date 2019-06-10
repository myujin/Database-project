<?
/***item.php***/
/***역할: (추가) ***/
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<html>
<head>
<title>판매 상품 목록</title>
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

	<h1>판매 상품 목록</h1>
	<div id="content">
		<section id="main-section">


    <h2>이번 주 랭킹</h2>
		이번 주에 가장 많이 판매된 상품입니다.

		<h2>내 상품 등록하기</h2>
		<form action='./post.php' name='post_table' method='post'>
		<br>
		<br>
		<CENTER>게시판 TEST</b></div><br>
		<table border="1">
			<tr>
				<td><label>제목</label></td><td><input type="text" name="b_title" class="box"/></td>
			</tr>
			<tr>
				<td><label>내용</label></td><td><textarea name="b_content" rows="10" cols="30"></textarea></td>
			</tr>
			<tr>
				<td><label>카테고리</label></td><td><input type="text" name="category" class="box"/></td>
			</tr>
			<tr>
				<td><label>재고 수</label></td><td><input type="text" name="stocks" class="box"/></td>
			</tr>
			<tr>
				<td><label>가격</label></td><td><input type="text" name="price" class="box"/></td>
			</tr>
			<tr>
				<td><label>점수</label></td><td><input type="text" name="score" class="box"/></td>
			</tr>
			<tr>
				<td><label>글쓴이</label></td>
			<?
				if ( $_POST['login_check_info'] ) {
			?>
					<td><?=$_POST['login_id']?><input type="hidden" name="b_writer" value="<?=$_POST['login_id']?>"></td>
				</tr>
			<?
				} else {
			?>
					<td><input type="text" name="b_writer" class="box"/></td>
			<?
				}
			?>
			<input type='hidden' name='login_id' value=<?=$_POST['login_id']?>>
			<input type='hidden' name='login_pwd' value=<?=$_POST['login_pwd']?>>
			<input type='hidden' name='login_check_info' value=<?=$_POST['login_check_info']?>>
		<tr><td colspan="2" align="center"><input type="submit" value="게시글 쓰기"/> &nbsp;</td></tr>
		</table>
		</form>

		<br><br>
		<h2> 게시판 </h2>
		<table width= "800" border="1" cellspacing="0" cellpadding="5">
		<tr align="center">
			<td bgcolor="#cccccc">번호</td>
			<td bgcolor="#cccccc">제목</td>
			<td bgcolor="#cccccc">글쓴이</td>
			<td bgcolor="#cccccc">조회수</td>
		</tr>
	<?

		include './dbcon.php';

		$query = "SELECT * from purchase order by id desc limit 5";

		$result = mysqli_query($connect, $query);

		while ($row = mysqli_fetch_array($result)) {
	?>
				<td><a href="content.php?id=<?=$row['id']?>"><?=$row['id']?></a></td>
				<td><?=$row['title']?></td>
				<td><?=$row['writer']?></td>
				<td><?=$row['count']?></td>
			</tr>
	<?
		}
	?>
			</section>

			<aside id="main-aside">
			<footer>
			<h2>Contact</h2>
      <p>회사 위치</p>
      <p>myujin3927@gmail.com</p>
      <p>대표: 이도영</p>
			</footer>
	</aside>
</div>
		</body>
	</div>
</html>
