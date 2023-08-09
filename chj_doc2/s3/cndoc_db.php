<?php 
    session_start();
    $aa = $_SESSION['membername'];
    require_once('../php/connect.php');
    if (isset($_POST['submit'])) {
                $sql1 = "DELETE FROM tbdoc WHERE docid = '".mysqli_real_escape_string($conn, $_POST['doc_id'])."' AND docstatus = '2'";
                if (mysqli_query($conn,$sql1)) {
                    $sql4 = "DELETE FROM tbapproval WHERE doc_id = '".mysqli_real_escape_string($conn, $_POST['doc_id'])."' ";
                    $result4 = mysqli_query($conn,$sql4);
                    $sql5 = "DELETE FROM tbappname WHERE docid = '".mysqli_real_escape_string($conn, $_POST['doc_id'])."' ";
                    $result5 = mysqli_query($conn,$sql5);
                    $sql6 = "DELETE FROM tbreject WHERE docid = '".mysqli_real_escape_string($conn, $_POST['doc_id'])."' ";
                    $result6 = mysqli_query($conn,$sql6);
                    $sql3 = "INSERT INTO tbcancel (`docid`, `filename`, `category`, `docfile`,`sendto`, `department`, `addby`, `rejectby`, `remark`)
                    VALUES (
                        'CN".$_POST['doc_id']."',  
                        '".$_POST['doc_name']."',  
                        '".$_POST['cate_name']."',
                        '".$_POST['file']."',  
                        '".$_POST['sendto']."',  
                        '".$_POST['de_name']."',
                        '".$_POST['add_by']."',  
                        '".$_POST['rejby']."',  
                        '".$_POST['remark']."'
                    )";
                    if (mysqli_query($conn,$sql3)) {
                        echo '<script>alert("เอกสารยกเลิกเรียบร้อย")</script>';
                        header('Refresh:0; url=cndoc.php');
                    }else{
                        echo '<script>alert("เอกสารไม่สามารถยกเลิกได้")</script>';
                        header('Refresh:0; url=cndoc.php');
                    }
                }
            }