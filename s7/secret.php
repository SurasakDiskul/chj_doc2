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
                              <h2>จัดการเอกสาร</h2>
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
                                    <h2>เอกสารส่วนบุคคล</h2>
                                 </div>
                              </div>
                              <div class="full price_table padding_infor_info">
                                 <div class="row">
                                    <!-- user profile section --> 
                                    <!-- profile image -->
                                    <div class="col-lg-12">
                                    <div class="row ">
              <div class="col-12 grid-margin">
                    <div class="table-responsive col-lg-12">
                        <?php 
                            $aa = $_SESSION['membername'];
                            $sql = "SELECT * FROM `tbdoc` WHERE catename = 'ใบเตือน' AND membername = '$aa' AND docstatus = '1'";
                            $result = mysqli_query($conn,$sql);
                        ?>
                      <table id="myTABLE" class="table table-responsive" width="100%">
                      <thead class="thead-light">
                          <tr>
                            <th width="5%">เลขที่เอกสาร</th>
                            <th width="10%"> ชื่อเอกสาร </th>
                            <th width="20%"> ประเภทเอกสาร </th>
                            <th width="20%"> ไฟล์เอกสาร </th>
                            <th width="20%"> ส่งถึง </th>
                            <th width="10%"> แผนก </th>
                            <th width="10%"> วันที่เอกสาร </th>
                            <th width="5%"> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                          <tr>
                          <td class="text-dark"><?php echo $row['docid'] ?></td>
                          <td class="text-dark"><?php echo $row['docname'] ?></td>
                          <td class="text-dark"><?php echo $row['catename'] ?></td>
                          <td class="text-dark"><?php echo $row['docfile'] ?></td>
                          <td class="text-dark"><?php echo $row['membername'] ?></td>
                          <td class="text-dark"><?php echo $row['dename'] ?></td>
                          <td class="text-dark"><?php echo $row['dateup']; ?></td>
                          <td>
                           <a class="btn btn-warning btn-sm text-dark" href="../doc_file/<?php echo $row['docfile'] ?>" target="_blank">View</a>
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