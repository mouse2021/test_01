<?
include	"../../php/auth.php";
// ����Ÿ���̽�	�������� ��	��Ÿ����
include	"../../php/config.php";
// ����	��ƿ�Լ�
include	"../../php/util.php";
// MySQL ����
$connect=my_connect($host,$dbid,$dbpass,$dbname);

if($s_image_name){
  $file_ext1 = substr(strrchr($s_image_name,"."), 1);
  if ($file_ext1 != 'jpg' && $file_ext1 != 'gif' && $file_ext1 != 'jpeg' && $file_ext1 != 'bmp' ){
	 err_msg("�̹��� ���ϸ� �ø� �� �ֽ��ϴ�.");  
  }
  if (!$s_image_size) {
	 err_msg("������ ������ ���ų� ���� ũ�Ⱑ 0KB�Դϴ�.");  
  }   
}

if($m_image_name){
  $file_ext2 = substr(strrchr($m_image_name,"."), 1);
  if ($file_ext2 != 'jpg' && $file_ext2 != 'gif' && $file_ext2 != 'jpeg' && $file_ext2 != 'bmp' )  {
	 err_msg("�̹��� ���ϸ� �ø� �� �ֽ��ϴ�.");  
  }
  if (!$m_image_size) { 
	 err_msg("������ ������ ���ų� ���� ũ�Ⱑ 0KB�Դϴ�.");  
  }   
}

if($b_image_name){
  $file_ext3 = substr(strrchr($b_image_name,"."), 1);
  if ($file_ext3 != 'jpg' && $file_ext3 != 'gif' && $file_ext3 != 'jpeg' && $file_ext3 != 'bmp' )  {
	 err_msg("�̹��� ���ϸ� �ø� �� �ֽ��ϴ�.");  
  }
  if (!$b_image_size) { 
	 err_msg("������ ������ ���ų� ���� ũ�Ⱑ 0KB�Դϴ�.");  
  }   
}

if($mode =='insert'){
  
  $query = "insert into products_code values ('')";
  mysql_query($query, $connect);

  $query = "select max(num) as maxid from products_code";
  $result = mysql_query($query, $connect);
  $row = mysql_fetch_array($result);
  mysql_free_result($result);
  $p_code = $row[maxid];
  
  $wdate = date('md');
  $trade_code ="p".$wdate."-".$p_code;

  $savedir ="../../upload/p_image";

  if($s_image_name){
   $temp1 = $trade_code.".".$file_ext1;
   copy($s_image, "$savedir/s/$temp1");
   unlink($s_image);
   $simg_chk = "Y";
  }
  else{
   $simg_chk = "N";
  }

  if($m_image_name){
   $temp2 = $trade_code.".".$file_ext2;
   copy($m_image, "$savedir/m/$temp2");
   unlink($m_image);
   $mimg_chk = "Y";
  }
  else{
   $mimg_chk = "N";
  }

  if($b_image_name){
   $temp3 = $trade_code.".".$file_ext3;
   copy($b_image, "$savedir/b/$temp3");
   unlink($b_image);
   $bimg_chk = "Y";
  }
  else{
   $bimg_chk = "N";
  }
    
   $name = addslashes($name);
   $company = addslashes($company);
   $size = addslashes($size);
   $contents = addslashes($contents);
   if($con_html=='2'){
     $contents = htmlspecialchars($contents);
     $contents = chop($contents);
   }

   if(!$option1_chk){
     $option1_chk = "N";
   }

   if(!$option2_chk){
     $option2_chk = "N";
   }

   $dbinsert1 = "insert into products(prod_code,category_fk,
                  l_category_fk,name,company,cust_price,price,
	              mileage,size,con_html,contents,s_image,s_image_ty,
                  m_image,m_image_ty,b_image,b_image_ty,
				  created,option1_chk,option2_chk,del_chk)
			    values('$trade_code','$category_code_fk','$l_category_fk',
					   '$name','$company','$cust_price','$price',
				       '$mileage','$size','$con_html','$contents',
					   '$simg_chk','$file_ext1','$mimg_chk','$file_ext2',
					   '$bimg_chk','$file_ext3',now(),
				       '$option1_chk','$option2_chk','$del_chk')";
   $result1 = mysql_query($dbinsert1,$connect);
  
   if($result1){    
	  echo("
       <script>
	    window.alert('������ ���� �Ǿ����ϴ�.')
	   </script>
	  ");
      echo "<meta http-equiv='Refresh' content='0; URL=list.php?level=$level&page=$page&category_code_fk=$category_code_fk&l_category_fk=$l_category_fk'>"; 
    }
   else{
	 err_msg('DB������ �߻��߽��ϴ�.');
   }
 }
 else if($mode =='update'){

  $query = "select * from products where num=$p_num";
  $result = mysql_query($query, $connect);
  $row = mysql_fetch_array($result);
  mysql_free_result($result);
      
  $savedir ="../../upload/p_image";
  $temp1 = $row[prod_code].".".$file_ext1;
  $temp2 = $row[prod_code].".".$file_ext2;
  $temp3 = $row[prod_code].".".$file_ext3;

  if($s_image_name){
    copy($s_image, "$savedir/s/$temp1");
    unlink($s_image);
    $temp1_char = ", s_image='Y' , s_image_ty='$file_ext1' ";
  }

  if($m_image_name){
    copy($m_image, "$savedir/m/$temp2");
    unlink($m_image);
    $temp2_char = ", m_image='Y' , m_image_ty='$file_ext2' ";
  }

  if($b_image_name){
    copy($b_image, "$savedir/b/$temp3");
    unlink($b_image);
    $temp3_char = ", b_image='Y' , b_image_ty='$file_ext3' ";
  }

  $name = addslashes($name);
  $company = addslashes($company);
  $size = addslashes($size);
  $contents = addslashes($contents);
  if($con_html=='2'){
     $contents = htmlspecialchars($contents);
     $contents = chop($contents);
  }

  if(!$option1_chk){
     $option1_chk = "N";
   }

   if(!$option2_chk){
     $option2_chk = "N";
   }

   $dbinsert1 = "update products set category_fk='$category_code_fk',
                                     l_category_fk='$l_category_fk',
                                     name='$name',
									 company='$company',
									 cust_price='$cust_price',
									 price='$price',
									 mileage='$mileage',
				                     size='$size',
                                     con_html='$con_html',
									 contents='$contents' 
									 $temp1_char 
									 $temp2_char 
									 $temp3_char ,
				                     option1_chk='$option1_chk',
									 option2_chk='$option2_chk',
									 del_chk='$del_chk' 
				  where num=$p_num ";
	$result1 = mysql_query($dbinsert1,$connect);
  
    if($result1) {    	 
     echo("
       <script>
	    window.alert('������ �����Ǿ����ϴ�.')
	   </script>
	  ");
      echo "<meta http-equiv='Refresh' content='0; URL=list.php?level=$level&page=$page&category_code_fk=$category_code_fk&l_category_fk=$l_category_fk'>"; 
    }
    else{
     err_msg('DB������ �߻��߽��ϴ�.');
    }
 }
?>
