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
		
	$qry1 = "delete from auct_board where num='$brd_num'";
	$res1 = mysql_query($qry1,$connect);

	$qry2 = "delete from auct_board_memo where board_num_fk='$brd_num'";
	$res2 = mysql_query($qry2,$connect);

	if($res1 && $res2){
		 echo("
		  <script>
			window.alert('������ �����Ǿ����ϴ�.')
		   </script>
		 ");
		 echo "<meta http-equiv='Refresh' content='0; URL=auct_brd_list.php?anum=$anum'>";

	}
	else{
		err_msg('�Խù� �������� ������ �߻��߽��ϴ�.');
	}
}
else if($md =='memo'){  //�Խù��� ���� ���(���) ���
    
	$qry1 = "delete from auct_board_memo where mnum='$m_num'";
	$res1 = mysql_query($qry1,$connect);

	if($res1){
         
		 $qry2 = "update auct_board set re_cnt = re_cnt - 1 where num='$brd_num' ";
		 $res2 = mysql_query($qry2,$connect);

		 if($res2){
			 echo("
			  <script>
				window.alert('������ �����Ǿ����ϴ�.')
			   </script>
			 ");
			 echo "<meta http-equiv='Refresh' content='0; URL=auct_brd_view.php?anum=$anum&brd_num=$brd_num'>";
		 }
		 else{
		   err_msg('�Խù� ������Ʈ ���� ������ �߻��߽��ϴ�.');
		 }
	}
	else{
		err_msg('�Խù� �������� ������ �߻��߽��ϴ�.');
	}
}
?>
