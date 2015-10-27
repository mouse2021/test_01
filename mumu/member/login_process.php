<?
	########## 데이터베이스에 연결한다. ##########
	// 데이타베이스 연결정보 및 기타설정
	include "../php/config.php";
	// 각종 유틸함수
	include "../php/util.php";
	// MySQL 연결
	$connect=my_connect($host,$dbid,$dbpass,$dbname);

	//회원 테이블에서 정보확인
	$query="select * from member where id = '$id' and passwd='$pwd' ";
	$result = mysql_query($query, $connect);
	$rows = mysql_fetch_array($result);

   if(!$rows) {
	 // util 함수의 err_msg 함수 활용
 	 err_msg('존재하지 않는 회원 ID이거나 패스워드가 틀립니다!');
   }
   else{

	   $_SESSION["p_id"]    = $id;
	   $_SESSION["p_name"]  = $rows[name];
	   $_SESSION["p_email"] = $rows[email];
 
       //장바구니용 쿠키 선언
	   if(!$_COOKIE[member_sid]){ 
         $SID = md5(uniqid(rand()));
         SetCookie("p_sid",$SID,0,"/");   
       }
	  	 
     // 이동할 페이지 정보가 있을 경우
	 if($ret_url){
          echo("<meta http-equiv='Refresh' content='0; URL=$ret_url'>");

	 }
	 else{ // 없을 경우
       echo("<meta http-equiv='Refresh' content='0; URL=/index.php'>");
	 }	
  }
?>
