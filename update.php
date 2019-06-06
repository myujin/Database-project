<?php

    include './dbcon.php';

    $bid = $_GET['uid'];
    $title = $_POST['b_title'];
    $content = $_POST['b_content'];
    $count = $_POST['b_count'];

    $query="UPDATE board SET title = '$title', content = '$content', count = '$count' where id = '$bid'";
    mysqli_query($connect, $query);

    echo"
    <script>
    location.href='./main.php';
    </script>
    ";

 ?>
