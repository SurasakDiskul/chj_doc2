<!-- Sidebar  -->
<nav id="sidebar">
               <div class="sidebar_blog_1">
                  <div class="sidebar-header">
                     <div class="logo_section">
                        <a href="index.php"><img class="logo_icon img-responsive" src="../images/logo/T-11.png" alt="#" /></a>
                     </div>
                  </div>
                  <div class="sidebar_user_info">
                     <div class="icon_setting"></div>
                     <div class="user_profle_side">
                        <div class="user_img"><img class="img-responsive" src="../images/logo/T-11.png" alt="#" /></div>
                        <div class="user_info">
                           <h6><?php echo $_SESSION['membername'];?></h6> <p class="text-secondary">พนักงานธุรการแผนก</p>
                           <p><span class="online_animation"></span> Online</p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sidebar_blog_2">
                  <h4>General</h4>
                  <ul class="list-unstyled components">
                     <li class="active">
                        <a href="index.php"><i class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a>
                     </li>
                     <!--
                     <li>
                        <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-diamond purple_color"></i> <span>จัดการสมาชิก</span></a>
                        <ul class="collapse list-unstyled" id="element">
                           <li><a href="./profile.php">> <span>ข้อมูลส่วนตัว</span></a></li>
                           <li><a href="./member.php">> <span>รายชื่อสมาชิก</span></a></li>
                           <li><a href="./department.php">> <span>รายชื่อแผนก</span></a></li>
                        </ul>
                     </li>
-->
                     <li><a href="./category.php"><i class="fa fa-table purple_color2"></i> <span>ประเภทเอกสาร</span></a></li>
                     <li>
                        <a href="#apps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-object-group blue2_color"></i> <span>จัดการเอกสาร</span></a>
                        <ul class="collapse list-unstyled" id="apps">
                           <li><a href="adddoc.php">> <span>เพิ่มเอกสาร</span></a></li>
                           <li><a href="doc.php">> <span>เอกสารอนุมัติใช้งาน</span></a></li>
                           <li><a href="secret.php">> <span>เอกสารส่วนบุคคล</span></a></li>
                           <li><a href="rejdoc.php">> <span>เอกสารไม่ผ่านการอนุมัติ</span></a></li>
                           <li><a href="cndoc.php">> <span>เอกสารที่ถูกยกเลิก (CN)</span></a></li>
                        </ul>
                     </li>
                     <li><a href="../logout.php" onclick="return confirm('คุณต้องการออกจากระบบใช่หรือไม่?')"><i class="fa fa-cog red_color"></i> <span>Logout</span></a></li>
                  </ul>
               </div>
            </nav>
            <!-- end sidebar -->