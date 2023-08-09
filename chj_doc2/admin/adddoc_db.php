<?php 
session_start();
if (isset($_POST['docname'])) {
     include ('../php/connect.php');
     //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
      echo '
      <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">';
      $date1 = date("Ymd_His");
    //ประกาศตัวแปรรับค่าจากฟอร์ม
    $docid = $_POST['docid'];
    $dept = $_POST['dename'];
    $appname1 = $_POST['appname1'];
    $docname = $_POST['docname'];
    //สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
    $numrand = (mt_rand());
    $doc_file = (isset($_POST['doc_file']) ? $_POST['doc_file'] : '');
    $upload=$_FILES['doc_file']['name'];
    //ตัดขื่อเอาเฉพาะนามสกุล
    $typefile = strrchr($_FILES['doc_file']['name'],".");
    //มีการอัพโหลดไฟล์
    if($upload !='') {
    //โฟลเดอร์ที่เก็บไฟล์
    $path="../doc_file/";
    //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
    $newname = $numrand.$date1.$typefile;
    $path_copy=$path.$newname;
    //คัดลอกไฟล์ไปยังโฟลเดอร์
    if(move_uploaded_file($_FILES['doc_file']['tmp_name'],$path_copy)){
    //sql insert
    $sql1 = "INSERT INTO `tbdoc` (`docid`, `docfile`, `docname`, `catename`, `dename`, `membername`, `addby`)
        VALUES (
            '".$_POST['docid']."',    
            '".$newname."',
            '".$_POST['docname']."',
            '".$_POST['catename']."',
            '".$_POST['dename']."',
            '".$_POST['membername']."',
            '".$_SESSION['membername']."'
            )";
        if (mysqli_query($conn, $sql1)) {
            $sql9 = "INSERT INTO `tbdeptlist`(`docid`, `dename`) 
            VALUES (
                        '".$_POST['docid']."', 
                        '".$_POST['dename']."'
                        )";
            $result9 = mysqli_query($conn,$sql9); 
            $sql2 = "INSERT INTO `tbapproval` (`doc_id`, `doc_file`, `doc_name`, `cate_name`, `de_name`, `member_name`, `add_by`, `approver`)
            VALUES (
                '".$_POST['docid']."',    
                '".$newname."',
                '".$_POST['docname']."',
                '".$_POST['catename']."',
                '".$_POST['dename']."',
                '".$_POST['membername']."',
                '".$_SESSION['membername']."',
                '".$_POST['appname1']."'
                )";
            if (mysqli_query($conn, $sql2)) {
                $sql3 = "INSERT INTO `tbappname`(`docid`, `appname1`, `appstatus1`) 
                VALUES (
                            '".$_POST['docid']."', 
                            '".$_POST['appname1']."' ,
                            'Pending' 
                            )";
                            if (mysqli_query($conn, $sql3)) { 
                                $sql4 = "INSERT INTO `tbappname`(`docid`, `appname2`, `appstatus2`) 
                                VALUES (
                                            '".$_POST['docid']."', 
                                            '".$_POST['appname2']."' ,
                                            'Pending' 
                                            )";
                                            if (mysqli_query($conn, $sql4)){
                                                $sql5 = "INSERT INTO `tbappname`(`docid`, `appname3`, `appstatus3`) 
                                                VALUES (
                                                            '".$_POST['docid']."', 
                                                            '".$_POST['appname3']."' ,
                                                            'Pending' 
                                                            )";
                                                            if (mysqli_query($conn, $sql5)){
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
                                                                $con = "แผนก $dept ได้เพิ่มเอกสาร\n";
                                                                $con2 = "เอกสารเลขที่ $docid\n";
                                                                $con3 = "เรื่อง $docname\n";
                                                                $con4 = "โดยให้ $appname1 เข้าไปกดอนุมัติเอกสาร\n";
                                                                $con5 = "กรุณากดเข้าอนุมัติได้ที่ http://171.103.161.10:2222/chj_doc2\n";
                                        
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
                                                                echo '<script>alert("เพิ่มเอกสารสำเร็จ")</script>';
                                                                header('Refresh:0; url=doc.php');
                                                            }else{
                                                                echo '<script>alert("เพิ่มเอกสารไม่สำเร็จ")</script>';
                                                                header('Refresh:0; url=adddoc.php');
                                                            }
                                            }
                                            }
                            }
                            
                        } else {
                            echo '<script>alert("ไม่สามารถเพิ่มเอกสารได้เนื่องจากมีเลขที่เอกสารซ้ำ กรุณากดยกเลิกเอกสารก่อน!!")</script>';
                            header('Refresh:0; url=rejdoc.php');
                        }
                        }
                 $conn = null; //close connect db
    } //isset
}
?>