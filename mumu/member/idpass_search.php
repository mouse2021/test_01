<?
########## �����ͺ��̽��� �����Ѵ�. ##########
// ����Ÿ���̽� �������� �� ��Ÿ����
include "../php/config.php";
// ���� ��ƿ�Լ�
include "../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);
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
    <td width="728" height="576" valign="top" align=center >
       <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td height="30" style="padding:10 0 0 14px"><a href="/">Ȩ</a> 
              &gt; ȸ������ &gt; <a href="../member/.php">���̵� �н����� ã��</a></td>
          </tr>
        </table>
        <table width="92%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td style="padding:7 0 6 10px"  bgcolor="F5F6F1">���̵� ã�� : </td>
          </tr>
        </table>
        <table width="92%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FAFAFA">
          <tr> 
            <td valign="top" > <br>
              <table width="90%" border="0" cellspacing="2" cellpadding="2">
                <form name=form1 method=post action="id_search_result.php">
				<tr> 
                  <td width="38%" align="right"><b>�̸�</b></td>
                  <td width="62%"> 
                    <input type="text" name="name" size="18" class="InputStyle1">
                  </td>
                </tr>
                <tr> 
                  <td width="38%" align="right"><b>�ֹι�ȣ</b></td>
                  <td width="62%"> 
                    <input class="InputStyle1"  size=7 name="jumin1" OnKeyUp="focus_move();">
                    - 
                    <input class="InputStyle1"  size=7 name="jumin2" >
                  </td>
                </tr>
                <tr> 
                  <td width="38%" align="right">&nbsp;</td>
                  <td width="62%"><a href="javascript:lost_checkInput1();"><img src="../img/butn_ok.gif" border="0"></a><a href="/index.php"><img src="../img/btn_cancel.gif" hspace="4" border="0"></a></td>
                </tr>
				</form>
              </table>
              <br>
            </td>
            <td width="54%" style="padding:0 22 18 0px" valign="top">&nbsp;
            </td>
          </tr>
        </table>
        <br>
        <table width="92%" border="0" cellspacing="1" cellpadding="3">
          <tr> 
            <td style="padding:7 0 6 10px"  bgcolor="F5F6F1">�н����� ã�� : </td>
          </tr>
        </table>
        <table width="92%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FAFAFA">
		  <tr> 
            <td valign="top" > <br>
              <table width="90%" border="0" cellspacing="2" cellpadding="2">
                <form name=form2 method=post action="pass_search_result.php">
				<tr> 
                  <td width="38%" align="right"><b>���̵�</b></td>
                  <td width="62%"> 
                    <input type="text" name="id" size="18" class="InputStyle1">
                  </td>
                </tr>
                <tr> 
                  <td width="38%" align="right"><b>�̸�</b></td>
                  <td width="62%">
                    <input type="text" name="name" size="18" class="InputStyle1">
                  </td>
                </tr>
                <tr> 
                  <td width="38%" align="right" class="b_data1"><b>�ֹι�ȣ</b></td>
                  <td width="62%">
                    <input class="InputStyle1"  size=7 name="jumin1" OnKeyUp="focus_move2();">
                    - 
                    <input class="InputStyle1"  size=7 name="jumin2" >
                  </td>
                </tr>
                <tr> 
                  <td width="38%" align="right">&nbsp;</td>
                  <td width="62%"><a href="javascript:lost_checkInput2();"><img src="../img/butn_ok.gif" border="0"></a><a href="/index.php"><img src="../img/btn_cancel.gif" hspace="4" border="0"></a></td>
                </tr>
				</form>
              </table>
              <br>
            </td>
            <td width="54%" style="padding:0 22 18 0px" valign="top"> <br>&nbsp;
            </td>
          </tr>
        </table>
	  </form>
	</td>
  </tr>
</table>
</body>
</html>
