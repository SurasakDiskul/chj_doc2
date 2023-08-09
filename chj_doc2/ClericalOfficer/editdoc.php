<?php
    session_start();
    require_once('../php/connect.php');
    if(!isset($_GET['docid'])){
        header("location: ./");
        exit();
    }
    $ss = $_GET['docid'];
    $sql = "SELECT * FROM tbdoc WHERE docid = '$ss'";
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
                                    <h2>แก้ไขเอกสาร</h2>
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
                    <form class="row gy-4" action="./editdoc_db.php" method="POST" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label for="docid" class="form-label ">เลขที่เอกสาร</label>
                                <input type="text" class="form-control " id="docid" name="docid" value="<?php echo $row['docid'] ?>" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="label_field hidden">hidden label</label>
                            </div>
                            <div class="col-md-6">
                                <label for="docname" class="form-label ">ชื่อเอกสาร</label>
                                <input type="text" class="form-control " id="docname" name="docname" value="<?php echo $row['docname'] ?>" required>
                            </div>
                            <div class="col-md-6">
                            <label for="doc_file" class="form-label ">File เอกสาร</label><br>
                                <a class="btn btn-info btn-sm" href="../doc_file/<?php echo $row['docfile'];?>" target="_blank">ดูไฟล์เอกสาร</a>
                                <input type="hidden" id="file" name="file" value="<?php echo $row["docfile"];?>">                            
                            </div>
                            <div class="col-md-12">
                                <label class="label_field hidden">hidden label</label>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="dename" class="form-label ">แผนก</label>
                                <select class="form-select form-control " id="dename" name="dename" readonly>
                                    <option value="<?php echo $row['dename'] ?>"><?php echo $row['dename'] ?></option>
                                </select>    
                            </div>
                            <br>
                            <div class="form-group col-md-4">
                                <label for="catename" class="form-label">ประเภทเอกสาร</label>
                                <select class="form-select form-control" id="catename" name="catename" readonly>
                                    <option value="<?php echo $row['catename'] ?>"><?php echo $row['catename'] ?></option>
                                </select>    
                            </div>
                            <div class="form-group col-md-4">
                                <label for="membername" class="form-label">ส่งถึง</label>
                                <select class="form-select form-control" id="membername" name="membername" readonly>
                                    <option value="<?php echo $row['membername'] ?>"> <?php echo $row['membername'] ?></option>
                                </select>    
                            </div>

                            <?php
                        $xx = $_SESSION['membername'];
                        $aa = $row['docid'];
//<!--------------------------------------------------------------------Approve----------------------------------------------------------------------------------------------->
                        $sql2 = "SELECT appname1 FROM `tbappname` WHERE docid = '$aa'";
                        $result2 = mysqli_query($conn, $sql2);
                        $row2 = mysqli_fetch_assoc($result2);
                        $sql3 = "SELECT appstatus1 FROM `tbappname` WHERE docid = '$aa'";
                        $result3 = mysqli_query($conn, $sql3);
                        $row3 = mysqli_fetch_assoc($result3);
//<!--------------------------------------------------------------------Approve1----------------------------------------------------------------------------------------------->
                        $sql4 = "SELECT appname2 FROM `tbappname` WHERE docid = '$aa' and appname2 !=''";
                        $result4 = mysqli_query($conn, $sql4);
                        $row4 = mysqli_fetch_assoc($result4);
                        $sql5 = "SELECT appstatus2 FROM `tbappname` WHERE docid = '$aa' and appname2 !=''";
                        $result5 = mysqli_query($conn, $sql5);
                        $row5 = mysqli_fetch_assoc($result5);
//<!---------------------------------------------------------------------Approve2---------------------------------------------------------------------------------------------->
                        $sql6 = "SELECT appname3 FROM `tbappname` WHERE docid = '$aa' and appname3 !=''";
                        $result6 = mysqli_query($conn, $sql6);
                        $row6 = mysqli_fetch_assoc($result6);
                        $sql7 = "SELECT appstatus3 FROM `tbappname` WHERE docid = '$aa' and appname3 !=''";
                        $result7 = mysqli_query($conn, $sql7);
                        $row7 = mysqli_fetch_assoc($result7);
//<!---------------------------------------------------------------------Approve3--------------------------------------------------------------------------------------------->
                        ?>
                            <div class="col-md-6">
                                <label for="docname" class="form-label ">ผู้อนุมัติ</label>
                                <input type="text" class="form-control" id="approve1" name="approve1" value="<?php echo $row2['appname1']?>" readonly>
                            </div> <div class="col-md-6">
                                <label for="docname" class="form-label ">สถานะเอกสาร</label>
                                <input type="text" class="form-control" id="appstatus" name="appstatus" value="<?php echo $row3['appstatus1']?>" readonly>
                            </div>
                            <div class="col-md-6">
                            <label class="label_field hidden">hidden label</label>
                                <input type="text" class="form-control" id="approve2" name="approve2" value="<?php echo $row4['appname2']?>" readonly>
                            </div> <div class="col-md-6">
                            <label class="label_field hidden">hidden label</label>
                                <input type="text" class="form-control" id="appstatus" name="appstatus" value="<?php echo $row5['appstatus2']?>" readonly>
                            </div>
                            <div class="col-md-6">
                            <label class="label_field hidden">hidden label</label>
                                <input type="text" class="form-control" id="approve3" name="approve3" value="<?php echo $row6['appname3']?>" readonly>
                            </div> <div class="col-md-6">
                            <label class="label_field hidden">hidden label</label>
                                <input type="text" class="form-control" id="appstatus" name="appstatus" value="<?php echo $row7['appstatus3']?>" readonly>
                            </div>
                                </div>
                            
                            <div class="col-12">
                            <Hr>
                            <a type="button" class="btn btn-dark" href="./doc.php">ย้อนกลับ</a>
                                
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
      
</html>
<?php } ?>