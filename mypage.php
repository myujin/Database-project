
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

		    <!--<p>가나다라마바사<p>-->
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
