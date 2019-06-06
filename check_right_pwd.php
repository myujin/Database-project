<?php

    include './dbcon.php';

    if($_POST['login_pwd']==$_POST['PW_old']){
      echo "<form name='right_pwd' action='./change_user_info.html' method='post'>";
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
