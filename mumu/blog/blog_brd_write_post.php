<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('ȸ�� �α��� �� ����� �� �ֽ��ϴ�.');
}

if($_SESSION[p_id] != $b_id){
  err_msg('������ ��αװ� �ƴմϴ�. ��α� ������ Ȯ���ϼ���.');
}

$brd_title = addslashes($brd_title);

//�����϶�
if($md=='edit'){
	//�⺻���� ������Ʈ
	$up1 = "update blog_brd_list set brd_title = '$brd_title',
								     brd_pow_1 = '$brd_pow_1',
									 brd_pow_2 = '$brd_pow_2'
			where num = '$brd_num' ";
	$res1 = mysql_query($up1,$connect);

}
else{  //�߰��϶�
  
    $ins1 = "insert into blog_brd_list
	          (user_id,brd_title,brd_pow_1,brd_pow_2,brd_wdate)
	         values('$b_id','$brd_title','$brd_pow_1','$brd_pow_2',now())";
	$res1 = mysql_query($ins1,$connect);
    
}

if($res1) {    	 
    echo "<meta http-equiv='Refresh' content='0; URL=blog_brd_mng.php?b_id=$b_id'>"; 
}
else{
   err_msg('DB������ �߻��߽��ϴ�.');
}

?>
