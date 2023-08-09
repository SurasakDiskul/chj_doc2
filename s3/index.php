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

   <!--Dashboard DATA-->
   <?php 
    $dename = $_SESSION['dename'];
    $sql = "SELECT COUNT( musername ) FROM tbmember";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_row($res);
    $sum = $row[0];

    $res1 = mysqli_query($conn,"SELECT COUNT( musername ) FROM tbmember where dename = '$dename'");
    $row1 = mysqli_fetch_row($res1);
    $sum1 = $row1[0];

    $res2 = mysqli_query($conn,"SELECT COUNT( docname ) FROM tbdoc where dename = '$dename' and docstatus = '1'");
    $row2 = mysqli_fetch_row($res2);
    $sum2 = $row2[0];

    $res3 = mysqli_query($conn,"SELECT COUNT( docid ) FROM tbcancel where department = '$dename'");
    $row3 = mysqli_fetch_row($res3);
    $sum3 = $row3[0];
   ?>
   <!--Dashboard DATA-->

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
                              <h2>Dashboard <span class="text-secondary">- แผนก <?php echo $_SESSION['dename'] ?></span> </h2>
                           </div>
                        </div>
                     </div>
                     <div class="row column1">
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-user yellow_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no"><?php echo $sum ?></p>
                                    <p class="head_couter">จำนวนพนักงานในบริษัท</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-clock-o blue1_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no"><?php echo $sum1 ?></p>
                                    <p class="head_couter">จำนวนสมาชิกในแผนก</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-cloud-download green_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no"><?php echo $sum2 ?></p>
                                    <p class="head_couter">เอกสารอนุมัติใช้งาน</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                           <div class="full counter_section margin_bottom_30">
                              <div class="couter_icon">
                                 <div> 
                                    <i class="fa fa-comments-o red_color"></i>
                                 </div>
                              </div>
                              <div class="counter_no">
                                 <div>
                                    <p class="total_no"><?php echo $sum3 ?></p>
                                    <p class="head_couter">เอกสารที่ถูกยกเลิก (CN)</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
            <div class="row ">
              <div class="col-md-8">
              <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-dark">เอกสารทั่วไป ( ประกาศจาก HR )</h4>
                    <div class="table-responsive">
                        <?php 
                            $sql = "SELECT * FROM `tbdoc` WHERE membername = 'Notice' ";
                            $result = mysqli_query($conn,$sql);
                        ?>
                      <table id="myTABLE" class="table table-responsive" width="100%">
                      <thead class="thead-dark">
                          <tr>
                            <th width="20%">DocID</th>
                            <th width="20%"> Filename </th>
                            <th width="20%"> category </th>
                            <th width="35%"> DocFile </th>
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
                          <td class="text-dark">
                              <a class="btn btn-info text-dark fa fa-eye" href="../doc_file/<?php echo $row['docfile'];?>" target="_blank"></a>
                          </td>
                          </tr>
                          <?php endwhile; ?>
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
            <?php 
               $membername = $_SESSION['membername'];
               $sql1 = "SELECT * FROM `tbapproval` WHERE approver = '$membername' GROUP BY _id ORDER BY _id DESC LIMIT 5 ;";
               $result1 = mysqli_query($conn,$sql1);
            ?>
                           <div class="card">
                              <div class="card-body">
                                 <div class="dash_head">
                                    <h3><span><i class="fa fa-comments-o"></i> Notification</span></h3>
                                 </div>
                                 <div class="msg_list_main">
                                    <ul class="msg_list">
                                    <?php if (mysqli_num_rows($result1) > 0) : ?>
                                    <?php while ($row1 = mysqli_fetch_assoc($result1)) : ?>
                                       <li>
                                          <span>
                                          <span class="name_user">ไฟล์ :  <?php echo $row1['doc_id'] ?></span>
                                          <span class="msg_user">ชื่อไฟล์ :  <?php echo $row1['doc_name'] ?></span><br>
                                          <span class="msg_user">ผู้เพิ่มเอกสาร : <?php echo $row1['add_by'] ?></span>   ->
                                          <a type="button" class="btn btn-success" href="approvedoc.php?doc_id=<?php echo $row1['doc_id'] ?>">GO</a>
                                          </span>
                                       </li>
                                       <?php endwhile; ?>
                                       <?php
                                else :
                                    echo "<p class='mt-5'> No other notification may be made to you about any amendments</p>";
                                endif;
                                ?>
                                    </ul>
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
      <?php include('./js.php') ?>
   </body>
</html>
<?php } ?>