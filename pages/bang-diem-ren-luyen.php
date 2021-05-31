<?php 

// create session
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['level']))
{
  // include file
  include('../layouts/header.php');
  include('../layouts/topbar.php');
  include('../layouts/sidebar.php');
    // tinh thang tinh Diem
    $thangTinhDiem = date_create(date("Y-m-d"));
    $thangTLFormat = date_format($thangTinhDiem, 'm/Y');
  
  
    if(isset($_POST['chiTietDiem']))
    {
      $maSinhVien = $_POST['maSinhVien'];
      echo "<script>location.href='chi-tiet-bang-diem.php?p=salary&a=salary&id=".$maSinhVien."'</script>";
    }
  
    if(isset($_POST['tinhDiem']))
    {
      $id = $_POST['idSinhVien'];
      echo "<script>location.href='tinhdiem.php?p=salary&a=salary&id=".$id."'</script>";
    }
      // show data
  $showData = "SELECT ma_diem, hinh_anh, nv.id as idSinhVien, ho_sv, ten_sv, tieu_chi1,  tieu_chi2,  tieu_chi3,  tieu_chi4,  tieu_chi5, tong_diem, ngay_xet FROM bang_diem bd, sinhvien nv WHERE nv.id = bd.sinhvien_id ORDER BY bd.id DESC";
  $result = mysqli_query($conn, $showData);
  $arrShow = array();
  while ($row = mysqli_fetch_array($result)) {
    $arrShow[] = $row;
  }
  // xoa record Diem
  if(isset($_POST['delete']))
  {
    $maDiem = $_POST['maDiem'];
    $xoaDiem = "DELETE FROM hoc_phi WHERE ma_hoc_phi = '$maDiem'";
    $resultXoaDiem = mysqli_query($conn, $xoaDiem);
    if($resultXoaDiem)
    {
      $showMess = true;
      $success['success'] = 'Xóa record bảng điểm thành công.';
      echo '<script>setTimeout("window.location=\'bang-diem-ren-luyen.php?p=salary&a=salary\'",1000);</script>';
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
            Bạn có thực sự muốn xóa record bảng điểm này?
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
       Tính điểm rèn luyện sinh viên
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
        <li><a href="bang-diem-ren-luyen.php?p=salary&a=salary">Bảng điểm rèn luyện</a></li>
        <li class="active">Tính điểm rèn luyện sinh viên</li>
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
              <p>Tính điểm</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="tinhdiem.php?p=salary&a=salary" class="small-box-footer">
              Nhấn vào để tính điểm <i class="fa fa-arrow-circle-right"></i>
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
            <a href="export-bang-ren-luyen.php" class="small-box-footer">
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
              <h3 class="box-title">Bảng điểm</h3>
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
                    <th>Mã Điểm</th>
                    <th>Tên sinh viên</th>
                    <th>Tiêu Chí 1</th>
                    <th>Tiêu Chí 2</th>
                    <th>Tiêu Chí 3</th>
                    <th>Tiêu Chí 4</th>
                    <th>Tiêu Chí 5</th>
                    <th>Tổng điểm</th>
                    <th>Xếp loại</th>
                    <th>Ngày xét</th>
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
                        <td><?php echo $arrS['ma_diem']; ?></td>
                        <td><?php echo $arrS['ho_sv']." ".$arrS['ten_sv']; ?></td>
                        <td><?php echo number_format($arrS['tieu_chi1']); ?></td>
                        <td><?php echo number_format($arrS['tieu_chi2']); ?></td>
                        <td><?php echo number_format($arrS['tieu_chi3']); ?></td>
                        <td><?php echo number_format($arrS['tieu_chi4']); ?></td>
                        <td><?php echo number_format($arrS['tieu_chi5']); ?></td>
                        <td><?php echo number_format($arrS['tong_diem']); ?></td>
                        <?php 
                          $phanLoai = $arrS['tong_diem'];
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
                        <td class="text-center">
                        <?php echo date_format(date_create($arrS['ngay_xet']), "d-m-Y"); ?>
                        </td>
                        <td>
                          <?php 
                            if($row_acc['quyen'] == 1)
                            {
                              echo "<form method='POST'>";
                              echo "<input type='hidden' value='".$arrS['idSinhVien']."' name='maSinhVien'/>";
                              echo "<button type='submit' class='btn btn-primary btn-flat'  name='chiTietDiem'><i class='fa fa-eye'></i></button>";
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
                              echo "<button type='button' class='btn bg-maroon btn-flat' data-toggle='modal' data-target='#exampleModal' data-whatever='".$arrS['ma_diem']."'><i class='fa fa-trash'></i></button>";
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