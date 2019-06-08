<?
/***login.php***/
/***역할: db에서 사용자 정보를 가져와 이전 페이지에서 받은 로그인 정보와 비교 후 로그인 성공 여부 결정***/
?>
<?php

    include './dbcon.php';//db연결

    $id=$_POST['id'];
    $pwd=$_POST['pwd'];
    $check_info=$_POST['check_info'];//구매자인지 판매자인지 확인하는 변수
    $query;

    /*이전 페이지에서 전달받은 아이디와 같은 아이디의 사용자 아이디, 비밀번호, (구매자의 경우)주소를 db에서 가져오는 질의문*/
    if ($check_info=='buyer'){
      $query="SELECT ID, PW, address from buyer where ID='$id'";
    } else{
      $query="SELECT ID, PW from seller where ID='$id'";
    }

    $result = mysqli_query($connect, $query);
    $num = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);

    /*db에 이전 페이지에서 전달받은 아이디와 같은 아이디가 있을 경우*/
    if ($num) {
      /*전달받은 아이디와 본인의 아이디가 같은 사용자의 비밀번호가 같을 경우*/
      if ($row['PW'] == $pwd) {
        /*다음페이지로 로그인 된 아이디, 비밀번호, 구매자인지 판매자인지 확인하는 변수(login_check_info) 전달*/
        echo "<form name='logged' action='./home.php' method='post'>";
        echo "<input type='hidden' name='login_id' value='$id'>";
        echo "<input type='hidden' name='login_pwd' value='$pwd'>";
        echo "<input type='hidden' name='login_check_info' value='$check_info'></form>>";

        /*구매자의 경우 주소가 입력되어있지 않으면 주소를 입력하라는 메시지 출력*/
        if ($check_info=='buyer' && is_null($row['address'])){
            echo "<script>alert('로그인 성공');</script>";
            echo "<script>alert('회원정보 변경에서 주소를 입력하세요.');document.logged.submit();</script>";
        } else{
              echo "<script>alert('로그인 성공');document.logged.submit();</script>";
        }

      }
      /*전달받은 아이디와 본인의 아이디가 같은 사용자의 비밀번호가 같을 경우*/
      else {
        echo "<script>alert('비번 오류'); history.go(-1);</script>";
      }
    }
    /*db에 이전 페이지에서 전달받은 아이디와 같은 아이디가 있을 경우*/
    else {
      echo "<script>alert('해당 아이디가 존재하지 않음. 회원가입 먼저 하길 바람');history.go(-1);</script>";
    }

 ?>
