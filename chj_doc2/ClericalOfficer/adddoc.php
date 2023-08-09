<?php
session_start();
include('../php/connect.php');
?>
<?php
if($_SESSION["membername"] == ''){
    echo '<script>alert("SESSION EXPIRED กรุณาเข้าสู่ระบบอีกครั้ง!!")</script>';
    header('Refresh:0; url=http://171.103.161.10:2222/');
 }else{
    header("refresh: 600;");
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>CJL-Document Centre</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <?php include ('./css.php') ?>



      
   </head>
   <body class="dashboard dashboard_1">
      <div class="full_container">
         <div class="inner_container">
            <?php include ('./sidebar.php') ?>
            <!-- right content -->
            <div id="content">
            <?php include ('./topbar.php') ?>
               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>จัดการสมาชิก</h2>
                           </div>
                        </div>
                     </div>

                     <!-- row -->
                     <div class="row column1">
                        <div class="col-md-2"></div>
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>เพิ่มเอกสาร</h2>
                                 </div>
                              </div>
                              <div class="full price_table padding_infor_info">
                                 <div class="row">
                                    <!-- user profile section --> 
                                    <!-- profile image -->
                                    <div class="col-lg-12">
                                    <div class="row ">
                                        <div class="container1">
                                    <div class="col-12 grid-margin">
                    <div class="table-responsive">
                        <?php 

                            //รันเลขที่เอกสาร
                            $request = $_SESSION['dename'];
                            $code = "CJL";
                            $sql99 = "SELECT deptname FROM `tbdept` WHERE dename = '$request'";
                            $res = mysqli_query($conn,$sql99);
                            $row99 = mysqli_fetch_assoc($res);
                            //$dept = $row99['deptname'].'.';
                            $dept = $row99['deptname'];
                            $sql9 = "SELECT docid FROM `tbdeptlist` WHERE dename = '$request';";
                            $res = mysqli_query($conn,$sql9);
                            $row9 = mysqli_num_rows($res);
                            $maxId = substr($row9, -3);
                            $maxId = ($maxId + 1); 
                            //$year = "/65";
                            $year = date("dmY");
                            $maxId = substr(".00".$maxId, -3);
                            $nextId = $code.$dept.$maxId.$year;

                        ?>
                            <!--เปิดการใช้งาน Form-->
                    <form class="row gy-4" action="./adddoc_db.php" method="POST" enctype="multipart/form-data" id="multiple_select_form">
                            <div class="col-md-12">
                                <label for="docid" class="form-label ">เลขที่เอกสาร</label>
                                <input type="text" class="form-control " id="docid" name="docid" value="<?php echo $nextId ?>" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="label_field hidden">hidden label</label>
                            </div>
                            <div class="col-md-6">
                                <label for="docname" class="form-label ">ชื่อเอกสาร</label>
                                <input type="text" class="form-control " id="docname" name="docname" placeholder="Filename" required>
                            </div>
                            <div class="col-md-6">
                                <label for="doc_file" class="form-label ">UploadFile (เฉพาะไฟล์ PDF เท่านั้น)</label>
                                <input type="file" class="form-control " id="doc_file" name="doc_file" accept="application/pdf" required>
                            </div>
                            <div class="col-md-12">
                                <label class="label_field hidden">hidden label</label>
                            </div>
                            <div class="col-md-4">
                                <label for="dename" class="form-label ">แผนก</label>
                                <input type="text" class="form-control " id="dename" name="dename" value="<?php echo $request ?>" readonly>
                            </div>
                            <br>
                            <div class="form-group col-md-4">
                                <label for="catename" class="form-label ">ประเภทเอกสาร</label>
                                <select class="form-select form-control " id="catename" name="catename" required>
                                    <option value="" selected="" disabled=""> Select Category</option>
                                    <?php
                                    $query1 = "select * from `tbcategory` where dename = '$request' ";
                                    $result1 = mysqli_query($conn, $query1);
                                    if (mysqli_num_rows($result1) > 0) {
                                        while ($row1 = mysqli_fetch_assoc($result1)) {

                                    ?>
                                            <option value="<?php echo $row1['catename']; ?>"><?php echo $row1['catename']; ?></option>
                                    <?php
                                        }
                                    }

                                    ?>

                                </select>    
                            </div>
                            <div class="form-group col-md-4">
                                <label for="membername" class="form-label ">ส่งถึง</label>
                                <select class="js-example-basic-single form-select form-control" id="membername" name="membername" required>
                                    <option value="" selected="" disabled=""> Select Member</option>
                                    <option value="Notice">ประกาศทั่วไป (สำหรับ HR เท่านั้น)</option>
                                    <option value="0">ประกาศภายในแผนก</option>
                                    <?php
                                    $query2 = "select * from `tbmember` where dename = '$request'";
                                    $result2 = mysqli_query($conn, $query2);
                                    if (mysqli_num_rows($result2) > 0) {
                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                    ?>
                                            <option value="<?php echo $row2['membername']; ?>"><?php echo $row2['membername']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>    
                            </div>

                            <div class="form-group col-md-4">
                                <label for="membername" class="form-label ">ผู้อนุมัติ</label>
                                <select class="form-select form-control" id="appname1" name="appname1" required>
                                    <option value="" selected="" disabled=""> เลือกผู้อนุมัติ (S3 - S5)</option>
                                    <?php
                                    $query = "SELECT * FROM `tblistappname` WHERE listlevel = 's3' OR listlevel = 's4' OR listlevel = 's5';";
                                    // $query = mysqli_query($con, $qr);
                                    $result = mysqli_query($conn,$query);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <option class="form-control " value="<?php echo $row['listname']; ?>"><?php echo $row['listname']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                    </select>  
                            </div>
                            <div class="form-group col-md-4">
                            <label class="label_field hidden">hidden label</label>
                                <select class="form-select form-control" id="appname2" name="appname2" required>
                                    <option value="" selected="" disabled=""> เลือกผู้อนุมัติ (S6 - S8)</option>
                                    <option value="ไม่มีผู้อนุมัติ">ไม่มีผู้อนุมัติ</option>
                                    <?php
                                    $query = "SELECT * FROM `tblistappname` WHERE listlevel = 's6' OR listlevel = 's7' OR listlevel = 's8';";
                                    // $query = mysqli_query($con, $qr);
                                    $result = mysqli_query($conn,$query);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <option class="form-control " value="<?php echo $row['listname']; ?>"><?php echo $row['listname']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                    </select>  
                            </div>
                            <div class="form-group col-md-4">
                            <label class="label_field hidden">hidden label</label>
                                <select class="form-select form-control" id="appname3" name="appname3" required>
                                    <option value="" selected="" disabled=""> เลือกผู้อนุมัติ (Boss)</option>
                                    <option value="ไม่มีผู้อนุมัติ">ไม่มีผู้อนุมัติ</option>
                                    <?php
                                    $query = "SELECT * FROM `tblistappname` WHERE listlevel = 'Boss';";
                                    // $query = mysqli_query($con, $qr);
                                    $result = mysqli_query($conn,$query);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <option class="form-control " value="<?php echo $row['listname']; ?>"><?php echo $row['listname']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                    </select>  
                            </div>
                            <br>
                            <div class="col-12">
                                <input type="hidden" id="hdnCount" name="hdnCount">
                                <button type="submit" name="submit" class="btn btn-primary">บันทึก</button>
                            </div>
                        </form> 
                        <!--Form End-->
                                        </div>
                                        
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                            </div>
                            <!-- end dashboard inner -->
                        </div>
                        <?php include('./footer.php') ?>
                        </div>
                    </div>
                </div>
                <?php include('./js.php') ?>

                
   </body>
</html>
<?php } ?>