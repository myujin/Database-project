<?php

    include './dbcon.php';

    $bid = $_GET['id'];

    $query="DELETE from board where id = '$bid'";
    mysqli_query($connect, $query);

    echo"
    <script>
    location.href='./main.php';
    </script>
    ";

 ?>
