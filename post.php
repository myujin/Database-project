<?php

    include './dbcon.php';

    $title = $_POST['b_title'];
    $contents = $_POST['b_content'];
    $uid = $_POST['b_writer'];
    $id=$_POST['login_id'];
    $pwd=$_POST['login_pwd'];
    $check_info=$_POST['login_check_info'];//구매자인지 판매자인지 확인하는 변수
    $category=$_POST['category'];
    $stock=$_POST['stocks'];
    $price=$_POST['price'];
    $score=$_POST['score'];
    $contents = nl2br($contents);

    $query="INSERT into item(product_name, contents,category,seller_ID, stock,price,score) values('$title', '$contents','$category' ,'$id','$stock',$price','$score')";

    $result=mysqli_query($connect, $query);

    echo "<form name='logged' action='./item.php';  method='post'>";
    echo "<input type='hidden' name='login_id' value='$id'>";
    echo "<input type='hidden' name='login_pwd' value='$pwd'>";
    echo "<input type='hidden' name='login_check_info' value='$check_info'></form>>";

    echo "<script>alert('게시글이 작성되었습니다.');document.logged.submit();</script>";
 ?>
