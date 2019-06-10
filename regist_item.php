
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<html>
<head>
<title>상품 등록</title>
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

	<h1>상품 등록</h1>
	<div id="content">
		<section id="main-section">


    <h2>상품 등록</h2>
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
				<td><label>글쓴이</label></td>
			<?
				if ( $_POST['login_success'] ) {
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
		<tr><td colspan="2" align="center"><input type="submit" value="게시글 쓰기"/> &nbsp; <a href="./login_form.html">로그인</a></td></tr>
		</table>
		</form>
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
