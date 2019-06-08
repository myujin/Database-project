<?
/***change_user_info.php***/
/***역할: 이전페이지에서 입력받은 사용자 정보 변경사항을 db에 반영한다.***/
?>
<?php

include './dbcon.php';

/*이전 페이지의 정보들*/
/*(변경할 이름, 변경할 비밀번호, 변경할 비밀번호를 확인하는 비밀번호, 로그인 아이디,*/
/*구매자인지 판매자인지 확인하는 변수(login_check_info))*/
$name_new=$_POST['name_new'];
$PW_new1=$_POST['PW_new1'];
$PW_new2=$_POST['PW_new2'];
$login_id=$_POST['login_id'];
$login_check_info=$_POST['login_check_info'];

/*변경할 비밀번호와 변경할 비밀번호를 확인하는 비밀번호가 같은 경우*/
if($PW_new1==$PW_new2){
  /*사용자가 구매자인 경우 구매자의 비밀번호, 주소, 닉네임을 변경하는 질의문*/
  if($login_check_info=='buyer'){
    $address_new=$_POST['address_new'];
    $update_query="UPDATE buyer SET PW = '$PW_new1', address = '$address_new', name = '$name_new' WHERE ID = '$login_id'";
  }
  /*사용자가 판매자인 경우 판매자의 비밀번호, 닉네임을 변경하는 질의문*/
  else{
    $update_query="UPDATE seller SET PW = '$PW_new1', name = '$name_new' WHERE ID = $login_id";
  }

  /*질의문을 사용하여 db의 사용자 데이터 변경*/
  $result=mysqli_query($connect, $update_query);
  if($result === false){
    echo mysqli_error($connect);
  } else{
    /*다음페이지로 아이디, 비밀번호, 구매자인지 판매자인지 확인하는 변수(login_check_info) 전달*/
    echo "<form name='logged' action='./home.php' method='post'>";
    echo "<input type='hidden' name='login_id' value='$login_id'>";
    echo "<input type='hidden' name='login_pwd' value='$PW_new1'>";
    echo "<input type='hidden' name='login_check_info' value='$login_check_info'></form>>";
    echo "<script>alert('회원정보가 변경되었습니다.'); document.logged.submit();</script>";
  }
}

/*변경할 비밀번호와 변경할 비밀번호를 확인하는 비밀번호가 다른 경우*/
else{
  echo "<script>alert('입력하신 두 비밀번호가 다릅니다.'); history.go(-1);</script>";
}

?>
