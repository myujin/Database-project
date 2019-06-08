<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php

    include './dbcon.php';

    $id=$_POST['id'];
    $pwd=$_POST['pwd'];
    $name=$_POST['name'];
    $check_info=$_POST['check_info'];

    if ($check_info=='buyer'){
      $same_check_query="SELECT ID from buyer where ID='$id'";
      $same_check_result = mysqli_query($connect, $same_check_query);
      $same_check_num = mysqli_num_rows($same_check_result);

      if($same_check_num){
        echo "<script>alert('같은 아이디의 사용자가 있습니다.'); history.go(-1);</script>";
      } else{
          $insert_query="INSERT INTO buyer(ID, PW, name) VALUES ('$id', '$pwd', '$name')";
          $result=mysqli_query($connect, $insert_query);
          if($result === false){
            echo mysqli_error($connect);
          } else{
          echo "<script>alert('구매자 회원가입이 완료되었습니다.'); location.href='./login_form.html';</script>";
          }
      }

    } else{

      $same_check_query="SELECT ID from seller where ID='$id'";
      $same_check_result = mysqli_query($connect, $same_check_query);
      $same_check_num = mysqli_num_rows($same_check_result);

      if($same_check_num){
        echo "<script>alert('같은 아이디의 사용자가 있습니다.'); history.go(-1);</script>";
      } else{
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
