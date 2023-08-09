<?php
session_start();
include('../php/connect.php');
if($_SESSION["membername"] == ''){
   echo '<script>alert("SESSION EXPIRED กรุณาเข้าสู่ระบบอีกครั้ง!!")</script>';
   header('Refresh:0; url=https://cjlinfo.com/');
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
                                        เลือกแผนกของท่าน <select class="form-control" name="fetchval" id="fetchval" >
                                            <option value="" disabled="" selected="">Select-Department</option>
                                            <option value="HR">HR</option>
                                            <option value="IT">IT</option>
                                            <option value="MARCOM">MARCOM</option>
                                            <option value="QC">QC</option>
                                            <option value="ขนส่ง">ขนส่ง</option>
                                            <option value="คลังสินค้า">คลังสินค้า</option>
                                            <option value="จัดซื้อ">จัดซื้อ</option>
                                            <option value="ต่างประเทศ">ต่างประเทศ</option>
                                            <option value="บัญชี">บัญชี</option>
                                            <option value="ประสานงานขาย">ประสานงานขาย</option>
                                            <option value="วิเคราะห์การตลาด">วิเคราะห์การตลาด</option>
                                    </select>
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

    <script type="text/javascript">
        $(document).ready(function(){
            $("#fetchval").on('change',function(){
            var value = $(this).val();

            $.ajax({
                url:"fetchadddoc.php",
                type:"POST",
                data: 'request=' + value ,
                beforeSend:function(){
                    $(".container1").html("<span>Working...</span>");
                },
                success:function(data){
                    $(".container1").html(data);
                }
                });
            });
        });
    </script>
   </body>
</html>
<?php } ?>