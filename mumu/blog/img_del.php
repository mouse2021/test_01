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

$p_image = "../upload/b_image/".$b_id."/".$img_code.".".$img_ty;

if(file_exists($p_image)){
  unlink($p_image);
}

$qry1 = "update blog_info set $img_code = 'N' where user_id='$b_id' ";
$res1 = mysql_query($qry1,$connect);

//�� ���Ϸ� �ٽ� �̵�
echo ("<meta http-equiv='refresh' content='0; URL=blog_mng_form.php?b_id=$b_id'>");
?>
