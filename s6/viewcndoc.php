<?php
    session_start();
    require_once('../php/connect.php');
    if(!isset($_GET['doc_id'])){
        header("location: ./");
        exit();
    }
    $ss = $_GET['doc_id'];
    $sql = "SELECT * FROM tbcancel WHERE docid = '$ss'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
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
                                    <h2>เอกสารที่ถูกยกเลิก ( CN )</h2>
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
                    <form class="row gy-4" action="" method="POST" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <label for="docid" class="form-label ">เลขที่เอกสาร</label>
                                <input type="text" class="form-control " id="docid" name="docid" value="<?php echo $row['docid'] ?>" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="label_field hidden">hidden label</label>
                            </div>
                            <div class="col-md-6">
                                <label for="docname" class="form-label ">ชื่อเอกสาร</label>
                                <input type="text" class="form-control " id="doc_name" name="doc_name" value="<?php echo $row['filename'] ?>" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="doc_file" class="form-label ">File เอกสาร</label><br>
                                <a class="btn btn-info" href="../doc_file/<?php echo $row['docfile'];?>" target="_blank">View</a>
                                <input type="hidden" id="file" name="file" value="<?php echo $row["docfile"];?>">                            
                            </div>
                            <div class="col-md-12">
                                <label class="label_field hidden">hidden label</label>
                            </div>
                            <div class="col-md-6">
                            <label for="cate_name" class="form-label ">ประเภทเอกสาร</label>
                            <input type="text" class="form-control " id="cate_name" name="cate_name" value="<?php echo $row['category'] ?>" readonly>
                            </div>
                            <div class="col-md-6">
                            <label for="de_name" class="form-label ">แผนก</label>
                            <input type="text" class="form-control " id="de_name" name="de_name" value="<?php echo $row['department'] ?>" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="label_field hidden">hidden label</label>
                            </div>
                            <div class="col-md-4">
                            <label for="add_by" class="form-label ">ผู้เพิ่มเอกสาร</label>
                            <input type="text" class="form-control " id="add_by" name="add_by" value="<?php echo $row['addby'] ?>" readonly>
                            </div>
                            <div class="col-md-4">
                            <label for="sendto" class="form-label ">ส่งถึง</label>
                            <input type="text" class="form-control " id="sendto" name="sendto" value="<?php echo $row['sendto'] ?>" readonly>
                            </div>
                            <div class="col-md-4">
                            <label for="rejby" class="form-label ">ผู้ไม่อนุมัติ</label>
                            <input type="text" class="form-control " id="rejby" name="rejby" value="<?php echo $row['rejectby'] ?>" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="label_field hidden">hidden label</label>
                            </div>
                            <div class="col-md-12">
                                <label class="">หมายเหตุ</label>
                                <input type="text" class="form-control " id="remark" name="remark" value="<?php echo $row['remark'] ?>" readonly>
                            </div>
                            <div class="col-12">
                            <hr>
                                <a href="./cndoc.php" type="submit" name="submit" class="btn btn-danger">ย้อนกลับ</a>
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