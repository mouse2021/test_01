<?
// 각종 유틸함수
include "../php/util.php";

if (!file_exists($p_image)){
  err_close('파일이 존재하지 않습니다.');
}
else{
  $a_size = getimagesize ($p_image);
  $width = $a_size[0];
  $height = $a_size[1];

  $new_width = $width + 70;
  $new_height = $height + 120;

}
?>
<html>
<head>
<title>이미지보기</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
</head>
<script language="JavaScript">
<!--
  function resize(){
    window.resizeTo(<?=$new_width?>,<?=$new_height?>);
  }
//-->
</script>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="10" marginwidth="0" marginheight="0" onload="resize()">

<table border="1" cellspacing="0" cellpadding="3" bordercolorlight="#000000" bordercolordark="#FFFFFF" align="center">
	<tr>
		<td align="center">
		<img src="<?=$p_image?>">
		</td>
	</tr>
	<tr>
		<td align="center">
		 <input type="button" onclick="javascript:self.close();" name="formbutton1" value="화면 닫기">
		</td>
	</tr>
</table>
</body>
</html>