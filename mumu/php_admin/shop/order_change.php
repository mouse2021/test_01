<?
// ����ġ ����
include	"../../php/auth.php";
// ����Ÿ���̽� �������� �� ��Ÿ����
include	"../../php/config.php";
// ����	��ƿ�Լ�
include	"../../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

// �Ա�Ȯ��
if($mode=='1'){
  $update = "update mall_order set status='5' where num='$oid' ";
  $result = mysql_query($update,$connect);
}

//�����
if($mode=='2'){
  $update = "update mall_order set status='7' where num='$oid' ";
  $result = mysql_query($update,$connect);
}

//��ۿϷ�
if($mode=='3'){
  
  $qry = "select * from mall_order where num='$oid' ";
  $res = mysql_query($qry,$connect);
  $rows = mysql_fetch_array($res);
  
  //���ϸ��� ����� ���� ���
  if(((int)$rows[mileage_use] > 0) && ($rows[user_id] !='�մ�')){
    if($rows[status] !='8'){
	  $mile_amt = 0 - $rows[mileage_use];
      $ins1 = "insert into mileage(id_fk,mileage,mile_desc,wdate) 
	           values('$rows[user_id]','$mile_amt','��ǰ���Žû��-$rows[orderid]',now())";
 	  mysql_query($ins1,$connect);
    }
  }

  //���ϸ��� �߰��� ���� ���
  if(((int)$rows[mileage_add] > 0) && ($rows[user_id] !='�մ�')){
    if($rows[status] !='8'){
      $ins2 = "insert into mileage(id_fk,mileage,mile_desc,wdate) 
	           values('$rows[user_id]','$rows[mileage_add]','��ǰ����-$rows[orderid]',now())";
 	  mysql_query($ins2,$connect);
    }
  }
  
  $update = "update mall_order set status='8' where num='$oid' ";
  $result = mysql_query($update,$connect);
}

echo "<meta http-equiv='refresh' content='0; URL=order_read.php?oid=$oid'>";	
?>
 
