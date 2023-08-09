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
                                    <h2>เอกสารทั้งหมด</h2>
                                 </div>
                              </div>
                              <div class="full price_table padding_infor_info">
                                 <div class="row">
                                    <!-- user profile section --> 
                                    <!-- profile image -->
                                    <div class="col-lg-12">
                                    <div class="row ">
              <div class="col-12 grid-margin">
              <!--<a href="./adddoc.php" class="btn btn-primary" style="float:left;">เพิ่มเอกสาร</a>-->
                    <div class="table-responsive col-lg-12">
                        <?php 
                            $aa = $_SESSION['dename'];
                            $sql = "SELECT * FROM `tbdoc` WHERE docstatus = '1' AND dename = '$aa' ORDER BY id DESC"; //membername = 'Notice' OR
                            $result = mysqli_query($conn,$sql);
                        ?>
                      <table id="myTABLE" class="table table-responsive" width="100%">
                      <thead class="thead-dark">
                          <tr>
                            <th width="5%">เลขที่เอกสาร</th>
                            <th width="10%">ชื่อเอกสาร </th>
                            <th width="20%"> ประเภทเอกสาร </th>
                            <th width="20%"> ไฟล์เอกสาร </th>
                            <th width="25%"> ส่งถึง </th>
                            <th width="15%"> แผนก </th>
                            <th width="5%"> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                          <tr>
                          <td><?php echo $row['docid'] ?></td>
                          <td><?php echo $row['docname'] ?></td>
                          <td><?php echo $row['catename'] ?></td>
                          <td><?php echo $row['docfile'] ?></td>
                          <td><?php echo $row['membername'] ?></td>
                          <td><?php echo $row['dename'] ?></td>
                          <td>
                          <div class="dropdown_section">
                              <div class="dropdown">
                                 <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action</button>
                                 <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                    <!--<a class="dropdown-item text-info" href="../doc_file/<?php echo $row['docfile'];?>" target="_blank">View</a>-->
                                    <a class="dropdown-item text-info" href="editdoc.php?docid=<?php echo $row['docid'] ?>">View</a>
                                 </div>
                              </div>
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