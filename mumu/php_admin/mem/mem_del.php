<?
//������ ���� ����
include "../../php/auth.php";
// ����Ÿ���̽� �������� �� ��Ÿ����
include "../../php/config.php";
// ���� ��ƿ�Լ�
include "../../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

$qry = "select * from member where seq_num='$m_num'";
$res = mysql_query($qry,$connect);
$rows = mysql_fetch_array($res);

$qry1  = "select * from blog_list where user_id='$rows[id]' ";
$res1  = mysql_query($qry1,$connect);
$rows1 = mysql_fetch_array($res1);

//���� ������ �����Ҷ� ���� ���� ����
if($rows1){
  
  $blog_t = "bg_".$rows[id]."_t";
  $blog_ct = "bg_".$rows[id]."_ct";
  
  $qry2 = "drop table $blog_t ";
  mysql_query($qry2);

  $qry3 = "drop table $blog_ct ";
  mysql_query($qry3);

  $qry4 = "delete from blog_list where user_id='$rows[id]' ";
  mysql_query($qry4);

  $qry5 = "delete from blog_info where user_id='$rows[id]' ";
  mysql_query($qry5);

  $qry6 = "delete from blog_brd_list where user_id='$rows[id]' ";
  mysql_query($qry6);


}

$qry7 = "delete from member where seq_num='$m_num'";
mysql_query($qry7,$connect);

echo("
    <script>
      window.alert('ȸ�� ������ �����Ǿ����ϴ�..')
    </script>
  ");
echo ("<meta http-equiv='refresh' content='0; URL=admin_member_list.php?page=$page'>");
?>
