<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!$_SESSION[p_id]){
  $wid_fk = "��ȸ��";
}
else{
  $wid_fk = $_SESSION[p_id];
}

$qry1  = "select * from blog_list a ,blog_info b 
          where a.user_id='$b_id' And
                a.user_id=b.user_id ";
$res1  = mysql_query($qry1,$connect);
$rows1 = mysql_fetch_array($res1);

if(!$rows1){
  err_msg('��α� ������ �������� �ʽ��ϴ�.');
}

//�ش� ���̺�
$blog_ct = "bg_".$b_id."_ct";

if($md=='insert'){

	$memo     = addslashes($memo);
    $ndate    = date('Ymd');

	$ins1 = "insert into $blog_ct 
	           ( num_fk,id_fk,memo,cdate)
			  values('$brd_num','$wid_fk','$memo','$ndate')";
	$res1 = mysql_query($ins1,$connect);
    
	if($res1) {    	 
	  msg('������ ��ϵǾ����ϴ�.');
	  if($ret_url){
	    $url = $ret_url."?b_id=".$b_id."&page=".$page."&dt=".$dt."&s_val=".$s_val."&b_nm=".$b_nm."&md1=view&brd_num=".$brd_num;
		echo "<meta http-equiv='Refresh' content='0; URL=$url'>"; 
	  }
	  else{
	    echo "<meta http-equiv='Refresh' content='0; URL=blog_tlist.php?b_id=$b_id&page=$page&s_val=$s_val&dt=$dt&md1=view&brd_num=$brd_num'>"; 
	  }
	}
	else{
	   err_msg('DB������ �߻��߽��ϴ�.');
	}
}
else if($md=='delete'){
      
	//��� ����
	$del = "delete from $blog_ct where cnum = '$del_num' ";
	$res = mysql_query($del,$connect);

    if($res) {    	 
	  msg('������ �����Ǿ����ϴ�.');
	  if($ret_url){
	    $url = $ret_url."?b_id=".$b_id."&page=".$page."&dt=".$dt."&s_val=".$s_val."&b_nm=".$b_nm."&md1=view&brd_num=".$brd_num;
		echo "<meta http-equiv='Refresh' content='0; URL=$url'>"; 
	  }
	  else{
	    echo "<meta http-equiv='Refresh' content='0; URL=blog_tlist.php?b_id=$b_id&page=$page&s_val=$s_val&dt=$dt&md1=view&brd_num=$brd_num'>"; 
	  }
	}
	else{
	   err_msg('�������� DB������ �߻��߽��ϴ�.');
	}
}
?>
