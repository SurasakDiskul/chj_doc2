<?php
    session_start();
    require_once('../php/connect.php');
    if(!isset($_GET['memberid'])){
        header("location: ./");
        exit();
    }
    $ss = $_GET['memberid'];
    $sql = "SELECT * FROM  tbmember WHERE memberid = '$ss'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
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
                                    <h2>แก้ไขรายชื่อสมาชิก</h2>
                                 </div>
                              </div>
                              <div class="full price_table padding_infor_info">
                                 <div class="row">
                                    <!-- user profile section --> 
                                    <!-- profile image -->
                                    <div class="col-lg-12">
                                    <div class="row ">
              <div class="col-12 grid-margin">
                    <!--เปิดการใช้งาน Form-->
                    <form class="row gy-4" action="./editmember_db.php" method="POST" enctype="multipart/form-data">
                            <div class="col-md-6">
                            <input type="hidden" class="form-control text-dark" id="memberid" name="memberid" value="<?php echo $row['memberid']?>" readonly>
                                <label for="musername" class="form-label">Username</label>
                                <input type="text" class="form-control" id="musername" name="musername" value="<?php echo $row['musername']?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="mpassword" class="form-label">Password</label>
                                <input type="text" class="form-control" id="mpassword" name="mpassword" value="<?php echo $row['mpassword']?>" required>
                            </div>
                            <div class="col-md-12">
                                <label class="label_field hidden">hidden label</label>
                            </div>
                            <div class="col-md-4">
                                <label for="dename" class="form-label">แผนก</label>
                              <input type="text" class="form-control" id="dename" name="dename" value="<?php echo $row['dename']?>" readonly>
                            </div>
                            <br>
                            <div class="col-md-4">
                                <label for="membername" class="form-label">ชื่อ-นามสกุล</label>
                                <input type="text" class="form-control" id="membername" name="membername" value="<?php echo $row['membername'] ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="status" class="form-label">ตำแหน่ง</label>
                              <input type="text" class="form-control" id="status" name="status" value="<?php echo $row['status']?>" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="label_field hidden">hidden label</label>
                            </div>
                            <div class="col-12">
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
                     <?php include('./footer.php') ?>
                  </div>
                  <!-- end dashboard inner -->
               </div>
            </div>
         </div>
      </div>
      <?php include('./js.php') ?>
   </body>
</html>
<?php } ?>