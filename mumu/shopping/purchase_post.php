<?
// 데이타베이스 연결정보 및 기타설정
include "../php/config.php";
// 각종 유틸함수
include "../php/util.php";
// MySQL 연결
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if($_SESSION[p_id]){
  $member_id_fk = $_SESSION[p_id];
}
else{
  $member_id_fk = '손님';
  $mileage_add ='';
}


$query = "insert into p_code values ('')";
mysql_query($query, $connect);

$query = "select max(id) as maxid from p_code";
$result = mysql_query($query, $connect);
$row = mysql_fetch_array($result);
mysql_free_result($result);
$p_code = $row[maxid];

$wdate = date('Ymd');
$trade_code ="r".$wdate."-".$p_code;
$buyer_zipcode = $buyer_zipcode01."-".$buyer_zipcode02;
$buyer_address = $buyer_address01." ".$buyer_address02;

$recipient_zipcode = $recipient_zipcode01."-".$recipient_zipcode02;
$recipient_address = $recipient_address01." ".$recipient_address02;

$buyer_resnumber = $buyer_resnumber01."-".$buyer_resnumber02;
$buyer_phone = $buyer_phone01."-".$buyer_phone02."-".$buyer_phone03;
$buyer_hphone = $buyer_hphone01."-".$buyer_hphone02."-".$buyer_hphone03;

$recipient_phone = $recipient_phone01."-".$recipient_phone02."-".$recipient_phone03;
$recipient_hphone = $recipient_hphone01."-".$recipient_hphone02."-".$recipient_hphone03;


$deposit_date = $deposit_year."-".$deposit_month."-".$deposit_day;

//무통장일 경우 초기값를 입금확인전으로
$pay_code = '3';

$pay_name ="
		   무통장 입금<br>
	       - 입금은행명 : $bank_name<br>
           - 입금자명 : $buyer_name<br>
           - 입금예정일 : $deposit_date
				";

for($i=0; $i<sizeof($products_kind); $i++){
    if($i != 0){
        $temp_kind .= "|";
    }
    $temp_kind .= $products_kind[$i];
}

for($i=0; $i<sizeof($products_fk); $i++){
    if($i != 0){
        $temp_code .= "|";
    }
    $temp_code .= $products_fk[$i];
}

for($i=0; $i<sizeof($products_price); $i++){
    if($i != 0){
        $temp_price .= "|";
    }
    $temp_price .= $products_price[$i];
}

for($i=0; $i<sizeof($products_name); $i++){
    if($i != 0){
        $temp_name .= "|";
    }
    $temp_name .= $products_name[$i];
}

for($i=0; $i<sizeof($products_count); $i++){
    if($i != 0){
        $temp_count .= "|";
    }
    $temp_count .= $products_count[$i];
}

for($i=0; $i<sizeof($products_point); $i++){
    if($i != 0){
        $temp_point .= "|";
    }
    $temp_point .= $products_point[$i];
}

$query = "insert into mall_order(orderid,goods_fk,goods_price,
            goods_name,goods_kind,goods_count,goods_point,
            user_id,amount,volume,trans_cost,
			mileage_add,mileage_use,real_amount,createdate,
		    buyer_name,buyer_zipno,buyer_address,buyer_phone,
			buyer_hphone,buyer_email,buyer_jumin,
			recipient_name,recipient_zipno,recipient_address,
            recipient_phone,recipient_hphone,
            payment_type,bank,account,deposit_date,status )
		 values (
		  '$trade_code','$temp_code','$temp_price','$temp_name','$temp_kind',
		  '$temp_count','$temp_point','$member_id_fk',
          '$amount','$temp_count','$trans_cost','$mileage_add','$mileage_use',
		  '$real_mny',now(),'$buyer_name','$buyer_zipcode',
		  '$buyer_address','$buyer_phone','$buyer_hphone',
		  '$buyer_email','$buyer_resnumber','$recipient_name',
		  '$recipient_zipcode','$recipient_address',
		  '$recipient_phone','$recipient_hphone','1',
		  '$bank_name','$buyer_name','$deposit_date','$pay_code')";

$result = mysql_query($query, $connect);

if(!$result){
   err_msg('데이터베이스 에러가 났습니다.');
}
else{
   echo "<meta http-equiv='Refresh' content='0; URL=purchase_after.php?trade_code=$trade_code'>"; 
}
?>
