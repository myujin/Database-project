<?
/***sign_up.php***/
/***역할: db에서 사용자 회원가입 정보를 저장***/
?>
<?php

    include './dbcon.php';//db연결

    $id=$_POST['id'];
    $pwd=$_POST['pwd'];
    $name=$_POST['name'];
    $check_info=$_POST['check_info']; //구매자인지 판매자인지 확인하는 변수

    /*사용자로 회원가입한 경우*/
    if ($check_info=='buyer'){

      /*db에 회원가입한 아이디와 같은 아이디가 있을 경우 아이디를 가져오는 질의문*/
      $same_check_query="SELECT ID from buyer where ID='$id'";
      $same_check_result = mysqli_query($connect, $same_check_query);
      $same_check_num = mysqli_num_rows($same_check_result);

      /*회원가입하려는 아이디와 같은 아이디가 있을 경우 오류 출력*/
      if($same_check_num){
        echo "<script>alert('같은 아이디의 사용자가 있습니다.'); history.go(-1);</script>";
      }
      /*회원가입하려는 아이디와 같은 아이디가 없을 경우 db에 회원가입 정보 저장*/
      else{
          /*db에 회원가입 정보 저장하는 질의문*/
          $insert_query="INSERT INTO buyer(ID, PW, name) VALUES ('$id', '$pwd', '$name')";
          $result=mysqli_query($connect, $insert_query);
          if($result === false){
            echo mysqli_error($connect);
          } else{
          echo "<script>alert('구매자 회원가입이 완료되었습니다.'); location.href='./login_form.html';</script>";
          }
      }
    }
    /*판매자로 회원가입한 경우*/
    else{

      /*db에 회원가입한 아이디와 같은 아이디가 있을 경우 아이디를 가져오는 질의문*/
      $same_check_query="SELECT ID from seller where ID='$id'";
      $same_check_result = mysqli_query($connect, $same_check_query);
      $same_check_num = mysqli_num_rows($same_check_result);

      /*회원가입하려는 아이디와 같은 아이디가 있을 경우 오류 출력*/
      if($same_check_num){
        echo "<script>alert('같은 아이디의 사용자가 있습니다.'); history.go(-1);</script>";
      }
      /*회원가입하려는 아이디와 같은 아이디가 없을 경우 db에 회원가입 정보 저장*/
      else{
          /*db에 회원가입 정보 저장하는 질의문*/
          $insert_query="INSERT INTO seller(ID, PW, name) VALUES ('$id', '$pwd', '$name')";
          $result=mysqli_query($connect, $insert_query);
          if($result === false){
            echo mysqli_error($connect);
          } else{
          echo "<script>alert('판매자 회원가입이 완료되었습니다.'); location.href='./login_form.html';</script>";
          }
      }

    }

?>
