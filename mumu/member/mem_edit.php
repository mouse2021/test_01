<?
########## �����ͺ��̽��� �����Ѵ�. ##########
// ����Ÿ���̽� �������� �� ��Ÿ����
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

// �̸��� ���̵� �ش�Ǵ� ������ �����ϴ��� Ȯ��
if(!isset($_SESSION["p_id"]) || !isset($_SESSION["p_name"])){
  err_msg('�α��� ������ �����ϴ�. �ٽ� �α����� �ּ���.');
}
else{
   // ȸ�����̺��� ��������
   $qry = "select * from member where id='$_SESSION[p_id]' ";
   $res = mysql_query($qry,$connect);
   $rows = mysql_fetch_array($res);
}
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title>PHPSAMPLE SITE</title>
<link rel="stylesheet" href="../common/global.css">
<script language="JavaScript" src="../common/global.js"></script>
<script language="JavaScript" src="../common/member.js"></script>
</head>
<body>
<?  
//��� �޴� �κ��� ���Ͽ��� �ҷ��ɴϴ�.
include '../include/top_menu.php';  
?>
<br>
<table style="border-width:1; border-style:solid;" border="0" cellpadding="0" cellspacing="0" width="938">
  <tr>
    <td width="210" height="376" valign="top">
	  <?  
      //���� �α��� �κ��� ���Ͽ��� �ҷ��ɴϴ�.
      include '../include/left_login.php';  

      //������ ���� �޴��� ���Ͽ��� �ҷ��ɴϴ�.
      include '../include/main_left.php';  
      ?>
    </td>
    <td width="728" height="576" valign="top" >
       <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td height="30" style="padding:10 0 0 14px"><a href="/">Ȩ</a> 
              &gt; ȸ������ &gt; <a href="mem_edit.php">ȸ������</a></td>
          </tr>
        </table>
      <form name=form1 method=post action="mem_edit_post.php">
	   <table width="100%" border="0" cellspacing="1" cellpadding="2">
        <tr> 
         <td colspan=3 class=line-t height=1 bgcolor="#e1e1e1"></td>
        </tr>
        <tr> 
         <td class=line-n valign="top" bgcolor="#f8f8f7">���̵�</td>
         <td class="line"> 
           <?=$rows[id]?>
		 </td>
         <td rowspan="2"></td>
       </tr>
       <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7"> ��й�ȣ</td>
         <td class="line"> 
          <input type="password" name="passwd" size="16" value="<?=$rows[passwd]?>" class="InputStyle1" maxlength="10">
          <br>
          Ư������, ������ ������ �� ������<br>
          ��, �ҹ��ڸ� �����մϴ�.(5~10�� ����)</td>
          <td></td>
       </tr>
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> 
         ��й�ȣ ���Է�</td>
        <td class="line"> 
         <input type="password" name="passwd2" size="16" value="<?=$rows[passwd]?>"  class="InputStyle1">
        </td>
        <td></td>
       </tr>
       <tr> 
        <td class=line-n valign="top" bgcolor="f8f8f7"> �̸�</td>
        <td class="line"> 
          <input type="text" name="name" size="16" value="<?=$rows[name]?>" class="InputStyle1">
        </td>
        <td></td>
       </tr>
       <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">�ֹε�Ϲ�ȣ</td>
         <td class="line"> 
           <?=substr($rows[jnumber],0,6)?> - *******
         </td>
         <td></td>
        </tr>
        <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7">
         ���ڸ���</td>
         <td class="line"> 
          <input type="text" name="email" value="<?=$rows[email]?>" size="25"  class="InputStyle1">
         </td>
         <td></td>
        </tr>
		<?
	     // �����ȣ�� "-"�� �������� �����ϴ�.
         $a_zipno = explode("-",$rows[zipcode]);
	   ?>
        <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7"> 
          �����ȣ</td>
         <td class="line"> 
         <input type="text" name="zipcode1" size="3" value="<?=$a_zipno[0]?>" class="InputStyle1">
         - 
         <input type="text" name="zipcode2" size="3" value="<?=$a_zipno[1]?>" class="InputStyle1">
         <a href="javascript:ZipWindow('zip_search.php')">�����ȣ �˻�</a> 
         </td>
         <td></td>
        </tr>
        <tr> 
         <td class=line-n valign="top" bgcolor="f8f8f7"> �ּ�</td>
         <td class="line"> 
          <input type="text" name="address1" value="<?=$rows[address1]?>" size="35"  class="InputStyle1">
          (������ �Է�)<br>
          <input type="text" name="address2" value="<?=$rows[address2]?>" size="35"  class="InputStyle1" maxlength="50">
          (������ �Է�)</td>
          <td></td>
         </tr>
	   <?
	     // ��ȭ��ȣ�� "-"�� �������� �����ϴ�.
         $a_phone = explode("-",$rows[phone]);
	   ?>
         <tr> 
          <td class=line-n valign="top" bgcolor="f8f8f7"> 
          ��ȭ��ȣ</td>
          <td class="line"> 
           <input type="text" name="phone1" size="3" value="<?=$a_phone[0]?>" class="InputStyle1">
           - 
           <input type="text" name="phone2" size="4" value="<?=$a_phone[1]?>" class="InputStyle1">
           - 
           <input type="text" name="phone3" size="4" value="<?=$a_phone[2]?>"  class="InputStyle1">
           (���� �Ǵ� ȸ��)</td>
           <td></td>
          </tr>
	  <?
	     // �޴�����ȣ�� "-"�� �������� �����ϴ�.
         $a_hphone = explode("-",$rows[mobile]);
	   ?>
          <tr> 
           <td class=line-n valign="top" bgcolor="f8f8f7"> 
            �޴���</td>
           <td class="line"> 
            <select name="hphone1" class="InputStyle1">
		      <option value="">����</option>
              <option value="011" <? if($a_hphone[0] =='011') echo"selected"; ?> >011</option>
              <option value="016" <? if($a_hphone[0] =='016') echo"selected"; ?>>016</option>
              <option value="017" <? if($a_hphone[0] =='017') echo"selected"; ?>>017</option>
              <option value="018" <? if($a_hphone[0] =='018') echo"selected"; ?>>018</option>
              <option value="019" <? if($a_hphone[0] =='019') echo"selected"; ?>>019</option>
             </select>
             - 
             <input type="text" name="hphone2" size="4" value="<?=$a_hphone[1]?>" class="InputStyle1">
             - 
             <input type="text" name="hphone3" size="4" value="<?=$a_hphone[2]?>"  class="InputStyle1">
            </td>
            <td></td>
           </tr>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="10">
            <tr> 
             <td align="center">
			   <a href="javascript:checkEdit()"><img src="../img/butn_ok.gif" border="0"></a>
			   <a href="/index.php"><img src="../img/btn_cancel.gif" hspace="4" border="0"></a>
			 </td>
           </tr>
         </table>
	  </form>
	</td>
  </tr>
</table>
</body>
</html>
