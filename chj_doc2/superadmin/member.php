<?php
session_start();
include('../php/connect.php');
if($_SESSION["membername"] == ''){
   echo '<script>alert("SESSION EXPIRED กรุณาเข้าสู่ระบบอีกครั้ง!!")</script>';
   header('Refresh:0; url=http://171.103.161.10:2222/');
}else{
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
                              <h2>รายชื่อสมาชิกทั้งหมด</h2>
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
                                    <h2>รายชื่อสมาชิก</h2>
                                 </div>
                              </div>
                              <div class="full price_table padding_infor_info">
                                 <div class="row">
                                    <!-- user profile section --> 
                                    <!-- profile image -->
                                    <div class="col-lg-12">
                                    <div class="row ">
              <div class="col-12 grid-margin">
                  <a href="./addmember.php" class="btn btn-success" style="float:left;">เพิ่มรายชื่อสมาชิก</a>
                  <br><br>
                    <div class="table-responsive">
                        <?php 
                            $i = 1;
                            $sql = "SELECT * FROM `tbmember`";
                            $result = mysqli_query($conn,$sql);
                        ?>
                      <table id="myTABLE" class="table table-responsive" width="100%">
                        <thead class="thead-dark">
                          <tr>
                            <th width="5%">#</th>
                            <th width="10%"> Username </th>
                            <th width="10%"> Password </th>
                            <th width="100%"> Full Name </th>
                            <th width="100%"> Department </th>
                            <th width="100%"> Level </th>
                            <th width="100%"> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                          <tr>
                          <td><?php echo $i++ ?></td>
                          <td><?php echo $row['musername'] ?></td>
                          <td><?php echo $row['mpassword'] ?></td>
                          <td><?php echo $row['membername'] ?></td>
                          <td><?php echo $row['dename'] ?></td>
                          <td><?php echo $row['status'] ?></td>
                          <td>
                            <div class="btn-group text-white">
                              <a href="editmember.php?memberid=<?php echo $row['memberid'] ?>" class="btn btn-warning text-dark fa fa-edit"></a>
                              <a href="delmember.php?memberid=<?php echo $row['memberid'] ?>" class="btn btn-danger text-white fa fa-trash"></a>
                            </div>
                          </td>
                          </tr>
                          <?php endwhile; ?>
                        </tbody>
                      </table>
                      
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