<?php
    session_start();
    $aa = $_SESSION['membername']; //Superadmin
    $ss  = 'ไม่มีผู้อนุมัติ';
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
        if($_POST['approve1'] == "$ss" && $_POST['appstatus1'] == 'Pending'){
            $sql9 = "UPDATE `tbappname` SET
            `appstatus1` = 'Approved'
            WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."'
            AND appname1 = '$ss'";
            $result9 = mysqli_query($conn, $sql9);
            $sql12 = "INSERT INTO `tbapproval` (`doc_id`, `doc_file`, `doc_name`, `cate_name`, `de_name`, `member_name`, `add_by`, `approver`)
            VALUES (
                '".$_POST['docid']."',    
                '".$_POST['file']."',
                '".$_POST['docname']."',
                '".$_POST['catename']."',
                '".$_POST['dename']."',
                '".$_POST['membername']."',
                '".$_SESSION['membername']."',
                '".$_POST['approve2']."'
                )";
            $result12 = mysqli_query($conn, $sql12);
        }elseif($_POST['approve2'] == "$ss" && $_POST['appstatus2'] == 'Pending'){
            $sql10 = "UPDATE `tbappname` SET
            `appstatus2` = 'Approved'
            WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."'
            AND appname2 = '$ss'";
                        if (mysqli_query($conn, $sql10)) {
                            if($_POST['approve3'] == "$ss" && $_POST['appstatus1'] == 'Approved' && $_POST['appstatus2'] == 'Pending'){
                                $sql99 = "UPDATE `tbappname` SET
                                `appstatus3` = 'Approved'
                                WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."'
                                AND appname3 = '$ss'";
                                $result99 = mysqli_query($conn, $sql99);
                                $sql98 = "SELECT * FROM `tbappname` WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."' AND appstatus3 !=''";
                                            $result98 = mysqli_query($conn,$sql98);
                                            $row98 = mysqli_fetch_assoc($result98);
                                            if ($row98['appstatus3'] == 'Approved') { 
                                                $sql90 = "DELETE FROM tbapproval WHERE doc_id = '".mysqli_real_escape_string($conn, $_POST['docid'])."' ";
                                                $result90 = mysqli_query($conn,$sql90);
                                                $sql97 = "UPDATE `tbdoc` SET
                                                    docstatus = '1',
                                                    docfile = '".$newname."'
                                                    WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."'";
                                                    if (mysqli_query($conn, $sql97)) {
                                                        ini_set('display_errors', 1);
                                                        ini_set('display_startup_errors', 1);
                                                        error_reporting(E_ALL);
                                                        date_default_timezone_set("Asia/Bangkok");
                                                        $sToken = "9CAKSsy38immhDtvzSy1VfGryvmrCRjKnQ5PiyeYCKz";
                                                        $con = "";
                                                        $con2 = "";
                                                        $con3 = "";
                                                        $con4 = "";
                                                        $con = "เอกสารเลขที่ $docid\n";
                                                        $con2 = "เรื่อง $docname\n";
                                                        $con3 = "ผ่านการอนุมัติสำเร็จแล้ว\n";
                                                        $con4 = "กรุณากดเข้าอนุมัติได้ที่ https://cjlinfo.com\n";

                                                        $sMessage = $con . "" . $con2 . "" . $con3 . "" . $con4;

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
                                                        echo '<script>alert("อนุมัติเอกสารสำเร็จ2")</script>';
                                                        header('Refresh:0; url=doc.php');
                                                    }else{
                                                        echo '<script>alert("อนุมัติเอกสารไม่สำเร็จ")</script>';
                                                        header('Refresh:0; url=doc.php');
                                                    }
                                           } }elseif($_POST['approve3'] != "$ss" ){
                                                    //มีการอัพโหลดไฟล์
                                                            if($upload !='') {
                                                                if(move_uploaded_file($_FILES['doc_file']['tmp_name'],$path_copy))
                                                                                    //*** Delete Old File ***//	
                                                                    @unlink("../doc_file/".$_POST["file"]);
                                                                    {
                                                $sql95 = "UPDATE `tbappname` SET
                                                `appstatus1` = 'Approved'
                                                WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."'
                                                AND appname1 = '$aa'";
                                                $result95 = mysqli_query($conn, $sql95);
                                                $sql94 = "DELETE FROM tbapproval WHERE doc_id = '".mysqli_real_escape_string($conn, $_POST['docid'])."' AND approver ='$aa'";
                                                $result94 = mysqli_query($conn,$sql94);
                                                $sql96 = "INSERT INTO `tbapproval` (`doc_id`, `doc_file`, `doc_name`, `cate_name`, `de_name`, `member_name`, `add_by`, `approver`)
                                                VALUES (
                                                    '".$_POST['docid']."',    
                                                    '".$newname."',
                                                    '".$_POST['docname']."',
                                                    '".$_POST['catename']."',
                                                    '".$_POST['dename']."',
                                                    '".$_POST['membername']."',
                                                    '".$_SESSION['membername']."',
                                                    '".$_POST['approve3']."'
                                                    )";
                                                    if (mysqli_query($conn, $sql96)) {
                                                        ini_set('display_errors', 1);
                                                        ini_set('display_startup_errors', 1);
                                                        error_reporting(E_ALL);
                                                        date_default_timezone_set("Asia/Bangkok");
                                                        $sToken = "9CAKSsy38immhDtvzSy1VfGryvmrCRjKnQ5PiyeYCKz";
                                                        $con = "";
                                                        $con2 = "";
                                                        $con3 = "";
                                                        $con4 = "";
                                                        $con5 = "";
                                                        $con = "เอกสารเลขที่ $docid\n";
                                                        $con2 = "เรื่อง $docname\n";
                                                        $con3 = "ผ่านการอนุมัติครั้งที่ 1 สำเร็จแล้ว\n";
                                                        $con4 = "โดย $approve3 จะเป็นผู้อนุมัติเอกสารคนถัดไป\n";
                                                        $con5 = "กรุณากดเข้าอนุมัติได้ที่ https://cjlinfo.com\n";
                                        
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
                                                        echo '<script>alert("อนุมัติเอกสารสำเร็จ1")</script>';
                                                        header('Refresh:0; url=doc.php');
                                                    }else{
                                                        echo '<script>alert("อนุมัติเอกสารไม่สำเร็จ")</script>';
                                                        header('Refresh:0; url=doc.php');
                                                    }
                                                                        }
                                                                    }
                                                                    }
                                                                    }
            }elseif($_POST['approve3'] == "$ss" && $_POST['appstatus1'] == 'Approved' && $_POST['appstatus2'] == 'Pending'){
                if($upload !='') {
                    if(move_uploaded_file($_FILES['doc_file']['tmp_name'],$path_copy))
                                        //*** Delete Old File ***//	
                        @unlink("../doc_file/".$_POST["file"]);
                        {
                $sql11 = "UPDATE `tbappname` SET
            `appstatus2` = 'Approved',
            `appstatus3` = 'Approved'
            WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."'
            ";
            $result11 = mysqli_query($conn, $sql11);
            $sql14 = "SELECT * FROM `tbappname` WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."' AND appstatus3 !=''";
                        $result14 = mysqli_query($conn,$sql14);
                        $row = mysqli_fetch_assoc($result14);
                        if ($row['appstatus3'] == 'Approved') { 
                            $sql89 = "DELETE FROM tbapproval WHERE doc_id = '".mysqli_real_escape_string($conn, $_POST['docid'])."' ";
                            $result89 = mysqli_query($conn,$sql89);
                            $sql15 = "UPDATE `tbdoc` SET
                                docstatus = '1',
                                docfile = '".$newname."'
                                WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."'";
                                if (mysqli_query($conn, $sql15)) {
                                    ini_set('display_errors', 1);
                            ini_set('display_startup_errors', 1);
                            error_reporting(E_ALL);
                            date_default_timezone_set("Asia/Bangkok");
                            $sToken = "9CAKSsy38immhDtvzSy1VfGryvmrCRjKnQ5PiyeYCKz";
                            $con = "";
                            $con2 = "";
                            $con3 = "";
                            $con4 = "";
                            $con = "เอกสารเลขที่ $docid\n";
                            $con2 = "เรื่อง $docname\n";
                            $con3 = "ผ่านการอนุมัติสำเร็จแล้ว\n";
                            $con4 = "กรุณากดเข้าอนุมัติได้ที่ https://cjlinfo.com\n";

                            $sMessage = $con . "" . $con2 . "" . $con3 . "" . $con4;

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
                                    echo '<script>alert("อนุมัติเอกสารสำเร็จ")</script>';
                                    header('Refresh:0; url=doc.php');
                                }else{
                                    echo '<script>alert("อนุมัติเอกสารไม่สำเร็จ")</script>';
                                    header('Refresh:0; url=doc.php');
                                }
                        }}}
        }elseif($_POST['approve1'] == "$aa" ){
            //มีการอัพโหลดไฟล์
            if($upload !='') {
                if(move_uploaded_file($_FILES['doc_file']['tmp_name'],$path_copy))
                                    //*** Delete Old File ***//	
                    @unlink("../doc_file/".$_POST["file"]);
                    {
                $sql1 = "UPDATE `tbappname` SET
                `appstatus1` = 'Approved'
                WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."'
                AND appname1 = '$aa'";
                $result1 = mysqli_query($conn, $sql1);
                
                $sql2 = "INSERT INTO `tbapproval` (`doc_id`, `doc_file`, `doc_name`, `cate_name`, `de_name`, `member_name`, `add_by`, `approver`)
                VALUES (
                    '".$_POST['docid']."',    
                    '".$newname."',
                    '".$_POST['docname']."',
                    '".$_POST['catename']."',
                    '".$_POST['dename']."',
                    '".$_POST['membername']."',
                    '".$_SESSION['membername']."',
                    '".$_POST['approve2']."'
                    )";
                    if (mysqli_query($conn, $sql2)) {
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                date_default_timezone_set("Asia/Bangkok");
                $sToken = "9CAKSsy38immhDtvzSy1VfGryvmrCRjKnQ5PiyeYCKz";
                $con = "";
                $con2 = "";
                $con3 = "";
                $con4 = "";
                $con5 = "";
                $con = "เอกสารเลขที่ $docid\n";
                $con2 = "เรื่อง $docname\n";
                $con3 = "ผ่านการอนุมัติครั้งที่ 1 สำเร็จแล้ว\n";
                $con4 = "โดย $approve2 จะเป็นผู้อนุมัติเอกสารคนถัดไป\n";
                $con5 = "กรุณากดเข้าอนุมัติได้ที่ https://cjlinfo.com\n";

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
                        echo '<script>alert("อนุมัติเอกสารครั้งที่ 1 สำเร็จ")</script>';
                        header('Refresh:0; url=doc.php');
                    }else{
                        echo '<script>alert("อนุมัติเอกสารครั้งที่ 1 ไม่สำเร็จ")</script>';
                        header('Refresh:0; url=doc.php');
                    }}}
                }elseif($_POST['approve2'] == "$aa" ){
                    //มีการอัพโหลดไฟล์
                    if($upload !='') {
                        if(move_uploaded_file($_FILES['doc_file']['tmp_name'],$path_copy))
                                            //*** Delete Old File ***//	
                            @unlink("../doc_file/".$_POST["file"]);
                            {
                    $sql3 = "UPDATE `tbappname` SET
                    `appstatus2` = 'Approved'
                    WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."'
                    AND appname2 = '$aa'";
                    $result3 = mysqli_query($conn, $sql3);
                    $sql4 = "INSERT INTO `tbapproval` (`doc_id`, `doc_file`, `doc_name`, `cate_name`, `de_name`, `member_name`, `add_by`, `approver`)
                    VALUES (
                        '".$_POST['docid']."',    
                        '".$newname."',
                        '".$_POST['docname']."',
                        '".$_POST['catename']."',
                        '".$_POST['dename']."',
                        '".$_POST['membername']."',
                        '".$_SESSION['membername']."',
                        '".$_POST['approve3']."'
                        )";
                        if (mysqli_query($conn, $sql4)) {
                            ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                date_default_timezone_set("Asia/Bangkok");
                $sToken = "9CAKSsy38immhDtvzSy1VfGryvmrCRjKnQ5PiyeYCKz";
                $con = "";
                $con2 = "";
                $con3 = "";
                $con4 = "";
                $con5 = "";
                $con = "เอกสารเลขที่ $docid\n";
                $con2 = "เรื่อง $docname\n";
                $con3 = "ผ่านการอนุมัติครั้งที่ 2 สำเร็จแล้ว\n";
                $con4 = "โดย $approve3 จะเป็นผู้อนุมัติเอกสารคนถัดไป\n";
                $con5 = "กรุณากดเข้าอนุมัติได้ที่ https://cjlinfo.com\n";

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
                            echo '<script>alert("อนุมัติเอกสารครั้งที่ 2 สำเร็จ")</script>';
                            header('Refresh:0; url=doc.php');
                        }else{
                            echo '<script>alert("อนุมัติเอกสารครั้งที่ 2 ไม่สำเร็จ")</script>';
                            header('Refresh:0; url=doc.php');
                        }}}
                    }elseif($_POST['approve3'] == "$aa" ){
                        if($upload !='') {
                            if(move_uploaded_file($_FILES['doc_file']['tmp_name'],$path_copy))
                                                //*** Delete Old File ***//	
                                @unlink("../doc_file/".$_POST["file"]);
                                {
                        $sql5 = "UPDATE `tbappname` SET
                        `appstatus3` = 'Approved'
                        WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."'
                        AND appname3 = '$aa'";
                        $result5 = mysqli_query($conn, $sql5);
                        $sql6 = "SELECT * FROM `tbappname` WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."' AND appstatus3 !=''";
                        $result6 = mysqli_query($conn,$sql6);
                        $row = mysqli_fetch_assoc($result6);
                        if ($row['appstatus3'] == 'Approved') { 
                            $sql91 = "DELETE FROM tbapproval WHERE doc_id = '".mysqli_real_escape_string($conn, $_POST['docid'])."'";
                            $result91 = mysqli_query($conn,$sql91);
                            $sql7 = "UPDATE `tbdoc` SET
                                docstatus = '1',
                                docfile = '".$newname."'
                                WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."'";
                                if (mysqli_query($conn, $sql7)) {  // if check ว่า insert ข้อมูลสำเร็จหรือไม่
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                date_default_timezone_set("Asia/Bangkok");
                $sToken = "9CAKSsy38immhDtvzSy1VfGryvmrCRjKnQ5PiyeYCKz";
                $con = "";
                $con2 = "";
                $con3 = "";
                $con4 = "";
                $con = "เอกสารเลขที่ $docid\n";
                $con2 = "เรื่อง $docname\n";
                $con3 = "ผ่านการอนุมัติสำเร็จแล้ว\n";
                $con4 = "กรุณากดเข้าอนุมัติได้ที่ https://cjlinfo.com\n";

                $sMessage = $con . "" . $con2 . "" . $con3 . "" . $con4;

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
                                    echo '<script>alert("อนุมัติเอกสารครั้งที่ 3 สำเร็จ")</script>';
                                header('Refresh:0; url=doc.php');
                            }else{
                                echo '<script>alert("อนุมัติเอกสารครั้งที่ 3 ไม่สำเร็จ")</script>';
                                header('Refresh:0; url=doc.php');
                            }
                        }
                        }}}elseif($_POST['approve1'] == "$aa" && $_POST['appstatus1'] == 'Pending' && $_POST['approve2'] == "$ss" && $_POST['approve3'] == "$ss"){
                            if($upload !='') {
                                if(move_uploaded_file($_FILES['doc_file']['tmp_name'],$path_copy))
                                                    //*** Delete Old File ***//	
                                    @unlink("../doc_file/".$_POST["file"]);
                                    {
                            $sql11 = "UPDATE `tbappname` SET
                        `appstatus1` = 'Approved',
                        `appstatus2` = 'Approved',
                        `appstatus3` = 'Approved'
                        WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."'
                        ";
                        $result11 = mysqli_query($conn, $sql11);
                        $sql14 = "SELECT * FROM `tbappname` WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."' AND appstatus3 !=''";
                                    $result14 = mysqli_query($conn,$sql14);
                                    $row = mysqli_fetch_assoc($result14);
                                    if ($row['appstatus3'] == 'Approved') { 
                                        $sql89 = "DELETE FROM tbapproval WHERE doc_id = '".mysqli_real_escape_string($conn, $_POST['docid'])."' ";
                                        $result89 = mysqli_query($conn,$sql89);
                                        $sql15 = "UPDATE `tbdoc` SET
                                            docstatus = '1',
                                            docfile = '".$newname."'
                                            WHERE docid = '".mysqli_real_escape_string($conn, $_POST['docid'])."'";
                                            if (mysqli_query($conn, $sql15)) {
                                                ini_set('display_errors', 1);
                                        ini_set('display_startup_errors', 1);
                                        error_reporting(E_ALL);
                                        date_default_timezone_set("Asia/Bangkok");
                                        $sToken = "9CAKSsy38immhDtvzSy1VfGryvmrCRjKnQ5PiyeYCKz";
                                        $con = "";
                                        $con2 = "";
                                        $con3 = "";
                                        $con4 = "";
                                        $con = "เอกสารเลขที่ $docid\n";
                                        $con2 = "เรื่อง $docname\n";
                                        $con3 = "ผ่านการอนุมัติสำเร็จแล้ว\n";
                                        $con4 = "กรุณากดเข้าอนุมัติได้ที่ https://cjlinfo.com\n";
            
                                        $sMessage = $con . "" . $con2 . "" . $con3 . "" . $con4;
            
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
                                                echo '<script>alert("อนุมัติเอกสารสำเร็จ")</script>';
                                                header('Refresh:0; url=doc.php');
                                            }else{
                                                echo '<script>alert("อนุมัติเอกสารไม่สำเร็จ")</script>';
                                                header('Refresh:0; url=doc.php');
                                            }
                                    }}}
    }elseif (isset($_POST['reject'])) {
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
        $sql555 = "DELETE FROM tbapproval WHERE doc_id = '".mysqli_real_escape_string($conn, $_POST['docid'])."' ";
        $result555 = mysqli_query($conn,$sql555);
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
                    //$sql4 = "DELETE FROM tbapproval WHERE doc_id = '".mysqli_real_escape_string($conn, $_POST['docid'])."' ";
                    //$result4 = mysqli_query($conn,$sql4);
                    $sql3 = "INSERT INTO tbreject (`rejby`, `docid`, `remark`, `rejto`)
                    VALUES (
                        '".$_SESSION['membername']."',
                        '".$_POST['docid']."',  
                        '".$_POST['remark']."',  
                        '".$_POST['add_by']."'
                    )";
                    if (mysqli_query($conn,$sql3)) {
                        ini_set('display_errors', 1);
                        ini_set('display_startup_errors', 1);
                        error_reporting(E_ALL);
                        date_default_timezone_set("Asia/Bangkok");
                        $sToken = "9CAKSsy38immhDtvzSy1VfGryvmrCRjKnQ5PiyeYCKz";
                        $con = "";
                        $con2 = "";
                        $con3 = "";
                        $con4 = "";
                        $con5 = "";
                        $con = "เอกสารเลขที่ $docid\n";
                        $con2 = "เรื่อง $docname\n";
                        $con3 = "ไม่ผ่านการอนุมัติ โดย $aa\n";
                        $con4 = "และให้แผนก $dept รับทราบและดำเนินการแก้ไข\n";
                        $con5 = "เข้าสู่ระบบได้ที่ https://cjlinfo.com\n";

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
    }