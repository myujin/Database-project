<?/*다음 페이지로 로그인 된 아이디, 비밀번호, 구매자인지 판매자인지 확인하는 변수(login_check_info) 전달*/?>


<?
/***change_user_info.php***/
/***역할: 이전페이지에서 입력받은 사용자 정보 변경사항을 db에 반영한다.***/
?>
<?php

include './dbcon.php';//db연결

/*이전 페이지의 정보들*/
/*(변경할 이름, 변경할 비밀번호, 변경할 비밀번호를 확인하는 비밀번호, 로그인 아이디,*/
/*구매자인지 판매자인지 확인하는 변수(login_check_info))*/

$Stock_new=$_POST['stock_new'];
$Price_new=$_POST['price_new'];
$PW_new=$_POST['PW_new'];
$Item_num=$_POST['item_num'];

$PW_origin=$_POST['login_pwd'];
$login_id=$_POST['login_id'];
$login_check_info=$_POST['login_check_info'];

/*변경할 비밀번호와 변경할 비밀번호를 확인하는 비밀번호가 같은 경우*/
if($PW_origin==$PW_new){
  /*사용자가 구매자인 경우 구매자의 비밀번호, 주소, 닉네임을 변경하는 질의문*/
  if($login_check_info=='seller'){
    $update_query="UPDATE item SET stock = '$Stock_new', price = '$Price_new', WHERE item_num = '$Item_num'";
  }
  /*사용자가 판매자인 경우 판매자의 비밀번호, 닉네임을 변경하는 질의문*/

  /*질의문을 사용하여 db의 사용자 데이터 변경*/
  $result=mysqli_query($connect, $update_query);
  if($result === false){
    echo mysqli_error($connect);
  } else{
    /*다음페이지로 아이디, 비밀번호, 구매자인지 판매자인지 확인하는 변수(login_check_info) 전달*/
    echo "<form name='logged' action='./mypage.php' method='post'>";
    echo "<input type='hidden' name='login_id' value='$login_id'>";
    echo "<input type='hidden' name='login_pwd' value='$PW_origin'>";
    echo "<input type='hidden' name='login_check_info' value='$login_check_info'></form>>";
    echo "<script>alert('상품 정보가 변경되었습니다.'); document.logged.submit();</script>";
  }
}

/*변경할 비밀번호와 변경할 비밀번호를 확인하는 비밀번호가 다른 경우*/
else{
  echo "<script>alert('접근 권한이 없습니다!'); history.go(-1);</script>";
}

?>
