<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('회원 로그인 후 사용할 수 있습니다.');
}

if($_SESSION[p_id] != $b_id){
  err_msg('본인의 블로그가 아닙니다. 블로그 정보를 확인하세요.');
}

$p_image = "../upload/b_image/".$b_id."/".$img_code.".".$img_ty;

if(file_exists($p_image)){
  unlink($p_image);
}

$qry1 = "update blog_info set $img_code = 'N' where user_id='$b_id' ";
$res1 = mysql_query($qry1,$connect);

//원 파일로 다시 이동
echo ("<meta http-equiv='refresh' content='0; URL=blog_mng_form.php?b_id=$b_id'>");
?>
