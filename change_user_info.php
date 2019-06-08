<?php

include './dbcon.php';

$name_new=$_POST['name_new'];
$PW_new1=$_POST['PW_new1'];
$PW_new2=$_POST['PW_new2'];
$login_id=$_POST['login_id'];
$login_check_info=$_POST['login_check_info'];

if($PW_new1==$PW_new2){
  if($login_check_info=='buyer'){
    $address_new=$_POST['address_new'];

    $update_query="UPDATE buyer SET PW = '$PW_new1', address = '$address_new', name = '$name_new' WHERE ID = '$login_id'";
  } else{
    $update_query="UPDATE seller SET PW = '$PW_new1', name = '$name_new' WHERE ID = $login_id";
  }

  $result=mysqli_query($connect, $update_query);
  if($result === false){
    echo mysqli_error($connect);
  } else{
    echo "<form name='logged' action='./home.php' method='post'><input type='hidden' name='login_success' value='1'>";
    echo "<input type='hidden' name='login_id' value='$login_id'>";
    echo "<input type='hidden' name='login_pwd' value='$PW_new1'>";
    echo "<input type='hidden' name='login_check_info' value='$login_check_info'></form>>";
    echo "<script>alert('회원정보가 변경되었습니다.'); document.logged.submit();</script>";
  }
} else{
  echo "<script>alert('입력하신 두 비밀번호가 다릅니다.'); history.go(-1);</script>";
}

?>
