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

    $diem = "SELECT nv.id as idSinhVien, ma_diem, ten_sv, tieu_chi1,  tieu_chi2,  tieu_chi3,  tieu_chi4,  tieu_chi5, tong_diem, ky_hoc, nam_hoc_sinh_vien, ngay_xet FROM bang_diem bd, sinhvien nv WHERE nv.id = bd.sinhvien_id AND nv.id = $id";
  $resultDiem = mysqli_query($conn, $diem);
  $arrDiem = array();
  while ($rowDiem = mysqli_fetch_array($resultDiem))
   {
    $arrDiem[] = $rowDiem;
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
              <h3 class="box-title">Bảng điểm rèn luyện sinh viên</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                    <th>Mã điểm</th>
                    <th>Tiêu chi 1</th>
                    <th>Tiêu chi 2</th>
                    <th>Tiêu chi 3</th>
                    <th>Tiêu chi 4</th>
                    <th>Tiêu chi 5</th>
                    <th>Tổng điểm</th>
                    <th>Xếp loại</th>
                    <th>Học Kỳ</th>
                    <th>Năm sinh viên</th>
                    <th>Ngày xét</th>
                    <th>Tên</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $count = 1;
                    foreach ($arrDiem as $diem) 
                    {
                  ?>
                      <tr>
                      <td><?php echo $count; ?></td>
                        <td><?php echo $diem['ma_diem']; ?></td>
                        <td><?php echo number_format($diem['tieu_chi1']); ?></td>
                        <td><?php echo number_format($diem['tieu_chi2']); ?></td>
                        <td><?php echo number_format($diem['tieu_chi3']); ?></td>
                        <td><?php echo number_format($diem['tieu_chi4']); ?></td>
                        <td><?php echo number_format($diem['tieu_chi5']); ?></td>
                        <td><?php echo number_format($diem['tong_diem']); ?></td>
                        <?php 
                          $phanLoai = $diem['tong_diem'];
                          if( 35 > $phanLoai)
                          {
                            echo '<td><span class="badge bg-red"> Kém </span></td>';
                          }
                          elseif (50 > $phanLoai)
                          {
                            echo '<td><span class="badge bg-red"> Yếu </span></td>';
                          }
                          elseif (65 > $phanLoai)
                          {
                            echo '<td><span class="badge bg-blue"> Trung bình </span></td>';
                          }
                          elseif (80 > $phanLoai)
                          {
                            echo '<td><span class="badge bg-blue"> Khá </span></td>';
                          }
                          elseif (90 > $phanLoai)
                          {
                            echo '<td><span class="badge bg-green"> Tốt </span></td>';
                          }
                          else 
                          {
                            echo '<td><span class="badge bg-green"> Xuất sắc </span></td>';
                          }
                        ?>
                        <!--  -->
                        <?php 
                        $kyHoc = $diem['ky_hoc'];
                        if( $kyHoc < 2 )
                        {
                        echo '<td><span> I </span></td>';
                        }
                        else 
                        {
                        echo '<td><span> II </span></td>';
                        }
                        ?>
                        <!--  -->
                         <?php 
                        $namSinhVien = $diem['nam_hoc_sinh_vien'];
                        if( $namSinhVien < 2)
                        {
                        echo '<td><span> Năm Nhất </span></td>';
                        }
                        elseif ($namSinhVien < 3) {
                            echo '<td><span> Năm Hai </span></td>';
                        }
                        elseif ($namSinhVien < 4) {
                            echo '<td><span> Năm Ba </span></td>';
                        }
                        elseif ($namSinhVien < 5) {
                            echo '<td><span> Năm Bốn </span></td>';
                        }
                        elseif ($namSinhVien < 6) {
                            echo '<td><span> Năm Năm </span></td>';
                        }
                        else 
                        {
                        echo '<td><span> Năm Sáu </span></td>';
                        }
                        ?>
                        <td class="text-center">
                        <?php echo date_format(date_create($diem['ngay_xet']), "d-m-Y"); ?>
                        </td>
                        <td><?php echo $diem['ten_sv']; ?></td>
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