
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<html>
<head>
<title>게시판</title>
</head>
<body>

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

  $query = "SELECT * from board order by id desc limit 5";

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
</body>
</html>
