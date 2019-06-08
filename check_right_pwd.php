<?
/***check_right_pwd.php***/
/***역할: 이전페이지에서 입력받은 비밀번호가 사용자의 비밀번호인지 검사.
          사용자의 비밀번호가 맞다면 ***/
?>
<?php

    include './dbcon.php'; //db연결

    $login_id=$_POST['login_id'];

    /*이전페이지에서 입력받은 비밀번호(PW_old)가 사용자의 비밀번호와 같은 경우*/
    if($_POST['login_pwd']==$_POST['PW_old']){

      /*다음 페이지에서 원래 닉네임 데이터를 사용하기 위하여 db에서 사용자의 닉네임을 가져온다.*/
      if($_POST['login_check_info']=='buyer'){
        echo "<form name='right_pwd' action='./change_buyer_info.html' method='post'>";
        $query="SELECT name from buyer where ID='$login_id'";//구매자의 닉네임을 가져오는 질의문
      } else{
        echo "<form name='right_pwd' action='./change_seller_info.html' method='post'>";
        $query="SELECT name from seller where ID='$login_id'";//판매자의 닉네임을 가져오는 질의문
      }

      $result = mysqli_query($connect, $query);
      $row = mysqli_fetch_array($result);

      /*다음 페이지로 db에서 가져온 닉네임, 아이디, 비밀번호, 구매자인지 판매자인지 확인하는 변수(login_check_info)를 전달한다.*/
      echo "<input type='hidden' name='name' value='{$row['name']}'>";
      echo "<input type='hidden' name='login_id' value='{$_POST['login_id']}'>";
      echo "<input type='hidden' name='login_pwd' value='{$_POST['login_pwd']}'>";
      echo "<input type='hidden' name='login_check_info' value='{$_POST['login_check_info']}'></form>";
      echo "<script>document.right_pwd.submit();</script>";
    }

    /*이전페이지에서 입력받은 비밀번호(PW_old)가 사용자의 비밀번호와 다른 경우*/
    else{
      echo "<form name='wrong_pwd' method='post'>";
      echo "<script>alert('비번 오류');history.go(-1);</script>";
    }

 ?>
