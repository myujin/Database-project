<?

    include './dbcon.php';

    $bid = $_GET['id'];

    $query2 = "UPDATE board set count = count + 1 where id = '$bid'";
    mysqli_query($connect, $query2);

    $query="SELECT * FROM board where id = '$bid'";

    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);

?>

<script>
  function deldata() {
    location.href='./delete.php?id=<? echo $bid ?>';
  }
</script>

    <center><h2> 게시글 내용 보기 </h2></center>
    <form name="frm_content" method="post" action="update.php?uid=<? echo $bid; ?>">
      <table align="center" width= "400" border="1" cellspacing="0" cellpadding="5">
      <tr align="center">
        <td bgcolor="#cccccc">아이디</td>
        <td><? echo $row['id']; ?></td>
      </tr>
      <tr align="center">
        <td bgcolor="#cccccc">제목</td>
        <td><input type="text" name="b_title" value="<? echo $row['title']; ?>"></td>
      </tr>
      <tr align="center">
        <td bgcolor="#cccccc">글내용</td>
        <td><textarea name="b_content" rows="10" cols="30"><? echo $row['content']; ?></textarea></td>
      </tr>
      <tr align="center">
        <td bgcolor="#cccccc">글쓴이</td>
        <td><? echo $row['writer']; ?></td>
      </tr>
      <tr align="center">
        <td colspan="2" bgcolor="#cccccc">
            <input type="submit" value="수정">
            <input type="hidden" name="b_count" value="<? echo$row['count']?>">
            <input type="button" value="삭제" OnClick="deldata();">
        </td>
      </tr>
    </form>
