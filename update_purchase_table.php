<?
/***update_purchase_table.php***/
/***역할: 상품 구매정보를 db에 반영한다.***/
?>

<?php

include './dbcon.php';//db연결

/*이전페이지로부터 정보 가져오기*/
$order_num=$_POST['order_num'];
$item_num=$_POST['item_num'];
$stock=$_POST['stock'];

/*판매자로 로그인 한 상태에서 구매할 경우*/
if($_POST['login_check_info']=='seller'){
  echo "<script>alert('판매자로 로그인 하신 상태입니다. 구매자로 로그인하십시오.'); history.go(-1);</script>";
}
/*구매자로 로그인 한 상태에서 구매할 경우*/
else{
  /*상품 구매 개수가 1보다 작을 경우 오류 메시지 출력과 이전 페이지로 이동*/
  if($order_num<1){
    echo "<script>alert('구매 수량을 다시 입력해 주세요.'); history.go(-1);</script>";
  }
  /*상품 구매 개수가 재고수보다 많은 경우 오류메시지 출력과 이전 페이지로 이동*/
  elseif($stock<$order_num){
    echo "<script>alert('재고가 부족합니다.'); history.go(-1);</script>";
  }
  /*상품의 구매 개수가 재고수보다 적고 1보다 큰 경우*/
  else{
    /*구매목록을 작성하는 질의문*/
    

    /*상품의 재고수를 변경하는 질의문*/
    $renew_stock_query = "UPDATE item SET stock = stock - $order_num WHERE item_num = $item_num";
    $renew_stock_result = mysqli_query($connect, $renew_stock_query);

    /*재고수 변경이 완료되었는지 확인*/
    /*재고수가 변경되지 않은 경우*/
    if($renew_stock_result === false){
      echo mysqli_error($connect);
    }
    /*재고수가 변경 완료된 경우 다음페이지로 아이디, 비밀번호,*/
    /*구매자인지 판매자인지 확인하는 변수(login_check_info) 전달 및 구매 완료 알리기.*/
    else{
      echo "<form name='buy_done' action='./home.php' method='post'>";
      echo "<input type='hidden' name='login_id' value='$_POST['login_id']'>";
      echo "<input type='hidden' name='login_pwd' value='$_POST['login_pwd']'>";
      echo "<input type='hidden' name='login_check_info' value='$_POST['login_check_info']'></form>>";
      echo "<script>alert('구매가 완료되었습니다.'); document.logged.submit();</script>";
    }
  }
}
?>
