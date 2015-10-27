<?
//관리자 인증 파일
include "../../php/auth.php";
// 데이타베이스 연결정보 및 기타설정
include "../../php/config.php";
// 각종 유틸함수
include "../../php/util.php";
// MySQL 연결
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
	         window.alert('메일이 발송되었습니다.')
			 self.close()
	        </script>
	  ");

?>