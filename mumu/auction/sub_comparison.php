<?
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

$scale1 = sizeof($prod_num);

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>PHPSAMPLE SITE</title>
<link rel="stylesheet" href="../common/global.css">
<script language="JavaScript" src="../common/global.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--

function opener_move(url){
   opener.location.href=url;
   self.close();
}

function initObj() {
  for ( i = 0; i < <?=$scale1?>; i++ ) {
	var sys_time = document.all['systime_' + i].value;
	var time = new Date(sys_time.substring(0,4), sys_time.substring(4,6) - 1, sys_time.substring(6,8), sys_time.substring(8,10), sys_time.substring(10,12), sys_time.substring(12,14));
	var to_time = document.all['totime_' + i].value;
	var time2 = new Date(to_time.substring(0,4), to_time.substring(4,6) - 1, to_time.substring(6,8), to_time.substring(8,10), to_time.substring(10,12), to_time.substring(12,14));
	document.all['clock2_' + i].value = time2 - time; 
  }
  clock();
}

function clock() {
 for ( i = 0; i < <?=$scale1?>; i++ ) {
  document.all['clock2_' + i].value = document.all['clock2_' + i].value - 1000;
  var current_time = document.all['clock2_' + i].value;
  var hh = Math.floor(((current_time)/1000/60/60));
  var m = Math.floor((((current_time)/1000/60/60) - hh)*60);
  var ss = Math.floor((((((current_time)/1000/60/60) - hh)*60) - m)*60);
  if(hh < 0 || m < 0 && ss < 0){
    document.all['clock1_' + i].value = "경매가 마감되었습니다."; 
  }
  else{
   document.all['clock1_' + i].value = hh + "시간 " + m + "분 " + ss + "초 남았습니다."; 
  }
 }
 setTimeout("clock()", 1000);
}
//-->
</script>
</head>
<body>
<br>
<table style="border-width:1; border-style:solid;" border="0" cellpadding="0" cellspacing="0" width="700">
  <tr>
    <td width="728" valign="top" >      
    <?
$a_prod_type['1'] = "신상품";
$a_prod_type['2'] = "중고상품";

$a_as_type['Y'] = "AS가능";
$a_as_type['N'] = "AS불가능";

$a_limit_type['1'] = "즉시구매 사용";
$a_limit_type['2'] = "즉시구매 없음";

$a_trans_type['1'] = "택배 본인부담(착불)";
$a_trans_type['2'] = "택배 경매자부담";
$a_trans_type['3'] = "빠른우편";
$a_trans_type['4'] = "직접수령";

     for($i=0;$i < sizeof($prod_num);$i++){
	   if($prod_num[$i]){

       $qry = "select * from auct_master where anum='$prod_num[$i]' ";
	   $res = mysql_query($qry,$connect);
	   $rows = mysql_fetch_array($res);
	  ?>
	  <table width="645" border="0" cellspacing="0" cellpadding="0">
       <tr> 
         <td width="340" align="center">
		 <?
		  if($rows[prod_img]){
		    $a_size = getimagesize ("../upload/a_image/".$rows[prod_img]);
            $width = $a_size[0];
            $height = $a_size[1];
			if($width > 300){
			  $width = "300";
			}
			if($height > 300){
			  $height = "300";
			}

		 ?>
		   <img src="/upload/a_image/<?=$rows[prod_img]?>" width="<?=$width?>" height="<?=$height?>" onerror="this.src='../img/noimage.gif'">
		 <? 
	       }
		 ?>
		 </td>
         <td valign="top"> 
		   <table width="90%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
              <td align="center" class="text5"><?=$rows[prod_name]?></td>
            </tr>
            <tr> 
              <td height="5" bgcolor="#585858"></td>
            </tr>
           </table>
           <br>
		   <table width="90%" border="0" cellspacing="0" cellpadding="0">
             <tr> 
              <td width="130"  class="line">경매 시작가격</td>
              <td class="line"> <?=number_format($rows[start_amt])?>원</td>
             </tr>
			 <tr> 
              <td width="130"  class="line">현재가격</td>
              <td class="line"> <?=number_format($rows[curr_amt])?>원</td>
             </tr>
             <tr> 
               <td  class="line">중고상품 유무</td>
               <td class="line"> <?=$a_prod_type[$rows[prod_type]]?> &nbsp;</td>
             </tr>
			 <tr> 
               <td  class="line">판매 가능지역</td>
               <td class="line"> <?=$rows[addr]?> &nbsp;</td>
             </tr>
			 <tr> 
               <td  class="line">즉시구매 여부</td>
               <td class="line"> <?=$a_limit_type[$rows[limit_type]]?> &nbsp;</td>
             </tr>
             <tr> 
               <td  class="line"> AS가능 여부</td>
               <td class="line"> <?=$a_as_type[$rows[as_type]]?> &nbsp;</td>
              </tr>
			  <tr> 
               <td  class="line"> 경매입찰 단위</td>
               <td class="line"> <?=number_format($rows[join_amt])?>원 </td>
              </tr>
			  <tr> 
               <td  class="line"> 총 판매수량</td>
               <td class="line"> <?=number_format($rows[total_cnt])?> 개</td>
              </tr>
			  <tr> 
               <td  class="line"> 운송방법</td>
               <td class="line"> <?=$a_trans_type[$rows[trans_type]]?> &nbsp;</td>
              </tr>
			  <form name="time_0" method="post">
			 <tr> 
              <td class="line" colspan="2" align=center> 
			  <?
			   if($rows[end_chk]=='Y'){
			     echo"종료된 경매입니다.";
		       }
			   else{
			   ?>
			    <input size="30" name="clock1_<?=$i?>" value="" style="border:0; color:e30000;" readonly  class="time">
			   <?
			     $endtime = $rows[auct_end]."0000";
			     $systime = date('YmdHis');
			   ?>
			    <input type="hidden" name="clock2_<?=$i?>" value="<?=$endtime?>">
				<input type="hidden" name="systime_<?=$i?>" value="<?=$systime?>">
				<input type="hidden" name="totime_<?=$i?>" value="<?=$endtime?>">
				<script> initObj(); </script>
			<? } ?>
			  </td>
             </tr>
			 </form>
			  <tr> 
               <td  colspan="2" align=center class="line">
			   <a href="javascript:opener_move('auct_details.php?anum=<?=$rows[anum]?>&l_code=<?=$rows[category_fk]?>')"><img src='../img/bt_go2.gif' border=0></a>
			   </td>
              </tr>
             </table>
	   	    </td>
           </tr>
          </table>
	   	  </td>
         </tr>
        </table>
         <br> 
	  <?
	    }
      }
	  ?>
	</td>
  </tr>
</table>
</body>
</html>