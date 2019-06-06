<?php

    include './dbcon.php';

    $id=$_POST['id'];
    $pwd=$_POST['pwd'];
    $check_info=$_POST['check_info'];
    $query;
    if ($check_info=='buyer'){
      $query="SELECT ID, PW, address from buyer where ID='$id'";
    } else{
      $query="SELECT ID, PW from seller where ID='$id'";
    }


    // echo $query;

    $result = mysqli_query($connect, $query);
    $num = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);

    if ($num) {
      if ($row['PW'] == $pwd) {
        echo "<form name='logged' action='./home.php' method='post'><input type='hidden' name='login_success' value='1'>";
        echo "<input type='hidden' name='login_id' value='$id'>";
        echo "<input type='hidden' name='login_pwd' value='$pwd'>";
        echo "<input type='hidden' name='login_check_info' value='$check_info'></form>>";


        if ($check_info=='buyer' && is_null($row['address'])){
            echo "<script>alert('로그인 성공');</script>";
            echo "<script>alert('회원정보 변경에서 주소를 입력하세요.');document.logged.submit();</script>";
        } else{
              echo "<script>alert('로그인 성공');document.logged.submit();</script>";
        }


      } else {
        echo "<script>alert('비번 오류'); history.go(-1);</script>";
      }
    } else {
      echo "<script>alert('해당 아이디가 존재하지 않음. 회원가입 먼저 하길 바람');history.go(-1);</script>";
    }

 ?>
