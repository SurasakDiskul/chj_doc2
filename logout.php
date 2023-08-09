<?php include('./php/connect.php');
session_start(); ?>
<?php session_destroy();
echo '<script>
setTimeout(function() {
 swal({
     title: "ออกจากระบบสำเร็จ!",
     text: "กลับไปที่หน้า Login.",
     type: "warning",
     showConfirmButton: true
 }, function() {
     window.location = "https://cjlinfo.com/"; //หน้าที่ต้องการให้กระโดดไป
 });
}, 1000);
</script>';
?>


