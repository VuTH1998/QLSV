<?php 

// create session
session_start();

if(isset($_SESSION['username']) && isset($_SESSION['level']))
{
  // include file
  include('../layouts/header.php');
  include('../layouts/topbar.php');
  include('../layouts/sidebar.php');
  if(isset($_POST['edit']))
  {
    $id = $_POST['idStaff'];
    echo "<script>location.href='sua-sinh-vien.php?p=staff&a=list-staff&id=".$id."'</script>";
  }

  if(isset($_POST['view']))
  {
    $id = $_POST['idStaff'];
    echo "<script>location.href='thong-tin-sinh-vien.php?p=staff&a=list-staff&id=".$id."'</script>";
  }

  // show data
  $showData = "SELECT id, ma_sv, ma_sinhvien, hinh_anh, ten_sv, gioi_tinh, ngay_tao, ngay_sinh, noi_sinh, so_cmnd, trang_thai FROM sinhvien  ORDER BY id DESC";
  $result = mysqli_query($conn, $showData);
  $arrShow = array();
  while ($row = mysqli_fetch_array($result)) {
    $arrShow[] = $row;
  }
   // delete record
   if(isset($_POST['delete']))
   {
     $id = $_POST['idStaff'];
     $target_dir = "../uploads/staffs/";
 
     // get image
     $image = "SELECT hinh_anh FROM sinhvien WHERE id = $id";
     $resultImage = mysqli_query($conn, $image);
     $rowImage = mysqli_fetch_array($resultImage);
     $removeImage = $target_dir . $rowImage['hinh_anh'];
 
     $delete = "DELETE FROM sinhvien WHERE id = $id";
     $resultDel = mysqli_query($conn, $delete);
     if($resultDel)
     {
       $showMess = true;
       if($rowImage['hinh_anh'] != "demo-3x4.jpg")
       {
         unlink($removeImage);
       }
 
       $success['success'] = 'Xóa sinh viên thành công.';
       echo '<script>setTimeout("window.location=\'danh-sach-sinh-vien.php?p=staff&a=list-staff\'",1000);</script>';  
     }
   }
?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                    <input type="hidden" name="idStaff">
                    Bạn có thực sự muốn xóa sinh viên này?
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
            Sinh viên
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
            <li><a href="danh-sach-nhan-vien.php?p=staff&a=list-staff">Sinh viên</a></li>
            <li class="active">Danh sách sinh viên</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách sinh viên</h3>
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
                        <div class="col-sm-12">
                            <form class="form-horizontal" role="form" name="form" method="post" action="">
                                <div class="row">
                                    <div class="form-group">
                                    <label class="col-sm-1 control-label no-padding-right"> Mã Sinh Viên </label>
                                        <div class="col-sm-3">
                                          <input type="text" class="form-control" id="ma_sinhvien" name="ma_sinhvien" />
                                        </div>
                                    <label class="col-sm-1 control-label no-padding-right"> Họ </label>
                                        <div class="col-sm-3">
                                          <input type="text" class="form-control" id="ho_sv" name="ho_sv"/>
                                        </div>
                                    <label class="col-sm-1 control-label no-padding-right"> Tên </label>
                                        <div class="col-sm-3">
                                          <input type="text" class="form-control" id="ten_sv" name="ten_sv"/>
                                        </div>				
                                    </div>
                                    <div class="form-group">
                                      <label class="col-sm-1 control-label no-padding-right"> Khoá </label>
                                          <div class="col-sm-3">
                                              <select class="form-control" id="khoa" name="khoa">
                                                  <option value="all">Tất Cả</option>
                                               
                                                  <?php
                                                 $khoaHoc = "SELECT id, ten_khoahoc FROM khoa_hoc";
                                                 $resultkhoaHoc = mysqli_query($conn, $khoaHoc);
                                                 $arrkhoaHoc = array();                                        
                                                 while ($rowkhoaHoc = mysqli_fetch_array($resultkhoaHoc)) 
                                                 {
                                                   $getTenKhoa= $rowkhoaHoc['ten_khoahoc'];
                                                  
                                                   
                                                  $arrkhoaHoc[] = $rowkhoaHoc;
                                                 }

                                                ?>
                                                           <?php foreach ($arrkhoaHoc as $arrS) { ?>
                                                <option value='<?php echo $arrS['id'];?>'>
                                                    <?php echo $arrS['ten_khoahoc']; }?></option>

                                               
                                                     

                                                  
                                              </select>
                                          </div>
                                  
                                        <label class="col-sm-1 control-label no-padding-right"> Lớp </label>
                                        <div class="col-sm-3">
                                            <select class="form-control" id="lop" name="lop">
                                                <option value="all">Tất Cả</option>
                                                <?php
                                                $lop = "SELECT id, ma_lop, ten_lop FROM lop";
                                                $resultLop = mysqli_query($conn, $lop);
                                                $arrLop = array();

                                                while($rowLop = mysqli_fetch_array($resultLop)){
                                                    $ten= $arrLop['ten_lop'];
                                                    $ma= $arrLop['ma_lop'];
                                                  $arrLop[] = $rowLop;

                                                }?>
                                                            <?php foreach ($arrLop as $arrS) { ?>
                                                <option value='<?php echo $arrS['id'];?>'>
                                                    <?php echo $arrS['ten_lop']; }?></option>

                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <button name="timkiem" id="timkiem" class="btn btn-info">
                                        <i class="ace-icon fa fa-search bigger-110"></i>
                                        Tìm Kiếm
                                    </button>
                                </div>

                        </div>
                        </form>
                    </div>
                    <?php
                if(isset($_POST['timkiem']))
                {
                ?>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã sinh viên</th>
                                    <th>Ảnh</th>
                                    <th>Họ và tên đệm sinh viên</th>
                                    <th>Tên sinh viên</th>
                                    <th>Giới tính</th>
                                    <th>Ngày sinh</th>
                                    <th>Nơi sinh</th>
                                    <th>Số CMND</th>
                                    <th>Tình trạng</th>
                                    <th>Xem</th> 
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(empty($_POST['ma_sinhvien'])) 
                                $manv=' '; 

                              else 
                                $manv='AND sinhvien.ma_sinhvien LIKE "%'.$_POST['ma_sinhvien'].'%"';
                                
                              if(empty($_POST['ho_sv'])) 
                                $_sv=''; 
                              else 
                                $ho=' AND sinhvien.ho_sv LIKE "%'.$_POST['ho_sv'].'%"';
                              if(empty($_POST['ten_sv'])) 
                                $ten=''; 
                              else 
                                $ten=' AND sinhvien.ten_sv LIKE "%'.$_POST['ten_sv'].'%"';
                              if($_POST['khoa']=='all') 
                                $khoahoc=''; 
                              else 
                                        $khoahoc='AND sinhvien.khoahoc_id  = "'.$_POST['khoa'].'"';
                              if($_POST['lop']=='all') 
                                $lop=''; 
                              else 
                                        $lop='AND sinhvien.lop_id  = "'.$_POST['lop'].'"';
										// $lop=''.$_POST['lop'].'';
                                        // echo $lop;  
                                       echo $khoahoc;
                                        $showData = "SELECT * FROM sinhvien WHERE sinhvien.lop_id $manv $ho $ten $khoahoc $lop ";
                                        $result = mysqli_query($conn, $showData);
                                        $arrShow = array();
                                        while ($row = mysqli_fetch_array($result)) {
                                          $arrShow[] = $row;
                                        }
                    ?>
                                <?php 
                                
                    $count = 1;
                    foreach ($arrShow as $arrS) 
                    {
                  ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $arrS['ma_sinhvien']; ?></td>
                                    <td><img src="../uploads/staffs/<?php echo $arrS['hinh_anh']; ?>" width="80"></td>
                                    <td><?php echo $arrS['ho_sv']; ?></td>
                                    <td><?php echo $arrS['ten_sv']; ?></td>
                                    <td>
                                        <?php
                          if($arrS['gioi_tinh'] == 1)
                          {
                            echo "Nam";
                          } 
                          else
                          {
                            echo "Nữ";
                          }
                        ?>
                                    </td>
                                    <td>
                                        <?php 
                          $date = date_create($arrS['ngay_sinh']);
                          echo date_format($date, 'd-m-Y');
                        ?>
                                    </td>
                                    <td><?php echo $arrS['noi_sinh']; ?></td>
                                    <td><?php echo $arrS['so_cmnd']; ?></td>
                                    <td>
                                        <?php 
                          if($arrS['trang_thai'] == 1)
                          {
                            echo '<span class="badge bg-blue"> Đang học </span>';
                          }
                          else
                          {
                            echo '<span class="badge bg-red"> Đã nghỉ học </span>';
                          }
                        ?>
                                    </td>
                                    <td>
                          <?php 
                            if($row_acc['quyen'] == 1)
                            {
                              echo "<form method='POST'>";
                              echo "<input type='hidden' value='".$arrS['id']."' name='idStaff'/>";
                              echo "<button type='submit' class='btn btn-primary btn-flat'  name='view'><i class='fa fa-eye'></i></button>";
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
                              echo "<form method='POST'>";
                              echo "<input type='hidden' value='".$arrS['id']."' name='idStaff'/>";
                              echo "<button type='submit' class='btn bg-orange btn-flat'  name='edit'><i class='fa fa-edit'></i></button>";
                              echo "</form>";
                            }
                            else
                            {
                              echo "<button type='button' class='btn bg-orange btn-flat' disabled><i class='fa fa-edit'></i></button>";
                            }
                          ?>
                          
                        </td>
                        <td>
                          <?php 
                            if($row_acc['quyen'] == 1)
                            {
                              echo "<button type='button' class='btn bg-maroon btn-flat' data-toggle='modal' data-target='#exampleModal' data-whatever='".$arrS['id']."'><i class='fa fa-trash'></i></button>";
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