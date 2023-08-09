<?php 
    require_once('../php/connect.php');
    if (isset($_GET['memberid'])) {
        $sql1 = "DELETE FROM tbmember WHERE memberid = '".mysqli_real_escape_string($conn, $_GET['memberid'])."' ";
        if (mysqli_query($conn, $sql1)) {
            echo '<script>alert("ลบสมาชิกสำเร็จ!!")</script>';
                        header('Refresh:0; url=member.php');
        } else {
            echo '<script>alert("ลบสมาชิกไม่สำเร็จ!!")</script>';
                        header('Refresh:0; url=member.php');
        }
    }
    mysqli_close($conn);
?>