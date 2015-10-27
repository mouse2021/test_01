<?
$subject  = addslashes($subject);
$contents = addslashes($contents);

$mailheaders = "Return-Path: $sender_email\r\n";
$mailheaders .= "From: $sender <$sender_email>\r\n";

$boundary = "----".uniqid("part");

$mailheaders = "Return-Path: $sender_email\r\n";
$mailheaders .= "From: $sender <$sender_email>\r\n";
      
if ($userfile && $userfile_size) {
     
   $filename=basename($userfile_name);
   $result=fopen($userfile,"r");
   $file=fread($result,$userfile_size);
   fclose($result);

   if ($userfile_type == ""){
     $userfile_type = "application/octet-stream";
   }

   $boundary = "--------".uniqid("part");

   $mailheaders .= "MIME-Version: 1.0\r\n";
   $mailheaders .= "Content-Type: multipart/mixed; boundary=\"$boundary\"";

   $bodytext  = "This is a multi-part message in MIME format.\r\n\r\n";
   $bodytext .= "--$boundary\r\n";

   $bodytext .= "Content-Type: text/html; charset=euc-kr\r\n";
   $bodytext .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
   $bodytext .= nl2br(stripslashes($contents)) . "\r\n\r\n";
   $bodytext .= "--$boundary\r\n";
   $bodytext .= "Content-Type: $userfile_type; name=\"$filename\"\r\n";
   $bodytext .= "Content-Transfer-Encoding: base64\r\n\r\n";
   $bodytext .= ereg_replace("(.{80})","\\1\r\n",base64_encode($file));
   $bodytext .= "\r\n--$boundary--";

 }
 else {
   $mailheaders .= "Content-Type: text/html; charset=euc-kr\r\n";
   $bodytext =  stripslashes($contents);
 }
     
mail($receiver_email,$subject,$bodytext,$mailheaders);
       
echo " 
   <script language=\"JavaScript\">
    alert(\"메일이 전송되었습니다!\");
   </script>
     ";
echo "<meta http-equiv='Refresh' content='0; URL=mail_form.php'>";
?>













