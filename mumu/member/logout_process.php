<?
  // ���ǻ���� ���� ������ ���۽�ŵ�ϴ�.
  session_start();
  session_destroy();
  
  SetCookie("p_sid","", time(), '/');

  echo "<meta http-equiv='refresh' content='0; URL=/index.php'>";
?>