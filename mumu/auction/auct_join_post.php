<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);
end_exe($connect);
if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('ȸ�� �α��� �� ����� �� �ֽ��ϴ�.');
}

$query = "select * from auct_master where anum=$anum";
$result = mysql_query($query, $connect);
$rows = mysql_fetch_array($result);
mysql_free_result($result);

if(!$rows){
  err_msg('��� �ڵ忡 ���ϴ� ��Ű� �������� �ʽ��ϴ�.');
}

if($rows[end_chk]=='Y'){
  err_msg('�̹� ����� ����Դϴ�.');
}

//�Ϲ� �����̸鼭 �ﱸ���� �Է����� ���
if($gb=='1' && ($rows[limit_type]=='1') && ($join_amt == $rows[limit_amt])){
  $gb = "2";
}

//��� �����϶�
if($gb=='2'){
  
   $limit_cnt_1 = $rows[limit_cnt] + $join_cnt;
   if($limit_cnt_1 > $rows[total_cnt]){
     err_msg('���� �����ִ� ������ ��û�������� �����ϴ�. ��û������ �����ϼ���.');
   }
   else{
      
	  //��û������ �� ������ ������ �������
	  if($limit_cnt_1 == $rows[total_cnt] ){
	    $end_qry = " , end_chk = 'Y' ";
	  }

	  $qry1 = "update auct_master set join_cnt  = join_cnt + $join_cnt ,
	                                  limit_cnt = limit_cnt + $join_cnt 
								      $end_qry
				where anum = '$anum' ";
	  $res1 = mysql_query($qry1,$connect);

	  if(!$res1){
	    err_msg('������ �߻��Ͽ����ϴ�. ');
	  }
	  else{
	     $qry2 = "insert into auct_master_join(auction_code_fk,join_gb,user_id,
		              amount,volume,join_created)
				  values('$anum','1','$_SESSION[p_id]','$join_amt',
						  '$join_cnt',now())";
		 $res2 = mysql_query($qry2,$connect);
	     
         if(!$res2){
	        err_msg('������ �߻��Ͽ����ϴ�.');
	     }
		 else{
			echo("
			   <script>
				window.alert('��Ž�û�� �Ǿ����ϴ�. Ȯ���� ��ű�Ͽ��� �����մϴ�.')
			   </script>
			");
		    echo "<meta http-equiv='Refresh' content='0; URL=auct_details.php?anum=$anum'>"; 
		 }
	  }
   }
}
else {  //�Ϲ��϶�
  
    //��û���� �����ּ� ������ ������ ���簡�� ��û���� �մϴ�.
    if($join_amt_1 == $join_amt){
      $join_amt_qry = " , curr_amt = '$join_amt' ";
    }
   
    $qry1 = "update auct_master set join_cnt  = join_cnt + $join_cnt
	                                $join_amt_qry 
			where anum = '$anum' ";
    $res1 = mysql_query($qry1,$connect);

	if(!$res1){
	   err_msg('������ �߻��Ͽ����ϴ�. ');
	}
	else{
	    $qry2 = "insert into auct_master_join(auction_code_fk,join_gb,user_id,
		              amount,volume,join_created)
		  	     values('$anum','2','$_SESSION[p_id]','$join_amt',
						  '$join_cnt',now())";
   	    $res2 = mysql_query($qry2,$connect);
	     
        if(!$res2){
	        err_msg('������ �߻��Ͽ����ϴ�.');
	    }
		else{
			echo("
			   <script>
				window.alert('��Ž�û�� �Ǿ����ϴ�. Ȯ���� ��ű�Ͽ��� �����մϴ�.')
			   </script>
			");
		    echo "<meta http-equiv='Refresh' content='0; URL=auct_details.php?anum=$anum'>"; 
		}
    }
}
?>
