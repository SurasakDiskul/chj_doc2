
<?php session_start();
    require_once('../php/connect.php'); 
    if (isset($_POST['submit'])) {
        $sql1 = "INSERT INTO `tbcategory`(`catename`, `dename`) 
        VALUES (
                    '".$_POST['catename']."', 
                    '".$_POST['dename']."'  
                    )";
                    if (mysqli_query($conn, $sql1)) { 
                        echo '<script>alert("เพิ่มข้อมูลสำเร็จ!!")</script>';
                                    header('Refresh:0; url=category.php');
                        for ($i = 1; $i<= (int)$_POST["hdnCount"]; $i++){  //ใช้คำสั่ง for และ if เพื่อให้ Loop check ว่ามีการ Insert ข้อมูลแบบ Dynamic หรือไม่
                            if(isset($_POST["catename$i"]))
                            {
                                if ($_POST["catename$i"] != "" &&  //check ว่ามีการเพิ่มข้อมูลหรือไม่
                                    $_POST["dename$i"] != "")
                                {   //ถ้ามีการเพิ่มแบบ Dynamic ก็ให้เพิ่มลง table ใน database
                                    $sql2 = "INSERT INTO `tbcategory`(`catename`, `dename`) 
                                    VALUES (
                                        '".$_POST["catename$i"]."',
                                        '".$_POST["dename$i"]."')";
                                    $query = mysqli_query($conn,$sql2); //query เก็บข้อมูล
                                    echo '<script>alert("เพิ่มข้อมูลสำเร็จ!!")</script>';
                                    header('Refresh:0; url=category.php');
                                }
                            }
                        }
                    } else { 
                        echo '<script>alert("เพิ่มข้อมูลไม่สำเร็จ!!")</script>';
                        header('Refresh:0; url=addcategory.php');
                    }
    }else{
        echo '<script>alert("failed!!")</script>';
    }
    mysqli_close($conn);
?>