<?php 
    session_start();
    $aa = $_SESSION['membername'];
    require_once('../php/connect.php');
    if (isset($_POST['submit'])) {
        $date1 = date("Ymd_His");
            //สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
            $numrand = (mt_rand());
            $doc_file = (isset($_POST['doc_file']) ? $_POST['doc_file'] : '');
            $upload=$_FILES['doc_file']['name'];
            //ตัดขื่อเอาเฉพาะนามสกุล
            $typefile = strrchr($_FILES['doc_file']['name'],".");
            //โฟลเดอร์ที่เก็บไฟล์
            $path="../doc_file/";
            //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
            $newname = $numrand.$date1.$typefile;
            $path_copy=$path.$newname;
            $docid = $_POST['docid'];
            $docname = $_POST['docname'];
            $dept = $_POST['dename'];
            $approve1 = $_POST['approve1'];
            $approve2 = $_POST['approve2'];
            $approve3 = $_POST['approve3'];
        $sql2 = "DELETE FROM tbdeptlist WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."' ";
        $result2 = mysqli_query($conn,$sql2);
        $sql = "UPDATE tbappname SET
                appstatus1 = 'Rejected',
                appstatus2 = 'Rejected' ,
                appstatus3 = 'Rejected' 
                WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."'";
            if (mysqli_query($conn,$sql)) {
                $sql1 = "UPDATE tbdoc SET
                docstatus = '2',
                docfile = '".$newname."',
                reject = '".$_SESSION['membername']."'
                WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."'";
                if (mysqli_query($conn,$sql1)) {
                    $sql4 = "DELETE FROM tbapproval WHERE doc_id = '".mysqli_real_escape_string($conn, $_POST['docid'])."' and approver != '$aa' ";
                    $result4 = mysqli_query($conn,$sql4);
                    $sql3 = "INSERT INTO tbreject (`rejby`, `docid`, `remark`, `rejto`, `dename`)
                    VALUES (
                        '".$_SESSION['membername']."',
                        '".$_POST['docid']."',  
                        '".$_POST['remark']."',  
                        '".$_POST['add_by']."',
                        '".$_POST['dename']."'
                    )";
                    if (mysqli_query($conn,$sql3)) {
                        ini_set('display_errors', 1);
                        ini_set('display_startup_errors', 1);
                        error_reporting(E_ALL);
                        date_default_timezone_set("Asia/Bangkok");
                        $sToken = "XOOqTO6VMCnX1aqS9WYZkN9iXvsxYwQG71pgKOmzRhk";
                        $con = "";
                        $con2 = "";
                        $con3 = "";
                        $con4 = "";
                        $con5 = "";
                        $con = "เอกสารเลขที่ $docid\n";
                        $con2 = "เรื่อง $docname\n";
                        $con3 = "ไม่ผ่านการอนุมัติ โดย $aa\n";
                        $con4 = "และให้แผนก $dept รับทราบและดำเนินการแก้ไข\n";
                        $con5 = "เข้าสู่ระบบได้ที่ http://171.103.161.10:2222/chj_doc2\n";

                        $sMessage = $con . "" . $con2 . "" . $con3 . "" . $con4 . "" . $con5;

                        $chOne = curl_init();
                        curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
                        curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt($chOne, CURLOPT_POST, 1);
                        curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $sMessage);
                        $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $sToken . '',);
                        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
                        $result = curl_exec($chOne);

                        if (curl_error($chOne)) {
                            echo 'error:' . curl_error($chOne);
                        } else {
                            $result_ = json_decode($result, true);
                            echo "status : " . $result_['status'];
                            echo "message : " . $result_['message'];
                        }
                        echo '<script>alert("Reject Doc Successfully")</script>';
                        header('Refresh:0; url=rejdoc.php');
                    }else{
                        echo '<script>alert("Reject Doc Failed")</script>';
                        header('Refresh:0; url=rejdoc.php');
                    }
                }
            }
    }