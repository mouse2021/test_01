<?
//������ ���� ����
include "../../php/auth.php";
// ����Ÿ���̽� �������� �� ��Ÿ����
include "../../php/config.php";
// ���� ��ƿ�Լ�
include "../../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

  $subject  = addslashes($subject);
  $contents = addslashes($contents);

  for($i=0;$i < sizeof($num);$i++){

	  $qry  = "select * from member where seq_num='$num[$i]' ";
	  $res  = mysql_query($qry,$connect);
	  $rows = mysql_fetch_array($res);

	  $email= $rows[email];

	  $body = nl2br($contents);

	  $fromname = $sender;
	  $from = $sender_email;
	  
	  $toname = $rows[name];
	  $to = $rows[email];
		
	  $mailheaders = "Return-Path: $from\r\n";
	  $mailheaders .= "From: $fromname <$from>\r\n";
	  $mailheaders .= "Content-Type: text/html; charset=euc-kr\r\n";
	  mail($to,$subject,$body,$mailheaders);    
  
  }
  
  echo("
           <script>
	         window.alert('������ �߼۵Ǿ����ϴ�.')
			 self.close()
	        </script>
	  ");

?>