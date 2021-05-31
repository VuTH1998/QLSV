<?php 

// create session
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['level']))
{
  // include file
  include('../layouts/header.php');
  include('../layouts/topbar.php');
  include('../layouts/sidebar.php');
  
  // tinh thang tinh luong
  $thangTinhLuong = date_create(date("Y-m-d"));
  $thangTLFormat = date_format($thangTinhLuong, 'm/Y');


  if(isset($_POST['chiTietLuong']))
  {
    $maNhanVien = $_POST['maNhanVien'];
    echo "<script>location.href='chi-tiet-hoc-phi.php?p=salary&a=salary&id=".$maNhanVien."'</script>";
  }

  if(isset($_POST['tinhLuong']))
  {
    $id = $_POST['idNhanVien'];
    echo "<script>location.href='tinh-hoc-phi.php?p=salary&a=salary&id=".$id."'</script>";
  }

  // show data
  $showData = "SELECT ma_hoc_phi, hinh_anh, nv.id as idNhanVien,ho_sv, ten_sv, ten_chuc_vu, hoc_phi_ky, so_tin_chi, da_nop, con_no, ngay_dong FROM hoc_phi l, sinhvien nv, chuc_vu cv WHERE nv.id = l.sinhvien_id AND nv.chuc_vu_id = cv.id ORDER BY l.id DESC";
  $result = mysqli_query($conn, $showData);
  $arrShow = array();
  while ($row = mysqli_fetch_array($result)) {
    $arrShow[] = $row;
  }
  // echo $showData;
  // die;

  // xoa record luong
  if(isset($_POST['delete']))
  {
    $maLuong = $_POST['maLuong'];
    $xoaLuong = "DELETE FROM hoc_phi WHERE ma_hoc_phi = '$maLuong'";
    $resultXoaLuong = mysqli_query($conn, $xoaLuong);
    if($resultXoaLuong)
    {
      $showMess = true;
      $success['success'] = 'Xóa record học phí thành công.';
      echo '<script>setTimeout("window.location=\'bang-hoc-phi.php?p=salary&a=salary\'",1000);</script>';
    }
  }

?>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form method="POST">
          <div class="modal-header">
            <span style="font-size: 18px;">Thông báo</span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="maLuong">
            Bạn có thực sự muốn xóa record học phí này?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
            <button type="submit" class="btn btn-primary" name="delete">Xóa</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Tính học phí sinh viên
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
        <li><a href="bang-hoc-phi.php?p=salary&a=salary">Bảng học phí</a></li>
        <li class="active">Tính học phí sinh viên</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>SAL</h3>
              <p>Tính học phí</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="tinh-hoc-phi.php?p=salary&a=salary" class="small-box-footer">
              Nhấn vào để tính học phí <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>EXCEL</h3>
              <p>Xuất Excel</p>
            </div>
            <div class="icon">
              <i class="fa fa-file"></i>
            </div>
            <a href="export-bang-hoc-phi.php" class="small-box-footer">
              Nhấn vào xuất file excel <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Bảng học phí</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php 
                // show error
                if($row_acc['quyen'] != 1) 
                {
                  echo "<div class='alert alert-warning alert-dismissible'>";
                  echo "<h4><i class='icon fa fa-ban'></i> Thông báo!</h4>";
                  echo "Bạn <b> không có quyền </b> thực hiện chức năng này.";
                  echo "</div>";
                }
              ?>

              <?php 
                // show error
                if(isset($error)) 
                {
                  if($showMess == false)
                  {
                    echo "<div class='alert alert-danger alert-dismissible'>";
                    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                    echo "<h4><i class='icon fa fa-ban'></i> Lỗi!</h4>";
                    foreach ($error as $err) 
                    {
                      echo $err . "<br/>";
                    }
                    echo "</div>";
                  }
                }
              ?>
              <?php 
                // show success
                if(isset($success)) 
                {
                  if($showMess == true)
                  {
                    echo "<div class='alert alert-success alert-dismissible'>";
                    echo "<h4><i class='icon fa fa-check'></i> Thành công!</h4>";
                    foreach ($success as $suc) 
                    {
                      echo $suc . "<br/>";
                    }
                    echo "</div>";
                  }
                }
              ?>
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã học phí</th>
                    <th>Tên sinh viên</th>
                    <th>Chức vụ</th>
                    <th>Học phí kỳ</th>
                    <th>Số tín chỉ</th>
                    <th>Đã đóng</th>
                    <th>Còn nợ</th>
                    <th>Ngày nộp</th>
                    <th>Chi tiết</th>
                    <th>Xóa</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $count = 1;
                    foreach ($arrShow as $arrS) 
                    {
                  ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $arrS['ma_hoc_phi']; ?></td>
                        <td><?php echo $arrS['ho_sv']." ".$arrS['ten_sv']; ?></td>
                        <td><?php echo $arrS['ten_chuc_vu']; ?></td>
                        <td><?php echo number_format($arrS['hoc_phi_ky'])."vnđ"; ?></td>
                        <td class="text-center"><?php echo $arrS['so_tin_chi']; ?></td>
                        <td><?php echo number_format($arrS['da_nop'])."vnđ"; ?></td>
                        <td style="color: blue; font-weight: bold;"><?php echo number_format($arrS['con_no'])."vnđ"; ?></td>
                        <td class="text-center">
                        <?php echo date_format(date_create($arrS['ngay_dong']), "d-m-Y"); ?>
                        </td>
                        <td>
                          <?php 
                            if($row_acc['quyen'] == 1)
                            {
                              echo "<form method='POST'>";
                              echo "<input type='hidden' value='".$arrS['idNhanVien']."' name='maNhanVien'/>";
                              echo "<button type='submit' class='btn btn-primary btn-flat'  name='chiTietLuong'><i class='fa fa-eye'></i></button>";
                              echo "</form>";
                            }
                            else
                            {
                              echo "<button type='button' class='btn btn-primary btn-flat' disabled><i class='fa fa-eye'></i></button>";
                            }
                          ?>
                          
                        </td>
                        <td>
                          <?php 
                            if($row_acc['quyen'] == 1)
                            {
                              echo "<button type='button' class='btn bg-maroon btn-flat' data-toggle='modal' data-target='#exampleModal' data-whatever='".$arrS['ma_hoc_phi']."'><i class='fa fa-trash'></i></button>";
                            }
                            else
                            {
                              echo "<button type='button' class='btn bg-maroon btn-flat' disabled><i class='fa fa-trash'></i></button>";
                            }
                          ?>
                        </td>
                      </tr>
                  <?php
                      $count++;
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
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