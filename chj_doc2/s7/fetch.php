<?php
session_start();
include('../php/connect.php');
?>
                    <div class="container1">
                    <div class="table-responsive">
                        <?php 
                        if(isset($_POST['request'])){

                            $request = $_POST['request'];

                            $sql = "SELECT * FROM `tbdepartment` WHERE dename = '$request'";
                            $result = mysqli_query($conn,$sql);
                            $count = mysqli_num_rows($result);
                        ?>
                      <table id="myTABLE1" class="table table-responsive" width="100%">

                            <?php

                            if($count){

                            ?>

                        <thead class="thead-dark">
                          <tr>
                            <th width="5%"></th>
                            <th width="25%"> Department </th>
                            <th width="75%"> category </th>
                          </tr>

                          <?php
                            }else{
                                echo "Sorry! no record Found";
                            };
                          ?>
                        </thead>
                        <tbody>
                        <?php 
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) : ?>
                          <tr>
                          <td></td>
                          <td><?php echo $row['dename'] ?></td>
                          <td>
                            <table class="">
                                <?php
                                $aa = $row['dename'];
                                $sql2 = "SELECT `catename` FROM `tbcategory` WHERE dename = '$aa'";
                                $result2 = mysqli_query($conn, $sql2);
                                    if (mysqli_num_rows($result2) > 0) {
                                        foreach ($result2 as $row2) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row2['catename'] ?></td>
                                        </tr> <?php }
                                    } ?>
                            </table>
                           </td>
                          </tr>
                          <?php endwhile;} ?>
                        </tbody>
                      </table>