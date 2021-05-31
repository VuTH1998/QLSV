<?php 

// create session
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['level']))
{
    // include file
    include('../layouts/header.php');
    include('../layouts/topbar.php');
    include('../layouts/sidebar.php');


    // tao bien mac dinh
    $salaryCode = "MD" . time();
    // show data
    $nv = "SELECT id, ma_sinhvien,ho_sv, ten_sv FROM sinhvien WHERE trang_thai <> 0";
    $resultNV = mysqli_query($conn, $nv);
    $arrNV = array();
    while($rowNV = mysqli_fetch_array($resultNV)){
        $arrNV[] = $rowNV;
    }
    //  // ----- Trình độ
    // $trinhDo = "SELECT id, ten_nam_sinh_vien FROM nam_sinh_vien";
    // $resultTrinhDo = mysqli_query($conn, $trinhDo);
    // $arrTrinhDo = array();
    // while ($rowTrinhDo = mysqli_fetch_array($resultTrinhDo)) 
    // {
    //     $arrTrinhDo[] = $rowTrinhDo;
    // }
  // thang tinh luong
  $thang = date_create(date("Y-m-d"));
  $thangFormat = date_format($thang, "m/Y");
 // tinh luong nhan vien
 if(isset($_POST['tinhLuong']))
 {
   // tao cac gia tri mac dinh
   $showMess = false;
   $error = array();
   $success = array();

   // lay gia tri tren form
    $maSinhVien = $_POST['maSinhVien'];
    $kyHoc = $_POST['kyHoc'];
    $namSinhVien = $_POST['namSinhVien'];
    $tieuChi1 = $_POST['tieuChi1'];
    $tieuChi2 = $_POST['tieuChi2'];
    $tieuChi3 = $_POST['tieuChi3'];
    $tieuChi4 = $_POST['tieuChi4'];
    $tieuChi5 = $_POST['tieuChi5'];
    $moTa = $_POST['moTa'];
    $ngayXet = $_POST['ngayXet'];
    $user_id = $row_acc['id'];
    $ngayTao = date("Y-m-d H:i:s");

    // validate
   
    // if(empty($tieuChi1))
    //   $error['tieuChi1'] = 'error';
    // if(empty($tieuChi2))
    //   $error['tieuChi2'] = 'error';
    // if(empty($tieuChi3))
    //   $error['tieuChi3'] = 'error';
    // if(empty($tieuChi4))
    //   $error['tieuChi4'] = 'error';
    // if(empty($tieuChi5))
    //   $error['tieuChi5'] = 'error';
    if(empty($namSinhVien))
      $error['namSinhVien'] = 'error';
    if(empty($kyHoc))
    $error['kyHoc'] = 'error';
  //   if(empty($tieuChi1) && !is_numeric($tieuChi1) )
  //   $error['kiemTraKieuSo'] = 'error';
  // if(empty($tieuChi2) && !is_numeric($tieuChi2) )
  //   $error['kiemTraKieuSo'] = 'error';
  // if(empty($tieuChi3) && !is_numeric($tieuChi3) )
  //   $error['kiemTraKieuSo'] = 'error';
  // if(empty($tieuChi4) && !is_numeric($tieuChi4)  )
  //   $error['kiemTraKieuSo'] = 'error';
  // if(empty($tieuChi5) && !is_numeric($tieuChi5)  )
  //   $error['kiemTraKieuSo'] = 'error';
  if(empty($kyHoc) && !is_numeric($kyHoc) )
    $error['kiemTraKieuSo'] = 'error';
  if(empty($namSinhVien) && !is_numeric($namSinhVien)  )
    $error['kiemTraKieuSo'] = 'error';
    if($maSinhVien == 'chon')
      $error['maSinhVien'] = 'error';
   
// tao bien thuc lanh
$tongDiem = $tieuChi1 + $tieuChi2 + $tieuChi3 + $tieuChi4 + $tieuChi5 ;

// tinh luong co ban
// if($tieuChi1 < 20)
// {
//   $tongDiem = $tongDiem + $getLuongNgay;
// }
// else
// {
//   // neu lon hon 25 thi cac ngay con lai x2
//   $luongThang = (25 + ($soNgayCong - 25)*2) * $getLuongNgay;
// }

// // tinh cac khoan phai nop lai
// // bao hiem xa hoi: 8%
// $baoHiemXaHoi = $luongThang * 0;
// // (8/100)
// // bao hiem y te : 1,5%
// $baoHiemYTe = $luongThang * 0 ;
// // (1.5/100)
// // bao hiem that nghiep
// $baoHiemThatNghiep = $luongThang * 0;
// // (1/100)
// // tinh tong cac khoan tru
// $tongKhoanTru = $baoHiemXaHoi + $baoHiemYTe + $baoHiemThatNghiep;
$diemToiDa=100;
// tam ung
if(100<($tongDiem))
{
  $error['diemQuaLon'] = 'error';
  $diemChoPhep <= $diemToiDa;
}

// tinh thuc lanh
// $thucLanh = $luongThang + $phuCap - $tongKhoanTru - $tamUng;


if(!$error)
{
  // them vao db
  $insert = "INSERT INTO bang_diem(ma_diem, sinhvien_id, ky_hoc, nam_hoc_sinh_vien, tieu_chi1, tieu_chi2, tieu_chi3, tieu_chi4, tieu_chi5, tong_diem, ngay_xet, ghi_chu, nguoi_tao_id, ngay_tao, nguoi_sua_id, ngay_sua) VALUES('$salaryCode', $maSinhVien, $kyHoc, $namSinhVien, $tieuChi1 , $tieuChi2, $tieuChi3, $tieuChi4, $tieuChi5, $tongDiem, '$ngayXet', '$moTa', $user_id, '$ngayTao', $user_id, '$ngayTao')";
  $result = mysqli_query($conn, $insert);
  if($result)
  {
    $showMess = true;
    $success['success'] = 'Tính điểm thành công';
    echo '<script>setTimeout("window.location=\'bang-diem-ren-luyen.php?p=salary&a=salary\'",1000);</script>';
  }
  else
  {
   
   
    echo "<script>alert('Lỗi');</script>";
  }
}

}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tính điểm rèn luyện
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
        <li><a href="tinh-hoc-phi.php?p=salary&a=salary">Tính điểm rèn luyện</a></li>
        <li class="active">Tính điểm rèn luyện sinh viên</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tính điểm sinh viên</h3>
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
                // show error
                if(isset($error2)) 
                {
                  if($showMess == false)
                  {
                    echo "<div class='alert alert-danger alert-dismissible'>";
                    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
                    echo "<h4><i class='icon fa fa-ban'></i> Lỗi!</h4>";
                    foreach ($error2 as $err2) 
                    {
                      echo $err2 . "<br/>";
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
              <form action="" method="POST">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Mã điểm rèn luyện: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="maDiem" value="<?php echo $salaryCode; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Sinh viên: </label>
                      <select class="form-control" name="maSinhVien" id="idSinhVien">
                        <option value="chon">--- Chọn sinh viên ---</option>
                        <?php 
                          foreach ($arrNV as $nv)
                          {
                            echo "<option value='".$nv['id']."'>" .$nv['ma_sinhvien']." - ".$nv['ho_sv']." ".$nv['ten_sv']."</option>";
                          } 
                        ?>
                      </select>
                      <small style="color: red;"><?php if(isset($error['maSinhVien'])){ echo 'Vui lòng chọn sinh viên'; } ?></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Kỳ học<span style="color: red;">*</span> : </label>
                      <input type="text" class="form-control" placeholder="Nhập kỳ học" name="kyHoc" value="<?php echo isset($_POST['kyHoc']) ? $_POST['kyHoc'] : ''; ?>" id="kyHoc">
                      <small style="color: red;"><?php if(isset($error['kyHoc'])){ echo 'Kỳ học không được để trống'; } ?></small>
                      <small style="color: red;"><?php if(isset($error['kiemTraKieuSo'])){ echo 'Vui lòng nhập số'; } ?></small>
                      <small style="color: red;"><?php if($kyHoc > 2){ echo 'Vui lòng nhập tối đa 2'; } ?></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Năm học<span style="color: red;">*</span> : </label>
                      <input type="text" class="form-control" placeholder="Nhập năm học" name="namSinhVien" value="<?php echo isset($_POST['namSinhVien']) ? $_POST['namSinhVien'] : ''; ?>" id="namSinhVien">
                      <small style="color: red;"><?php if(isset($error['namSinhVien'])){ echo 'Năm học không được để trống'; } ?></small>
                      <small style="color: red;"><?php if(isset($error['kiemTraKieuSo'])){ echo 'Vui lòng nhập số'; } ?></small>
                      <small style="color: red;"><?php if($namSinhVien > 6){ echo 'Vui lòng nhập tối đa 6'; } ?></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Điểm tiêu chí 1<span style="color: red;">*</span> : </label>
                      <input type="text" class="form-control" placeholder="Nhập số điểm tiều chí 1" name="tieuChi1" value="<?php echo isset($_POST['tieuChi1']) ? $_POST['tieuChi1'] : ''; ?>" id="tieuChi1">
                      <small style="color: red;"><?php if(isset($error['tieuChi1'])){ echo 'Số điểm tiều chí 1 không được để trống'; } ?></small>
                      <small style="color: red;"><?php if(isset($error['kiemTraKieuSo'])){ echo 'Vui lòng nhập số'; } ?></small>
                      <small style="color: red;"><?php if($tieuChi1 > 20){ echo 'Vui lòng nhập tối đa 20'; } ?></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Điểm tiêu chí 2<span style="color: red;">*</span> : </label>
                      <input type="text" class="form-control" placeholder="Nhập số điểm tiều chí 2" name="tieuChi2" value="<?php echo isset($_POST['tieuChi2']) ? $_POST['tieuChi2'] : ''; ?>" id="tieuChi2">
                      <small style="color: red;"><?php if(isset($error['tieuChi2'])){ echo 'Số điểm tiều chí 2 không được để trống'; } ?></small>
                      <small style="color: red;"><?php if(isset($error['kiemTraKieuSo'])){ echo 'Vui lòng nhập số'; } ?></small>
                      <small style="color: red;"><?php if($tieuChi2 > 25){ echo 'Vui lòng nhập tối đa 25'; } ?></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Điểm tiêu chí 3<span style="color: red;">*</span> : </label>
                      <input type="text" class="form-control" placeholder="Nhập số điểm tiều chí 3" name="tieuChi3" value="<?php echo isset($_POST['tieuChi3']) ? $_POST['tieuChi3'] : ''; ?>" id="tieuChi3">
                      <small style="color: red;"><?php if(isset($error['tieuChi3'])){ echo 'Số điểm tiều chí 3 không được để trống'; } ?></small>
                      <small style="color: red;"><?php if(isset($error['kiemTraKieuSo'])){ echo 'Vui lòng nhập số'; } ?></small>
                      <small style="color: red;"><?php  if($tieuChi3 > 20){ echo 'Vui lòng nhập tối đa 20'; } ?></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Điểm tiêu chí 4<span style="color: red;">*</span> : </label>
                      <input type="text" class="form-control" placeholder="Nhập số điểm tiều chí 4" name="tieuChi4" value="<?php echo isset($_POST['tieuChi4']) ? $_POST['tieuChi4'] : ''; ?>" id="tieuChi4">
                      <small style="color: red;"><?php if(isset($error['tieuChi4'])){ echo 'Số điểm tiều chí 4 không được để trống'; } ?></small>
                      <small style="color: red;"><?php if(isset($error['kiemTraKieuSo'])){ echo 'Vui lòng nhập số'; } ?></small>
                      <small style="color: red;"><?php  if($tieuChi4 > 25){ echo 'Vui lòng nhập tối đa 25'; } ?></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Điểm tiêu chí 5<span style="color: red;">*</span> : </label>
                      <input type="text" class="form-control" placeholder="Nhập số điểm tiều chí 5" name="tieuChi5" value="<?php echo isset($_POST['tieuChi5']) ? $_POST['tieuChi5'] : ''; ?>" id="tieuChi5">
                      <small style="color: red;"><?php if(isset($error['tieuChi5'])){ echo 'Số điểm tiều chí 5 không được để trống'; } ?></small>
                      <small style="color: red;"><?php if(isset($error['kiemTraKieuSo'])){ echo 'Vui lòng nhập số'; } ?></small>
                      <small style="color: red;"><?php  if($tieuChi5 > 10){ echo 'Vui lòng nhập tối đa 10'; } ?></small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ngày xét điểm </label>
                      <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Ngày xét điểm" name="ngayXet" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ghi chú: </label>
                      <textarea id="editor1" rows="10" cols="80" name="moTa" class="ckeditor">
                      </textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Người tạo: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $row_acc['ho']; ?> <?php echo $row_acc['ten']; ?>" name="nguoiTao" readonly>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ngày tạo: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo date('d-m-Y H:i:s'); ?>" name="ngayTao" readonly>
                    </div>
                    <!-- /.form-group -->
                    <?php 
                      if($_SESSION['level'] == 1)
                        echo "<button type='submit' class='btn btn-primary' name='tinhLuong'><i class='fa fa-money'></i> Tính điểm rèn luyện</button>";
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