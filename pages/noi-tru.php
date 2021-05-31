<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// create session
session_start();



if(isset($_SESSION['username']) && isset($_SESSION['level']))
{
  // include file
  include('../layouts/header.php');
  include('../layouts/topbar.php');
  include('../layouts/sidebar.php');
  


  // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //   if(isset($_POST['save']))
  //   {
  //     echo "SAVE";
  //   }
  //   echo "111";
  //   print_r($_POST);
  //   die; 
  // }

  // show data
  $NV = "SELECT id, ma_sv ,ma_sinhvien ,ho_sv, ten_sv FROM sinhvien";
  $resultNV = mysqli_query($conn, $NV);
  $arrNV = array();
  while ($rowNV = mysqli_fetch_array($resultNV)) {
    $arrNV[] = $rowNV;
  }

  // create code room
  $maCongTac = "MNT" . time();

  // delete record
  if(isset($_POST['save']))
  {
    // create array error
    $error = array();
    $success = array();
    $showMess = false;

    // get id in form
    $maNhanVien = $_POST['maNhanVien'];
    $ngayBatDau = $_POST['ngayBatDau'];
    $ngayKetThuc = $_POST['ngayKetThuc'];
    $diaDiem = $_POST['diaDiem'];
    $mucDich =htmlentities(mysqli_real_escape_string($conn, $_POST['mucDich']));
    $ghiChu = mysqli_real_escape_string($conn, $_POST['ghiChu']);
    $nguoiTao = $_POST['nguoiTao'];
    $ngayTao = date("Y-m-d H:i:s");

    // validate
    if($maNhanVien == 'chon')
      $error['maNhanVien'] = 'error';
    if(empty($ngayKetThuc))
      $error['ngayKetThuc'] = 'error';
    if(!empty($ngayKetThuc) && ($ngayBatDau > $ngayKetThuc))
      $error['loiNgay'] = 'error';
    if(empty($diaDiem))
      $error['diaDiem'] = 'error';

    // kiem tra nhan vien co dang trong qua trinh cong tac
    $check = "SELECT sinhvien_id FROM noi_tru WHERE sinhvien_id = '$maNhanVien'";
    $resultCheck = mysqli_query($conn, $check);
    if(mysqli_num_rows($resultCheck) != 0)
    {
      $error['dangCongTac'] = 'error';
      echo "<script>alert('sinh viên này đang trong quá trình nội trú');</script>";
    }


    if(!$error)
    {
      $showMess = true;
      $insert = "INSERT INTO noi_tru(ma_noi_tru, sinhvien_id, ngay_bat_dau, ngay_ket_thuc, dia_diem, muc_dich, ghi_chu, nguoi_tao, ngay_tao, nguoi_sua) VALUES('$maCongTac','$maNhanVien', '$ngayBatDau', '$ngayKetThuc', '$diaDiem', '$mucDich', '$ghiChu', '$nguoiTao', '$ngayTao','$nguoiTao')";
      echo $insert;
      $result = mysqli_query($conn, $insert);
      if($result)
      {
        $success['success'] = 'Thêm nội trú thành công';
        echo '<script>setTimeout("window.location=\'noi-tru.php?p=collaborate&a=add-collaborate\'",1000);</script>';
      }
    }
  }

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Nội trú
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
        <li><a href="noi-tru.php?p=collaborate&a=add-collaborate">Nội trú</a></li>
        <li class="active">Thêm nội trú</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Thêm nội trú</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
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
              <form action="" method="POST">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Mã nội trú: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="maCongTac" value="<?php echo $maCongTac; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Chọn sinh viên<span style="color: red;">*</span> : </label>
                      <select class="form-control" name="maNhanVien">
                        <option value="chon">--- Chọn sinh viên ---</option>
                        <?php 
                        foreach ($arrNV as $nv) 
                        {
                          echo "<option value='".$nv['id']."'>". $nv['ma_sinhvien'] ." - ".$nv['ho_sv']." ".$nv['ten_sv']."</option>";
                        }
                        ?>
                      </select>
                      <small style="color: red;"><?php if(isset($error['maNhanVien'])){ echo 'Vui lòng chọn sinh viên';} ?></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ngày bắt đầu<span style="color: red;">*</span>: </label>
                      <input type="date" class="form-control" id="exampleInputEmail1" name="ngayBatDau" value="<?php echo date('Y-m-d'); ?>">
                      <small style="color: red;"><?php if(isset($error['loiNgay'])){ echo 'Ngày bắt đầu <b> không được sau </b> ngày kết thúc';} ?></small>
                    </div>  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ngày kết thúc<span style="color: red;">*</span>: </label>
                      <input type="date" class="form-control" id="exampleInputEmail1" name="ngayKetThuc">
                      <small style="color: red;"><?php if(isset($error['ngayKetThuc'])){ echo 'Vui lòng chọn ngày kết thúc';} ?></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Địa chỉ phòng trọ:<span style="color: red;">*</span>: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="diaDiem" placeholder="Vui lòng nhập địa điểm">
                      <small style="color: red;"><?php if(isset($error['diaDiem'])){ echo 'Vui lòng nhập địa điểm nội trú';} ?></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Hộ khẩu thường trú </label>
                      <textarea id="editor1" rows="10" cols="80" name="mucDich">
                      </textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ghi chú: </label>
                      <textarea id="editor" class="form-control" name="ghiChu"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Người tạo: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $row_acc['ho']; ?> <?php echo $row_acc['ten']; ?>" name="nguoiTao" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ngày tạo: </label>
                      <input type="text" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="ngayTao" readonly>
                    </div>
                    <!-- /.form-group -->
                    <?php 
                      if($_SESSION['level'] == 1)
                        echo "<button type='submit' class='btn btn-primary' name='save'><i class='fa fa-plus'></i> Thêm nội trú</button>";
                    ?>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </form>
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