<?php 
    require_once('../php/connect.php');
    if (isset($_GET['docid'])) {
        $id = $_GET['docid'];
        $sql="SELECT * FROM tbdoc WHERE docid = '".$id."'"; //คิวรี่ข้อมูลออกมา
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($res);
		$path="../doc_file/"; //path ที่ไว้เก็บไฟล์		
		$newname =$row['docfile']; //ฟิวที่ใว้เก็บชื่อไฟล์ในฐานข้อมูล			 
		$file=$path.$newname;
		if (unlink($file)){  
        @unlink("../img/".$_FILES["doc_file"]["name"]);
        $sql1 = "DELETE FROM tbdoc WHERE docid = '".mysqli_real_escape_string($conn, $_GET['docid'])."' ";
        if (mysqli_query($conn, $sql1)) {
            echo '<script>alert("ลบเอกสารสำเร็จ!!")</script>';
                        header('Refresh:0; url=doc.php');
        } else {
            echo '<script>alert("ลบเอกสารไม่สำเร็จ!!")</script>';
                        header('Refresh:0; url=doc.php');
        }
    }
}
    mysqli_close($conn);
?>