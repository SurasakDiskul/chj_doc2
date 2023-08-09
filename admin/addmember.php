<?php
session_start();
include('../php/connect.php');
?>
<?php
if($_SESSION["membername"] == ''){
   echo '<script>alert("SESSION EXPIRED กรุณาเข้าสู่ระบบอีกครั้ง!!")</script>';
   header('Refresh:0; url=https://cjlinfo.com/');
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
   <?php include('./css.php') ?>
</head>

<body class="dashboard dashboard_1">
   <div class="full_container">
      <div class="inner_container">
         <?php include('./sidebar.php') ?>
         <!-- right content -->
         <div id="content">
            <?php include('./topbar.php') ?>
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
                                 <h2>เพิ่มรายชื่อสมาชิก</h2>
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
                                          <form class="row gy-4" action="./addmember_db.php" method="POST" enctype="multipart/form-data">
                                             <div class="col-md-6">
                                                <label for="musername" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="musername" name="musername" placeholder="Username" required>
                                             </div>
                                             <div class="col-md-6">
                                                <label for="mpassword" class="form-label">Password</label>
                                                <input type="text" class="form-control" id="mpassword" name="mpassword" placeholder="Password" required>
                                             </div>
                                             <div class="col-md-12">
                                                <label class="label_field hidden">hidden label</label>
                                             </div>
                                             <div class="col-md-4">
                                                <label for="dename" class="form-label">แผนก</label>
                                                <select class="form-select form-control" id="dename" name="dename">
                                                   <option value="" disabled="" selected=""> Select Department</option>
                                                   <?php
                                                   $query = "select * from `tbdepartment`";
                                                   $result = mysqli_query($conn, $query);
                                                   if (mysqli_num_rows($result) > 0) {
                                                      while ($row = mysqli_fetch_assoc($result)) {
                                                   ?>
                                                         <option class="form-control" value="<?php echo $row['dename']; ?>"><?php echo $row['dename']; ?></option>
                                                   <?php
                                                      }
                                                   }
                                                   ?>
                                                </select>
                                             </div>
                                             <br>
                                             <div class="col-md-4">
                                                <label for="membername" class="form-label">ชื่อ-นามสกุล</label>
                                                <input type="text" class="form-control" id="membername" name="membername" placeholder="ชื่อ-นามสกุล" required>
                                             </div>
                                             <div class="col-md-4">
                                                <label for="status" class="form-label">ตำแหน่ง</label>
                                                <select class="form-select form-control" id="status" name="status">
                                                   <option value="" disabled="" selected=""> Select Level</option>
                                                   <option value="ClericalOfficer" class="form-control">ธุรการแผนก</option>
                                                   <option value="S1" class="form-control"> S1 -พนักงาน</option>
                                                   <option value="S2" class="form-control"> S2 -พนักงานอาวุโส</option>
                                                   <option value="S3" class="form-control"> S3 -หัวหน้าแผนก</option>
                                                   <option value="S4" class="form-control"> S4 -ผู้ช่วยผู้จัดการแผนก</option>
                                                   <option value="S5" class="form-control"> S5 -ผู้จัดการแผนก</option>
                                                   <option value="S6" class="form-control"> S6 -ผู้จัดการฝ่าย</option>
                                                   <option value="S7" class="form-control"> S7 -รองผู้จัดการทั่วไป</option>
                                                   <option value="S8" class="form-control"> S8 -ผู้จัดการทั่วไป</option>
                                                   <option value="ADMIN" class="form-control"> ADMIN -HR</option>
                                                   <option value="BOSS" class="form-control"> BOSS -กรรมการบริษัท</option>
                                                </select>
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