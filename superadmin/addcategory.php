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
                              <h2>จัดการประเภทเอกสาร</h2>
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
                                    <h2>เพิ่มประเภทเอกสาร</h2>
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
                    <form class="row" action="./addcategory_db.php" method="POST">
                        <div class="input field col-lg-12">
                          <table class="responsive" id="dynamic_field" width="100%"> 
                              <th width="30%">แผนก</th>
                              <th width="70%">ประเภทเอกสาร</th>
                                <tr>
                                  <td>
                                    <select class="form-select form-control " id="dename" name="dename">
                                    <option value="" class="form-control " disabled="" selected=""> Select Department</option>
                                    <?php
                                    $query = "select * from `tbdepartment`";
                                    // $query = mysqli_query($con, $qr);
                                    $result = mysqli_query($conn,$query);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <option class="form-control " value="<?php echo $row['dename']; ?>"><?php echo $row['dename']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                    </select>  
                                  </td>
                                  <td>
                                      <input type="text" class="form-control " id="catename" name="catename" placeholder="ประเภทเอกสาร" required>
                                  </td>              
                                  <td>
                                                <input type='button' id='deleteRows' class='btn btn-danger 'value='x'>
                                  </td>
                                </tr>
                              </table>
                             
                              <div class="col-lg-12 col-2 text-center">
                                    <input type="button" id="createRows" class="btn btn-dark "value="+"> <!--Addmore button--> 
                                    </div>
                                </div>
                              <hr>
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
                  <!-- end dashboard inner -->
               </div>
               <?php include('./footer.php') ?>
            </div>
         </div>
      </div>
      <?php include('./js.php') ?>

      <!--addmore button-->
<script type="text/javascript">
$(document).ready(function(){
	var rows = 1;
	$("#createRows").click(function(){
						var tr = "<tr>";
						tr = tr + "<td><select class='form-select form-control' id='dename"+rows+"' name='dename"+rows+"'><option value='' class='form-control' disabled='' selected=''> Select Department</option><?php $query = 'select * from `tbdepartment`';$result = mysqli_query($conn,$query);if (mysqli_num_rows($result) > 0) {while ($row = mysqli_fetch_assoc($result)) {?><option class='form-control' value='<?php echo $row['dename']; ?>'><?php echo $row['dename']; ?></option><?php } } ?></select></td>";
						tr = tr + "<td><input type='text' name='catename"+rows+"' id='catename"+rows+"' class='form-control' placeholder='ประเภทเอกสาร'></td>";
						$('#dynamic_field > tbody:last').append(tr);
					
						$('#hdnCount').val(rows);
						rows = rows + 1;
		});
		$("#deleteRows").click(function(){
				if ($("#dynamic_field tr").length != 1) {
					 $("#dynamic_field tr:last").remove();
				}
		});

		$("#clearRows").click(function(){
				rows = 1;
				$('#hdnCount').val(rows);
				$('#myTable > tbody:last').empty(); // remove all
		});

	});
</script>
    <!--addmore button end-->
   </body>
</html>
<?php } ?>