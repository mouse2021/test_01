<?
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
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
    document.all['clock1_' + i].value = "��Ű� �����Ǿ����ϴ�."; 
  }
  else{
   document.all['clock1_' + i].value = hh + "�ð� " + m + "�� " + ss + "�� ���ҽ��ϴ�."; 
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
$a_prod_type['1'] = "�Ż�ǰ";
$a_prod_type['2'] = "�߰��ǰ";

$a_as_type['Y'] = "AS����";
$a_as_type['N'] = "AS�Ұ���";

$a_limit_type['1'] = "��ñ��� ���";
$a_limit_type['2'] = "��ñ��� ����";

$a_trans_type['1'] = "�ù� ���κδ�(����)";
$a_trans_type['2'] = "�ù� ����ںδ�";
$a_trans_type['3'] = "��������";
$a_trans_type['4'] = "��������";

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
              <td width="130"  class="line">��� ���۰���</td>
              <td class="line"> <?=number_format($rows[start_amt])?>��</td>
             </tr>
			 <tr> 
              <td width="130"  class="line">���簡��</td>
              <td class="line"> <?=number_format($rows[curr_amt])?>��</td>
             </tr>
             <tr> 
               <td  class="line">�߰��ǰ ����</td>
               <td class="line"> <?=$a_prod_type[$rows[prod_type]]?> &nbsp;</td>
             </tr>
			 <tr> 
               <td  class="line">�Ǹ� ��������</td>
               <td class="line"> <?=$rows[addr]?> &nbsp;</td>
             </tr>
			 <tr> 
               <td  class="line">��ñ��� ����</td>
               <td class="line"> <?=$a_limit_type[$rows[limit_type]]?> &nbsp;</td>
             </tr>
             <tr> 
               <td  class="line"> AS���� ����</td>
               <td class="line"> <?=$a_as_type[$rows[as_type]]?> &nbsp;</td>
              </tr>
			  <tr> 
               <td  class="line"> ������� ����</td>
               <td class="line"> <?=number_format($rows[join_amt])?>�� </td>
              </tr>
			  <tr> 
               <td  class="line"> �� �Ǹż���</td>
               <td class="line"> <?=number_format($rows[total_cnt])?> ��</td>
              </tr>
			  <tr> 
               <td  class="line"> ��۹��</td>
               <td class="line"> <?=$a_trans_type[$rows[trans_type]]?> &nbsp;</td>
              </tr>
			  <form name="time_0" method="post">
			 <tr> 
              <td class="line" colspan="2" align=center> 
			  <?
			   if($rows[end_chk]=='Y'){
			     echo"����� ����Դϴ�.";
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