<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('�α��� �� �̿��� �� �ֽ��ϴ�.');
}

// �Խù� ���
if($md =='write'){
	$subject  = addslashes($subject);
	$contents = addslashes($contents);

	$qry1 = "insert into auct_board(user_id,auction_code_fk,subject,contents,wdate)
			 values('$_SESSION[p_id]','$anum','$subject','$contents',now())";
	$res1 = mysql_query($qry1,$connect);

	if($res1){
		 echo("
		  <script>
			window.alert('������ ��ϵǾ����ϴ�.')
		   </script>
		 ");
		 echo "<meta http-equiv='Refresh' content='0; URL=auct_brd_list.php?anum=$anum'>";

	}
	else{
		err_msg('�Խù� ��ϵ��� ������ �߻��߽��ϴ�.');
	}
}
else if($md =='memo'){  //�Խù��� ���� ���(���) ���
    $memo  = addslashes($memo);
    
	//���뿡 ���� ����� ���
	$qry1 = "insert into auct_board_memo(user_id,board_num_fk,memo,wdate)
			 values('$_SESSION[p_id]','$brd_num','$memo',now())";
	$res1 = mysql_query($qry1,$connect);

	if($res1){
         
		 $qry2 = "update auct_board set re_cnt = re_cnt + 1 where num='$brd_num' ";
		 $res2 = mysql_query($qry2,$connect);

		 if($res2){
			 echo("
			  <script>
				window.alert('������ ��ϵǾ����ϴ�.')
			   </script>
			 ");
			 echo "<meta http-equiv='Refresh' content='0; URL=auct_brd_view.php?anum=$anum&brd_num=$brd_num'>";
		 }
		 else{
		   err_msg('�Խù� ������Ʈ ���� ������ �߻��߽��ϴ�.');
		 }
	}
	else{
		err_msg('�Խù� ��ϵ��� ������ �߻��߽��ϴ�.');
	}
}
?>
