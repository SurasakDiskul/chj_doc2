<!--เชื่อมต่อ DB-->
<?php 
  $servername = "localhost";
  $username = "cjlinfoc";
  $password = "333cjChowjung";
  $dbname = "cjlinfoc_chj_doc";
  $conn = mysqli_connect($servername, $username, $password, $dbname); //เชื่อมต่อ Database
  error_reporting(0);
  ini_set('display_errors', 0);
  if (mysqli_connect_errno()) { //เปิด if เพื่อ check ว่าเชื่อมต่อได้หรือไม่
    echo "ไม่สามารถเชื่อมต่อฐานข้อมูล MySQL ได้: " . mysqli_connect_error(); //ถ้าเชื่อมต่อไม่ได้ให้แสดง ERROR
    exit();  
  }
  date_default_timezone_set('Asia/Bangkok'); // set time zine ให้เป็นประเทศไทย
  
  function dateThai($strDate){  //โค้ดวันที่และเวลา
    $strYear= date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear $strHour:$strMinute น.";
  }

?>
<!-- sweet alert js & css -->
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">