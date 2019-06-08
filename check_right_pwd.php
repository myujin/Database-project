<?php

    include './dbcon.php';

    $login_id=$_POST['login_id'];

    if($_POST['login_pwd']==$_POST['PW_old']){
      if($_POST['login_check_info']=='buyer'){
        echo "<form name='right_pwd' action='./change_buyer_info.html' method='post'>";
        $query="SELECT name from buyer where ID='$login_id'";
      } else{
        echo "<form name='right_pwd' action='./change_seller_info.html' method='post'>";
        $query="SELECT name from seller where ID='$login_id'";
      }

      $result = mysqli_query($connect, $query);
      $row = mysqli_fetch_array($result);

      echo "<input type='hidden' name='name' value='{$row['name']}'>";
      echo "<input type='hidden' name='login_id' value='{$_POST['login_id']}'>";
      echo "<input type='hidden' name='login_pwd' value='{$_POST['login_pwd']}'>";
      echo "<input type='hidden' name='login_check_info' value='{$_POST['login_check_info']}'></form>";
      echo "<script>document.right_pwd.submit();</script>";
    }
    else{
      echo "<form name='wrong_pwd' method='post'>";
      echo "<input type='hidden' name='login_id' value='{$_POST['login_id']}'>";
      echo "<input type='hidden' name='login_pwd' value='{$_POST['login_pwd']}'>";
      echo "<input type='hidden' name='login_check_info' value='{$_POST['login_check_info']}'></form>";

      echo "<script>alert('비번 오류');history.go(-1);</script>";
    }

 ?>
