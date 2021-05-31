<?php 

// create session
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['level']))
{
  // include file
  include('../layouts/header.php');
  include('../layouts/topbar.php');
  include('../layouts/sidebar.php');
?>
<div class="xem_diem">
<iframe style="width:100%;height:100vh" src="http://dangky.hvu.edu.vn/default.aspx?page=nhapmasv&flag=XemDiemThi" title="Xem điểm"></iframe>
</div>
<?php
  // include
  include('../layouts/footer.php');
}
else
{
  // go to pages login
  header('Location: dang-nhap.php');
}

?>