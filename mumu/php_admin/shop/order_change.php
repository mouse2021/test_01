<?
// 아파치 인증
include	"../../php/auth.php";
// 데이타베이스 연결정보 및 기타설정
include	"../../php/config.php";
// 각종	유틸함수
include	"../../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

// 입금확인
if($mode=='1'){
  $update = "update mall_order set status='5' where num='$oid' ";
  $result = mysql_query($update,$connect);
}

//배송중
if($mode=='2'){
  $update = "update mall_order set status='7' where num='$oid' ";
  $result = mysql_query($update,$connect);
}

//배송완료
if($mode=='3'){
  
  $qry = "select * from mall_order where num='$oid' ";
  $res = mysql_query($qry,$connect);
  $rows = mysql_fetch_array($res);
  
  //마일리지 사용이 있을 경우
  if(((int)$rows[mileage_use] > 0) && ($rows[user_id] !='손님')){
    if($rows[status] !='8'){
	  $mile_amt = 0 - $rows[mileage_use];
      $ins1 = "insert into mileage(id_fk,mileage,mile_desc,wdate) 
	           values('$rows[user_id]','$mile_amt','상품구매시사용-$rows[orderid]',now())";
 	  mysql_query($ins1,$connect);
    }
  }

  //마일리지 추가가 있을 경우
  if(((int)$rows[mileage_add] > 0) && ($rows[user_id] !='손님')){
    if($rows[status] !='8'){
      $ins2 = "insert into mileage(id_fk,mileage,mile_desc,wdate) 
	           values('$rows[user_id]','$rows[mileage_add]','상품구매-$rows[orderid]',now())";
 	  mysql_query($ins2,$connect);
    }
  }
  
  $update = "update mall_order set status='8' where num='$oid' ";
  $result = mysql_query($update,$connect);
}

echo "<meta http-equiv='refresh' content='0; URL=order_read.php?oid=$oid'>";	
?>
 
