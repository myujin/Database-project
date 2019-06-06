<?php

    include './dbcon.php';

    $title = $_POST['b_title'];
    $contents = $_POST['b_content'];
    $uid = $_POST['b_writer'];
    $contents = nl2br($contents);

    $query="INSERT into board(title, content, writer, count) values('$title', '$contents', '$uid', 0)";

    mysqli_query($connect, $query);

    echo "<script>alert('게시글이 작성되었습니다.'); location.href='./main.php';</script>";

 ?>
