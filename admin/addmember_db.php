<?php session_start();
    require_once('../php/connect.php'); 
    if (isset($_POST['submit'])) {
    $users = $_POST['musername'];
    $sql_ck = "SELECT * FROM `tbmember` WHERE musername ='$users'";
    $result_ck = mysqli_query($conn, $sql_ck);
    $row_ck = mysqli_fetch_assoc($result_ck);
    if ($users == $row_ck['musername']) {
        echo '<script>
        setTimeout(function() {
         swal({
             title: "Username ซ้ำ!",
             text: "กรุณากรอกข้อมูลใหม่.",
             type: "warning",
             showConfirmButton: true
         }, function() {
             window.location = "addmember.php"; //หน้าที่ต้องการให้กระโดดไป
         });
        }, 1000);
        </script>';
    } else {
        //ประกาศตัวแปร และ ใช้คำสั่งในการเพิ่มข้อมูลลง Table ใน Database
        $sql1 = "INSERT INTO `tbmember`(`pic`,`musername`, `mpassword` , `dename`, `membername`, `status`) 
        VALUES (
                    'T-11.png',
                    '".$_POST['musername']."', 
                    '".$_POST['mpassword']."', 
                    '".$_POST['dename']."', 
                    '".$_POST['membername']."', 
                    '".$_POST['status']."'  
                    )";
                    if (mysqli_query($conn, $sql1)) { // if check ว่า insert ข้อมูลสำเร็จหรือไม่
                        echo '<script>alert("เพิ่มข้อมูลสำเร็จ")</script>';
                        header('Refresh:0; url=member.php');
                        
                    } else {  //ถ้าไม่สำเร็จให้แสดงหน้า ERROR
                        echo '<script>alert("เพิ่มข้อมูลไม่สำเร็จ!!")</script>';
                        header('Refresh:0; url=addmember_db.php');
                    }
    }
}
    mysqli_close($conn);
?>