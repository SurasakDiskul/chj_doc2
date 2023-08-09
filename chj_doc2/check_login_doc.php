<!--หน้า Check User และ Password Login-->
<?php
session_start();
 include('./php/connect.php') //เชื่อมต่อ DB
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
         $_SESSION["status"] = $row['status'];//Check Session

        if ($_SESSION["status"] == 'Superadmin') {    //check status ของ user ถ้าตรงให้ไปที่หน้า Index
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
        }elseif($_SESSION["status"] == 'BOSS') {    //check status ของ user ถ้าตรงให้ไปที่หน้า Index
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
        }elseif($_SESSION["status"] == 'ADMIN') {    //check status ของ user ถ้าตรงให้ไปที่หน้า Index
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
        }elseif($_SESSION["status"] == 'S8') {    //check status ของ user ถ้าตรงให้ไปที่หน้า Index
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
        }elseif($_SESSION["status"] == 'S7') {    //check status ของ user ถ้าตรงให้ไปที่หน้า Index
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
        }elseif($_SESSION["status"] == 'S6') {    //check status ของ user ถ้าตรงให้ไปที่หน้า Index
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
        }elseif($_SESSION["status"] == 'S5') {    //check status ของ user ถ้าตรงให้ไปที่หน้า Index
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
        }elseif($_SESSION["status"] == 'S4') {    //check status ของ user ถ้าตรงให้ไปที่หน้า Index
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
        }elseif($_SESSION["status"] == 'S3') {    //check status ของ user ถ้าตรงให้ไปที่หน้า Index
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
        }elseif($_SESSION["status"] == 'S2') {    //check status ของ user ถ้าตรงให้ไปที่หน้า Index
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
        }elseif($_SESSION["status"] == 'S1') {    //check status ของ user ถ้าตรงให้ไปที่หน้า Index
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
        }elseif($_SESSION["status"] == 'ClericalOfficer') {    //check status ของ user ถ้าตรงให้ไปที่หน้า Index
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
            echo "<meta http-equiv='refresh' content='0;url=login.php'>"; 
        }
        
    } else { //ถ้าระบุรหัสผ่านผิดให้แสดง ERROR

        echo "<script>alert('ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง');</script>";
        Header('Refresh:0; url=index.php');
    }
} else {
    Header('Location: index.php');
}



?>