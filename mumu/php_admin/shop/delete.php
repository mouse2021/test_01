<?
// 아파치 인증
include	"../../php/auth.php";
// 데이타베이스 연결정보 및 기타설정
include	"../../php/config.php";
// 각종	유틸함수
include	"../../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

$query = "select * from products where num=$p_num";
$result = mysql_query($query, $connect);
$row = mysql_fetch_array($result);
mysql_free_result($result);
    
    
//작은 이미지가 있으면 삭제
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

// 해당데이타 삭제
$query = "delete from products where num=$p_num";
mysql_query($query, $connect);

// 리스트로 이동
echo ("<meta http-equiv='refresh' content='0; URL=list.php?level=$level&category_code_fk=$category_code_fk&page=$page&l_category_fk=$l_category_fk'>");
?>
