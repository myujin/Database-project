<?php

if($_POST['stock']<$_POST['order_num']){
  echo "<script>alert('재고가 부족합니다.'); history.go(-1);</script>";
} else{
  
}
?>
