<?php 

// create session
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['level']))
{
  // include file
  include('../layouts/header.php');
  include('../layouts/topbar.php');
  include('../layouts/sidebar.php');

  // show data
  if(isset($_GET['id']))
  {
    $id = $_GET['id'];

    $showData = "SELECT nv.id as id, ma_sv, hinh_anh, ten_sv, biet_danh, gioi_tinh, nv.ngay_tao as ngay_tao, ngay_sinh, noi_sinh, so_cmnd, ten_tinh_trang, ngay_cap_cmnd, noi_cap_cmnd, nguyen_quan, ten_quoc_tich, ten_dan_toc, ten_ton_giao, ho_khau, tam_tru, ten_chinh_sach, ten_nam_sinh_vien, ten_lop, ten_noi_tot_nghiep, ten_khoa, ten_chuc_vu, trang_thai FROM sinhvien nv, quoc_tich qt, dan_toc dt, ton_giao tg, chinh_sach lnv, nam_sinh_vien td, lop cm, noi_tot_nghiep bc, khoa pb, chuc_vu cv, tinh_trang_hon_nhan hn WHERE nv.quoc_tich_id = qt.id AND nv.dan_toc_id = dt.id AND nv.ton_giao_id = tg.id AND nv.chinh_sach_id = lnv.id AND nv.nam_sinh_vien_id = td.id AND nv.lop_id = cm.id AND nv.noi_tot_nghiep_id = bc.id AND nv.khoa_id = pb.id AND nv.chuc_vu_id = cv.id AND nv.hon_nhan_id = hn.id AND nv.id = $id";
    $result = mysqli_query($conn, $showData);
    $row = mysqli_fetch_array($result);

    $luong = "SELECT nv.id as idNhanVien, ma_hoc_phi, ma_sv, ten_sv, ten_chuc_vu, luong_ngay, hoc_phi_ky, so_tin_chi, phu_cap, con_no, khoan_nop, da_nop, ngay_dong FROM hoc_phi l, sinhvien nv, chuc_vu cv WHERE l.sinhvien_id = nv.id AND nv.chuc_vu_id = cv.id AND nv.id = $id";
    $resultLuong = mysqli_query($conn, $luong);
    $arrLuong = array();
    while ($rowLuong = mysqli_fetch_array($resultLuong)) 
    {
      $arrLuong[] = $rowLuong;
    }

  }

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Thông tin sinh viên
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
        <li><a href="danh-sach-nhan-vien.php?p=staff&a=list-staff">Danh sách sinh viên</a></li>
        <li class="active">Thông tin sinh viên</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Mã sinh viên: <?php echo $row['ma_sv']; ?></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-lg-2">
                  <img src="../uploads/staffs/<?php echo $row['hinh_anh']; ?>" width="100%">
                </div>
                <div class="col-lg-5 col-sm-5 col-md-6 col-xs-12">
                  <p class="box-title">Tên sinh viên: <b><?php echo $row['ten_sv']; ?></b></p>
                  <p class="box-title">Biệt danh: 
                    <?php if($row['biet_danh'] == ""){ echo "Không có"; } else { echo $row['biet_danh']; } ?>
                  </p>
                  <p class="box-title">Giới tính: 
                    <?php if($row['gioi_tinh'] == 1){ echo "Nam"; } else { echo "Nữ"; } ?>
                  </p>
                  <p class="box-title">Ngày sinh: 
                    <b><?php $date = date_create($row['ngay_sinh']); echo date_format($date, 'd-m-Y'); ?></b>
                  </p>
                  <p class="box-title">Nơi sinh: 
                    <?php echo $row['noi_sinh']; ?>
                  </p>
                  <p class="box-title">Tình trạng hôn sinh: 
                    <?php echo $row['ten_tinh_trang']; ?>
                  </p>
                  <p class="box-title">Số CMND: 
                    <b> <?php echo $row['so_cmnd']; ?> </b>
                  </p>
                  <p class="box-title">Ngày cấp: 
                    <?php $ngayCap = date_create($row['ngay_cap_cmnd']); echo date_format($ngayCap, 'd-m-Y'); ?>
                  </p>
                  <p class="box-title">Nơi cấp: 
                    <?php echo $row['noi_cap_cmnd']; ?>
                  </p>
                  <p class="box-title">Nguyên quán: 
                    <?php echo $row['noi_cap_cmnd']; ?>
                  </p>
                  <p class="box-title">Quốc tịch: 
                    <?php echo $row['ten_quoc_tich']; ?>
                  </p>
                  <p class="box-title">Dân tộc: 
                    <?php echo $row['ten_dan_toc']; ?>
                  </p>
                  <p class="box-title">Tôn giáo: 
                    <?php echo $row['ten_ton_giao']; ?>
                  </p>
                </div>
                <!-- col-5 -->
                <div class="col-lg-5 col-sm-5 col-md-6 col-xs-12">
                  <p class="box-title">Hộ khẩu: 
                    <b> <?php echo $row['ho_khau']; ?> </b>
                  </p>
                  <p class="box-title">Tạm trú: 
                    <?php echo $row['tam_tru']; ?>
                  </p>
                  <p class="box-title">Chính sách sinh viên: 
                    <b><?php echo $row['ten_chinh_sach']; ?></b>
                  </p>
                  <p class="box-title">Năm sinh viên: 
                    <b><?php echo $row['nam_sinh_vien']; ?></b>
                  </p>
                  <p class="box-title">Lớp: 
                    <b><?php echo $row['ten_lop']; ?></b>
                  </p>
                  <p class="box-title">Tốt nghiệp THPT: 
                    <b><?php echo $row['ten_noi_tot_nghiep']; ?></b>
                  </p>
                  <p class="box-title">Khoa: 
                    <b><?php echo $row['ten_khoa']; ?></b>
                  </p>
                  <p class="box-title">Chức vụ: 
                    <b><?php echo $row['ten_chuc_vu']; ?></b>
                  </p>
                  <p class="box-title">Trạng thái: 
                    
                      <?php 
                        if($row['trang_thai'] == 1)
                        {
                          echo '<span class="badge bg-blue"> Đang học </span>';
                        } 
                        else if($row['trang_thai'] == 2)
                        {
                          echo '<span class="badge bg-blue"> Đâ tốt nghiệp </span>';
                        }
                        else
                        {
                          echo '<span class="badge bg-red"> Đã nghỉ học </span>';
                        }
                      ?>
                    </span>
                  </p>
                </div>
                <!-- col-5 -->
              </div>
              <!-- row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Bảng học phí sinh viên</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã học phí</th>
                    <th>Phí tín chỉ</th>
                    <th>Số tín chỉ</th>
                    <th>Học phí</th>
                    <th>Phụ cấp</th>
                    <th>Khoản nộp</th>
                    <th>Đã nộp</th>
                    <th>Còn nợ</th>
                    <th>Ngày nộp</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $count = 1;
                    foreach ($arrLuong as $luong) 
                    {
                  ?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $luong['ma_hoc_phi']; ?></td>
                        <td><?php echo number_format($luong['luong_ngay'])."vnđ"; ?></td>
                        <td><?php echo $luong['so_tin_chi']; ?></td>
                        <td><?php echo number_format($luong['hoc_phi_ky'])."vnđ"; ?></td>
                        <td><?php echo number_format($luong['phu_cap'])."vnđ"; ?></td>
                        <td style="color: red; font-weight: bold;"><?php echo number_format($luong['khoan_nop'])."vnđ"; ?></td>
                        <td><?php echo number_format($luong['da_nop'])."vnđ"; ?></td>
                        <td style="color: blue; font-weight: bold;"><?php echo number_format($luong['con_no'])."vnđ"; ?></td>
                        <td class="text-center">
                        <?php echo date_format(date_create($luong['ngay_dong']), "d-m-Y"); ?>
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