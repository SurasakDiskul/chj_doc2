<?php session_start();
    require_once('../php/connect.php'); 
    if (isset($_POST['submit'])) {
    $users = $_POST['musername'];
    $sql_ck = "SELECT * FROM `tbmember` WHERE musername ='$users'";
    $result_ck = mysqli_query($conn, $sql_ck);
    $row_ck = mysqli_fetch_assoc($result_ck);
    if ($users !== $row_ck['musername']) {
        echo '<script>alert("0")</script>';
    } else {
        //ประกาศตัวแปร และ ใช้คำสั่งในการเพิ่มข้อมูลลง Table ใน Database
        $sql1 = "UPDATE `tbmember` SET 
        `musername`='".$_POST['musername']."',
        `mpassword`='".$_POST['mpassword']."',
        `dename`='".$_POST['dename']."',
        `membername`='".$_POST['membername']."',
        `status`='".$_POST['status']."' 
        WHERE memberid = '".mysqli_real_escape_string($conn, $_POST['memberid'])."' ";
        if (mysqli_query($conn, $sql1)) {
            echo '<script>alert("แก้ไขข้อมูลสำเร็จ")</script>';
            header('Refresh:0; url=member.php');
            
        } else {
            echo 'แก้ไขข้อมูลไม่สำเร็จ!!';
            header('Refresh:0; url=editmember.php');
        }
    }
    }
    
    mysqli_close($conn);
?>
