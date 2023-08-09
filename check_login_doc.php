<!--หน้า Check User และ Password Login-->
<?php
session_start();
$servername = "localhost";
$username = "cjlinfoc";
$password = "333cjChowjung";
$dbname = "cjlinfoc_user_all";
$conn = mysqli_connect($servername, $username, $password, $dbname); //เชื่อมต่อ Database
error_reporting(0);
ini_set('display_errors', 0);
if (mysqli_connect_errno()) { //เปิด if เพื่อ check ว่าเชื่อมต่อได้หรือไม่
  echo "ไม่สามารถเชื่อมต่อฐานข้อมูล MySQL ได้: " . mysqli_connect_error(); //ถ้าเชื่อมต่อไม่ได้ให้แสดง ERROR
  exit();  
}
 ?> 

<?php
if (isset($_GET['musername'])) { //if check ว่ามีการกดปุ่ม Login หรือไม่
    $username = $_GET['musername']; //ประกาศตัวแปรสำหรับ Username

    $query = "SELECT * FROM `tbmember` WHERE  musername='$username'"; //ดึงข้อมูลจาก DB
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) >0) { 
        $row = mysqli_fetch_array($result);

         $_SESSION["memberid"] = $row['memberid'];//Check Session 
         $_SESSION["musername"] = $row['musername'];//Check Session
         $_SESSION["mpassword"] = $row['mpassword'];//Check Session
         $_SESSION["dename"] = $row['dename'];//Check Session
         $_SESSION["membername"] = $row['membername'];//Check Session
         $_SESSION["status2"] = $row['status2'];//Check Session

        if ($_SESSION["status2"] == 'Superadmin') {    //check status2 ของ user ถ้าตรงให้ไปที่หน้า Index
            echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
      echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เข้าสู่ระบบสำเร็จ!",
                          text: "ระบบกำลังนำท่านเข้าสู่เว็บไซต์.",
                          type: "success",
                          timer: 2000,
                          showConfirmButton: false
                      }, function() {
                          window.location = "./superadmin/index.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
        }elseif($_SESSION["status2"] == 'BOSS') {    //check status2 ของ user ถ้าตรงให้ไปที่หน้า Index
            echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
      echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เข้าสู่ระบบสำเร็จ!",
                          text: "ระบบกำลังนำท่านเข้าสู่เว็บไซต์.",
                          type: "success",
                          timer: 2000,
                          showConfirmButton: false
                      }, function() {
                          window.location = "./BOSS/index.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
        }elseif($_SESSION["status2"] == 'ADMIN') {    //check status2 ของ user ถ้าตรงให้ไปที่หน้า Index
            echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
      echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เข้าสู่ระบบสำเร็จ!",
                          text: "ระบบกำลังนำท่านเข้าสู่เว็บไซต์.",
                          type: "success",
                          timer: 2000,
                          showConfirmButton: false
                      }, function() {
                          window.location = "./admin/index.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
        }elseif($_SESSION["status2"] == 'S8') {    //check status2 ของ user ถ้าตรงให้ไปที่หน้า Index
            echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
      echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เข้าสู่ระบบสำเร็จ!",
                          text: "ระบบกำลังนำท่านเข้าสู่เว็บไซต์.",
                          type: "success",
                          timer: 2000,
                          showConfirmButton: false
                      }, function() {
                          window.location = "./s8/index.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
        }elseif($_SESSION["status2"] == 'S7') {    //check status2 ของ user ถ้าตรงให้ไปที่หน้า Index
            echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
      echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เข้าสู่ระบบสำเร็จ!",
                          text: "ระบบกำลังนำท่านเข้าสู่เว็บไซต์.",
                          type: "success",
                          timer: 2000,
                          showConfirmButton: false
                      }, function() {
                          window.location = "./s7/index.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
        }elseif($_SESSION["status2"] == 'S6') {    //check status2 ของ user ถ้าตรงให้ไปที่หน้า Index
            echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
      echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เข้าสู่ระบบสำเร็จ!",
                          text: "ระบบกำลังนำท่านเข้าสู่เว็บไซต์.",
                          type: "success",
                          timer: 2000,
                          showConfirmButton: false
                      }, function() {
                          window.location = "./s6/index.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
        }elseif($_SESSION["status2"] == 'S5') {    //check status2 ของ user ถ้าตรงให้ไปที่หน้า Index
            echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
      echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เข้าสู่ระบบสำเร็จ!",
                          text: "ระบบกำลังนำท่านเข้าสู่เว็บไซต์.",
                          type: "success",
                          timer: 2000,
                          showConfirmButton: false
                      }, function() {
                          window.location = "./s5/index.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
        }elseif($_SESSION["status2"] == 'S4') {    //check status2 ของ user ถ้าตรงให้ไปที่หน้า Index
            echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
      echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เข้าสู่ระบบสำเร็จ!",
                          text: "ระบบกำลังนำท่านเข้าสู่เว็บไซต์.",
                          type: "success",
                          timer: 2000,
                          showConfirmButton: false
                      }, function() {
                          window.location = "./s4/index.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
        }elseif($_SESSION["status2"] == 'S3') {    //check status2 ของ user ถ้าตรงให้ไปที่หน้า Index
            echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
      echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เข้าสู่ระบบสำเร็จ!",
                          text: "ระบบกำลังนำท่านเข้าสู่เว็บไซต์.",
                          type: "success",
                          timer: 2000,
                          showConfirmButton: false
                      }, function() {
                          window.location = "./s3/index.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
        }elseif($_SESSION["status2"] == 'S2') {    //check status2 ของ user ถ้าตรงให้ไปที่หน้า Index
            echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
      echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เข้าสู่ระบบสำเร็จ!",
                          text: "ระบบกำลังนำท่านเข้าสู่เว็บไซต์.",
                          type: "success",
                          timer: 2000,
                          showConfirmButton: false
                      }, function() {
                          window.location = "./s2/index.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
        }elseif($_SESSION["status2"] == 'S1') {    //check status2 ของ user ถ้าตรงให้ไปที่หน้า Index
            echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
      echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เข้าสู่ระบบสำเร็จ!",
                          text: "ระบบกำลังนำท่านเข้าสู่เว็บไซต์.",
                          type: "success",
                          timer: 2000,
                          showConfirmButton: false
                      }, function() {
                          window.location = "./s1/index.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
        }elseif($_SESSION["status2"] == 'ClericalOfficer') {    //check status2 ของ user ถ้าตรงให้ไปที่หน้า Index
            echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
      echo '<script>
                     setTimeout(function() {
                      swal({
                          title: "เข้าสู่ระบบสำเร็จ!",
                          text: "ระบบกำลังนำท่านเข้าสู่เว็บไซต์.",
                          type: "success",
                          timer: 2000,
                          showConfirmButton: false
                      }, function() {
                          window.location = "./ClericalOfficer/index.php"; //หน้าที่ต้องการให้กระโดดไป
                      });
                    }, 1000);
                </script>';
        }
        
        else  {
            echo "<meta http-equiv='refresh' content='0;url=https://cjlinfo.com/home.php'>"; 
        }
        
    } else { //ถ้าระบุรหัสผ่านผิดให้แสดง ERROR

        echo "<script>alert('ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง');</script>";
        Header('Refresh:0; url=https://cjlinfo.com/home.php');
    }
} else {
    Header('Location: https://cjlinfo.com/home.php');
}



?>