<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

$blog_name = addslashes($blog_name);
$nick_name = addslashes($nick_name);
$blog_cont = addslashes($blog_cont);

$query = "select * from blog_list where user_id ='$_SESSION[p_id]' ";
$result = mysql_query($query, $connect);
$rows = mysql_fetch_array($result);
mysql_free_result($result);

if($rows){
  err_msg('�̹� ������ ��αװ� �����Ǿ� �ֽ��ϴ�.');
}
else{

    $blog_name = addslashes($blog_name);
	$nick_name = addslashes($nick_name);
	$blog_cont = addslashes($blog_cont);

	if($t_image_name){
	  $file_ext1 = substr(strrchr($t_image_name,"."), 1);
	  if ($file_ext1 != 'jpg' && $file_ext1 != 'gif' && $file_ext1 != 'jpeg' && $file_ext1 != 'bmp' ){
		 err_msg("�̹��� ���ϸ� �ø� �� �ֽ��ϴ�.");  
	  }
	  if (!$t_image_size) {
		 err_msg("������ ������ ���ų� ���� ũ�Ⱑ 0KB�Դϴ�.");  
	  }   
	}
    
	if (!file_exists('../upload/b_image/'.$_SESSION[p_id])){
	   if(!@mkdir("../upload/b_image/".$_SESSION[p_id],0777)) { 
		  err_msg('���͸��� ������ �� �����ϴ�. �۹̼��� Ȯ���ϼ���.');
		}
    } 

	if($t_image_name){
	   $savedir ="../upload/b_image/".$_SESSION[p_id];
	   $tmp_img = "blog_logo.".$file_ext1;
	   $blog_logo = "Y";
	   copy($t_image, "$savedir/$tmp_img");
	   unlink($t_image);
	}
	else{
	   $blog_logo = "N";
	}

	$blog_table   = "bg_".$_SESSION[p_id]."_t";
	$blog_c_table = "bg_".$_SESSION[p_id]."_ct";
	
	$db_r1= " CREATE TABLE $blog_table (
	num int(6) DEFAULT '0' NOT NULL auto_increment,
	brd_list_fk int(11) NOT NULL,
	id_fk varchar(12) NOT NULL,
	name varchar(30) NOT NULL,
	title varchar(200) NOT NULL,
	blog_img1 varchar(50),
	contents_1 text NOT NULL,
	blog_img2 varchar(50),
	contents_2 text NOT NULL,
	blog_img3 varchar(50),
	contents_3 text NOT NULL,
	comm_chk char(1) DEFAULT 'Y' NOT NULL,
	wdate varchar(8) NOT NULL,
	PRIMARY KEY (num)
	)";
	$dbcreate1 = mysql_query($db_r1,$connect);

	if(!$dbcreate1){
	  err_msg('��α� ���� �Խ��� ���̺� �������� ������ �߻��Ͽ����ϴ�.');
	}
	else{
		$db_r2= " CREATE TABLE $blog_c_table (
		cnum int(6) DEFAULT '0' NOT NULL auto_increment,
		num_fk int(11) NOT NULL,
		id_fk varchar(12) NOT NULL,
		memo text NOT NULL,
		cdate varchar(8) NOT NULL,
		PRIMARY KEY (cnum)
		)";
		$dbcreate2 = mysql_query($db_r2,$connect);
		if(!$dbcreate2){
		  err_msg('��α� �ΰ� �Խ��� ���̺� �������� ������ �߻��Ͽ����ϴ�.');
		}
	}


	$query = "INSERT INTO blog_list(user_id,nick_name,blog_name,blog_cont,blog_cdate) 
			   VALUES ('$_SESSION[p_id]','$nick_name','$blog_name','$blog_cont',now() )";
	$result = mysql_query($query,$connect);

    $query1  = "INSERT INTO blog_info(user_id,blog_logo,blog_logo_ty,view_chk) 
			    VALUES ('$_SESSION[p_id]','$blog_logo','$file_ext1','$view_chk' )";
	$result1 = mysql_query($query1,$connect);


	// ����������� ������ �߻��ϸ�
	if (!$result || !$result1) {      
	   err_msg('�����ͺ��̽� ������ �߻��Ͽ����ϴ�.');
	}
	else {
	   echo("<script>
	      window.alert('���������� ��αװ� �����Ǿ����ϴ�. !');
	      </script>");
	   echo "<meta http-equiv='Refresh' content='0; URL=/blog/blog_main.php?b_id=$_SESSION[p_id]'>"; 
	}
}
?>
