<?
// ����ġ ����
include	"../../php/auth.php";
// ����Ÿ���̽� �������� �� ��Ÿ����
include	"../../php/config.php";
// ����	��ƿ�Լ�
include	"../../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);


if($mode=='del'){
  // �ش絥��Ÿ �˻�
  $update = "update products set $ck = 'N' where num=$p_num ";
  $result = mysql_query($update,$connect);
} 

if($mode=='insert'){
   $update = "update products set $ck = 'Y' where num=$p_num ";
   $result = mysql_query($update,$connect);
}
if($result){    
  echo("
      <script>
	    window.alert('������ �����Ǿ����ϴ�.')
	   </script>
   ");
   echo "<meta http-equiv='Refresh' content='0; URL=list.php?level=$level&category_code_fk=$category_code_fk&page=$page&l_category_fk=$l_category_fk'>"; 
}
else{
     err_msg('DB������ �߻��߽��ϴ�.');
}
?>
