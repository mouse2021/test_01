<?
	########## �����ͺ��̽��� �����Ѵ�. ##########
	// ����Ÿ���̽� �������� �� ��Ÿ����
	include "../php/config.php";
	// ���� ��ƿ�Լ�
	include "../php/util.php";
	// MySQL ����
	$connect=my_connect($host,$dbid,$dbpass,$dbname);

	//ȸ�� ���̺��� ����Ȯ��
	$query="select * from member where id = '$id' and passwd='$pwd' ";
	$result = mysql_query($query, $connect);
	$rows = mysql_fetch_array($result);

   if(!$rows) {
	 // util �Լ��� err_msg �Լ� Ȱ��
 	 err_msg('�������� �ʴ� ȸ�� ID�̰ų� �н����尡 Ʋ���ϴ�!');
   }
   else{

	   $_SESSION["p_id"]    = $id;
	   $_SESSION["p_name"]  = $rows[name];
	   $_SESSION["p_email"] = $rows[email];
 
       //��ٱ��Ͽ� ��Ű ����
	   if(!$_COOKIE[member_sid]){ 
         $SID = md5(uniqid(rand()));
         SetCookie("p_sid",$SID,0,"/");   
       }
	  	 
     // �̵��� ������ ������ ���� ���
	 if($ret_url){
          echo("<meta http-equiv='Refresh' content='0; URL=$ret_url'>");

	 }
	 else{ // ���� ���
       echo("<meta http-equiv='Refresh' content='0; URL=/index.php'>");
	 }	
  }
?>
