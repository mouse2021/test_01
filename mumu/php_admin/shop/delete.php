<?
// ����ġ ����
include	"../../php/auth.php";
// ����Ÿ���̽� �������� �� ��Ÿ����
include	"../../php/config.php";
// ����	��ƿ�Լ�
include	"../../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

$query = "select * from products where num=$p_num";
$result = mysql_query($query, $connect);
$row = mysql_fetch_array($result);
mysql_free_result($result);
    
    
//���� �̹����� ������ ����
if($row[s_image]=='Y'){
  if(file_exists("../../upload/p_image/s/".$row[prod_code].".".$row[s_image_ty])){
        unlink("../../upload/p_image/s/".$row[prod_code].".".$row[s_image_ty]);
  }
}
if($row[m_image]=='Y'){
  if(file_exists("../../upload/p_image/m/".$row[prod_code].".".$row[m_image_ty])){
      unlink("../../upload/p_image/m/".$row[prod_code].".".$row[m_image_ty]);
  }
}
if($row[b_image]=='Y'){
  if(file_exists("../../upload/p_image/b/".$row[prod_code].".".$row[b_image_ty])){
      unlink("../../upload/p_image/b/".$row[prod_code].".".$row[b_image_ty]);
  }
}

// �ش絥��Ÿ ����
$query = "delete from products where num=$p_num";
mysql_query($query, $connect);

// ����Ʈ�� �̵�
echo ("<meta http-equiv='refresh' content='0; URL=list.php?level=$level&category_code_fk=$category_code_fk&page=$page&l_category_fk=$l_category_fk'>");
?>
