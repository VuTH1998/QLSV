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
    $showData = "SELECT nv.id as id,quoc_tich_id, ton_giao_id, dan_toc_id, chinh_sach_id, noi_tot_nghiep_id, chuc_vu_id, nam_sinh_vien_id, lop_id, khoa_id, hon_nhan_id, xuat_than_id, phuong_thuc_id, ma_sv, hinh_anh, ma_sinhvien,ho_sv, ten_sv, biet_danh, gioi_tinh, nv.ngay_tao as ngay_tao, ngay_sinh, noi_sinh, so_cmnd, ten_tinh_trang, ngay_cap_cmnd, noi_cap_cmnd, ten_phuongthuc, diem_xettuyen, so_dienthoai, email, so_truong, nguyen_quan, ten_quoc_tich, ten_dan_toc, xuat_than, ten_ton_giao, ho_khau, tam_tru, ten_chinh_sach, ten_nam_sinh_vien, ten_lop, ten_noi_tot_nghiep,ngay_vao_doan, ten_khoa, ten_chuc_vu, hoten_bo, nghenghiep_bo, ngaysinh_bo, sdt_bo,  hoten_me, nghenghiep_me, ngaysinh_me, sdt_me, trang_thai FROM sinhvien nv, quoc_tich qt, dan_toc dt, ton_giao tg, chinh_sach lnv, xuatthan xt, phuongthuc_xettuyen pt, nam_sinh_vien td, lop cm, noi_tot_nghiep bc, khoa pb, chuc_vu cv, tinh_trang_hon_nhan hn WHERE nv.quoc_tich_id = qt.id AND nv.dan_toc_id = dt.id AND nv.ton_giao_id = tg.id AND nv.phuong_thuc_id = pt.id AND nv.chinh_sach_id = lnv.id AND nv.xuat_than_id = xt.id AND nv.nam_sinh_vien_id = td.id AND nv.lop_id = cm.id AND nv.noi_tot_nghiep_id = bc.id AND nv.khoa_id = pb.id AND nv.chuc_vu_id = cv.id AND nv.hon_nhan_id = hn.id AND nv.id = $id;";
    // echo $showData;
    // die;
    $result = mysqli_query($conn, $showData);
    $row = mysqli_fetch_array($result);

    // set option active
    $qt_id = $row['quoc_tich_id'];
    $ten_qt = $row['ten_quoc_tich'];

    $tg_id = $row['ton_giao_id'];
    $ten_tg = $row['ten_ton_giao'];

    $dt_id = $row['dan_toc_id'];
    $ten_dt = $row['ten_dan_toc'];

    $nv_id = $row['chinh_sach_id'];
    $ten_nv = $row['ten_chinh_sach'];

    $bc_id = $row['noi_tot_nghiep_id'];
    $ten_bc = $row['ten_noi_tot_nghiep'];

    $pb_id = $row['khoa_id'];
    $ten_pb = $row['ten_khoa'];

    $cv_id = $row['chuc_vu_id'];
    $ten_cv = $row['ten_chuc_vu'];

    $td_id = $row['nam_sinh_vien_id'];
    $ten_td = $row['ten_nam_sinh_vien'];

    $cm_id = $row['lop_id'];
    $ten_cm = $row['ten_lop'];

    $hn_id = $row['hon_nhan_id'];
    $ten_hn = $row['ten_tinh_trang'];

    $xt_id = $row['xuat_than_id'];
    $ten_xt = $row['xuat_than'];

    $pt_id = $row['phuong_thuc_id'];
    $ten_pt = $row['ten_phuong_thuc'];


    // set value option another
    $qt = "SELECT id, ten_quoc_tich FROM quoc_tich WHERE id <> $qt_id";
    $resultQT = mysqli_query($conn, $qt);
    $arrQT = array();
    while ($rowQT = mysqli_fetch_array($resultQT)) 
    {
      $arrQT[] = $rowQT;
    }

    $tg = "SELECT id, ten_ton_giao FROM ton_giao WHERE id <> $tg_id";
    $resultTG = mysqli_query($conn, $tg);
    $arrTG = array();
    while ($rowTG = mysqli_fetch_array($resultTG)) 
    {
      $arrTG[] = $rowTG;
    }

    $dt = "SELECT id, ten_dan_toc FROM dan_toc WHERE id <> $dt_id";
    $resultDT = mysqli_query($conn, $dt);
    $arrDT = array();
    while ($rowDT = mysqli_fetch_array($resultDT)) 
    {
      $arrDT[] = $rowDT;
    }

    $lnv = "SELECT id, ten_chinh_sach FROM chinh_sach WHERE id <> $nv_id";
    $resultLNV = mysqli_query($conn, $lnv);
    $arrLNV = array();
    while ($rowLNV = mysqli_fetch_array($resultLNV)) 
    {
      $arrLNV[] = $rowLNV;
    }

    $bc = "SELECT id, ten_noi_tot_nghiep FROM noi_tot_nghiep WHERE id <> $bc_id";
    $resultBC = mysqli_query($conn, $bc);
    $arrBC = array();
    while ($rowBC = mysqli_fetch_array($resultBC)) 
    {
      $arrBC[] = $rowBC;
    }

    $pb = "SELECT id, ten_khoa FROM khoa WHERE id <> $pb_id";
    $resultPB = mysqli_query($conn, $pb);
    $arrPB = array();
    while ($rowPB = mysqli_fetch_array($resultPB)) 
    {
      $arrPB[] = $rowPB;
    }

    $cv = "SELECT id, ten_chuc_vu FROM chuc_vu WHERE id <> $cv_id";
    $resultCV = mysqli_query($conn, $cv);
    $arrCV = array();
    while ($rowCV = mysqli_fetch_array($resultCV)) 
    {
      $arrCV[] = $rowCV;
    }

    $td = "SELECT id, ten_nam_sinh_vien FROM nam_sinh_vien WHERE id <> $td_id";
    $resultTD = mysqli_query($conn, $td);
    $arrTD = array();
    while ($rowTD = mysqli_fetch_array($resultTD)) 
    {
      $arrTD[] = $rowTD;
    }

    $cm = "SELECT id, ten_lop FROM lop WHERE id <> $cm_id";
    $resultCM = mysqli_query($conn, $cm);
    $arrCM = array();
    while ($rowCM = mysqli_fetch_array($resultCM)) 
    {
      $arrCM[] = $rowCM;
    }
    $xt = "SELECT id, xuat_than FROM xuatthan WHERE id <> $xt_id";
    $resultXuatThan = mysqli_query($conn, $xt);
    $arrXuatThan = array();
    while ($rowXuatThan = mysqli_fetch_array($resultXuatThan)) 
    {
      $arrXuatThan[] = $rowXuatThan;
    }

    $hn = "SELECT id, ten_tinh_trang FROM tinh_trang_hon_nhan WHERE id <> $hn_id";
    $resultHN = mysqli_query($conn, $hn);
    $arrHN = array();
    while ($rowHN = mysqli_fetch_array($resultHN)) 
    {
      $arrHN[] = $rowHN;
    }
    $pt = "SELECT id, ten_phuongthuc FROM phuongthuc_xettuyen WHERE id <> $pt_id";
    $resultPT = mysqli_query($conn, $pt);
    $arrPT = array();
    while ($rowPT = mysqli_fetch_array($resultPT)) 
    {
      $arrPT[] = $rowPT;
    }

    
  }


  // chuc nang them nhan vien
  if(isset($_POST['save']))
  {
    // tao bien bat loi
    $error = array();
    $success = array();
    $showMess = false;

    // lay du lieu ve
    $maSinhVien = $_POST['maSinhVien'];
    $hoSinhVien = $_POST['hoSinhVien'];
    $tenNhanVien = $_POST['tenNhanVien'];
    $bietDanh = $_POST['bietDanh'];
    $honNhan = $_POST['honNhan'];
    $xuatThan = $_POST['xuatThan'];
    $CMND = $_POST['CMND'];
    $ngayCap = $_POST['ngayCap'];
    $noiCap = $_POST['noiCap'];
    $quocTich = $_POST['quocTich'];
    $tonGiao = $_POST['tonGiao'];
    $danToc = $_POST['danToc'];
    $loaiNhanVien = $_POST['loaiNhanVien'];
    $bangCap = $_POST['bangCap'];
    $trangThai = $_POST['trangThai'];
    $gioiTinh = $_POST['gioiTinh'];
    $ngaySinh = $_POST['ngaySinh'];
    $noiSinh = $_POST['noiSinh'];
    $nguyenQuan = $_POST['nguyenQuan'];
    $hoKhau = $_POST['hoKhau'];
    $tamTru = $_POST['tamTru'];
    $phongBan = $_POST['phongBan'];
    $chucVu = $_POST['chucVu'];
    $trinhDo = $_POST['trinhDo'];
    $ngayVaoDoan=$_POST['ngayVaoDoan'];
    $phuongThuc=$_POST['phuongThuc'];
    $soDienThoai=$_POST['soDienThoai'];
    $Email=$_POST['Email'];
    $soTruong=$_POST['soTruong'];
    $diemXetTuyen=$_POST['diemXetTuyen'];
    $tenBo=$_POST['tenBo'];
    $ngheBo=$_POST['ngheBo'];
    $ngaySinhBo=$_POST['ngaySinhBo'];
    $soBo=$_POST['soBo'];
    $tenMe=$_POST['tenMe'];
    $ngheMe=$_POST['ngheMe'];
    $ngaySinhMe=$_POST['ngaySinhMe'];
    $soMe=$_POST['soMe'];
    $chuyenMon = $_POST['chuyenMon'];
    $id_user = $row_acc['id'];
    $ngaySua = date("Y-m-d H:i:s");

    // cau hinh o chon anh
    $hinhAnh = $_FILES['hinhAnh']['name'];
    $target_dir = "../uploads/staffs/";
    $target_file = $target_dir . basename($hinhAnh);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // validate
    if(empty($maSinhVien))
      $error['maSinhVien'] = 'error';
      if(empty($tenBo))
      $error['$tenBo'] = 'error';
      if(empty($tenMe))
      $error['$tenMe'] = 'error';
      if(empty($soBo))
      $error['$soBo'] = 'error';
      if(empty($soMe))
      $error['$soMe'] = 'error';
      // if(empty($soDienThoai))
      // $error['soDienThoai'] = 'error';
    if(empty($tenNhanVien))
      $error['tenNhanVien'] = 'error';
      if(empty($hoSinhVien))
      $error['hoSinhVien'] = 'error';
    if($honNhan == 'chon')
      $error['honNhan'] = 'error';
      if($xuatThan == 'chon')
      $error['xuatThan'] = 'error';
    if(empty($CMND))
      $error['CMND'] = 'error';
    if(empty($noiCap))
      $error['noiCap'] = 'error';
    if($quocTich == 'chon')
      $error['quocTich'] = 'error';
    if($danToc == 'chon')
      $error['danToc'] = 'error';
    if($loaiNhanVien == 'chon')
      $error['loaiNhanVien'] = 'error';
    if($trangThai == 'chon')
      $error['trangThai'] = 'error';
    if($gioiTinh == 'chon')
      $error['gioiTinh'] = 'error';
    if(empty($hoKhau))
      $error['hoKhau'] = 'error';
    if($phongBan == 'chon')
      $error['phongBan'] = 'error';
    if($chucVu == 'chon')
      $error['chucVu'] = 'error';
    if($trinhDo == 'chon')
      $error['trinhDo'] = 'error';
    if($phuongThuc == 'chon')
    $error['phuongThuc'] = 'error';
    // validate file
    if($hinhAnh)
    {
      if($_FILES['hinhAnh']['size'] > 50000000)
        $error['kichThuocAnh'] = 'error';
      if($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif')
        $error['kieuAnh'] = 'error';
    }

    if(!$error)
    {
      if($hinhAnh)
      {
        $imageName = time() . "." . $imageFileType;
        $moveFile = $target_dir . $imageName;

        // remove old image
        $oldImage = $row['hinh_anh'];

        // insert data
        $update = " UPDATE sinhvien SET 
                    hinh_anh = '$imageName',
                    ho_sv = '$hoSinhVien',
                    ten_sv = '$tenNhanVien',
                    biet_danh = '$bietDanh',
                    gioi_tinh = '$gioiTinh',
                    ngay_sinh = '$ngaySinh',
                    noi_sinh = '$noiSinh',
                    hon_nhan_id = '$honNhan',
                    xuat_than_id = '$xuatThan',
                    so_cmnd = '$CMND',
                    noi_cap_cmnd = '$noiCap',
                    ngay_cap_cmnd = '$ngayCap',
                    nguyen_quan = '$nguyenQuan',
                    quoc_tich_id = '$quocTich',
                    ton_giao_id = '$tonGiao',
                    dan_toc_id = '$danToc',
                    ho_khau = '$hoKhau',
                    tam_tru = '$tamTru',
                    chinh_sach_id = '$loaiNhanVien',
                    nam_sinh_vien_id = '$trinhDo',
                    lop_id = '$chuyenMon',
                    noi_tot_nghiep_id = '$bangCap',
                    ngay_vao_doan = '$ngayVaoDoan',
                    phuong_thuc_id='$phuongThuc',
                    diem_xettuyen ='$diemXetTuyen',
                    so_dienthoai='$soDienThoai',
                    email='$Email',
                    so_truong='$soTruong',
                    khoa_id = '$phongBan',
                    chuc_vu_id = '$chucVu',
                    trang_thai = '$trangThai',
                    nguoi_sua_id = '$id_user',
                    ngay_sua = '$ngaySua',
                    ma_sinhvien = '$maSinhVien'
                    WHERE id = $id";
        $result = mysqli_query($conn, $update);
        // echo $update;
        // die;
        if($result)
        {
          $showMess = true;

          // remove old image
          if($oldImage != "demo-3x4.jpg")
          {
            unlink($target_dir . $oldImage);
          }

          // move image
          move_uploaded_file($_FILES["hinhAnh"]["tmp_name"], $moveFile);

          $success['success'] = 'Lưu thông tin thành công';
          echo '<script>setTimeout("window.location=\'sua-sinh-vien.php?p=staff&a=list-staff&id='.$id.'\'",1000);</script>';
        }
      }
      else
      {
        $showMess = true;
        // update data
        $update = " UPDATE sinhvien SET 
                    ho_sv = '$hoSinhVien',
                    ten_sv = '$tenNhanVien',
                    biet_danh = '$bietDanh',
                    gioi_tinh = '$gioiTinh',
                    ngay_sinh = '$ngaySinh',
                    noi_sinh = '$noiSinh',
                    hon_nhan_id = '$honNhan',
                    xuat_than_id = '$xuatThan',
                    so_cmnd = '$CMND',
                    noi_cap_cmnd = '$noiCap',
                    ngay_cap_cmnd = '$ngayCap',
                    nguyen_quan = '$nguyenQuan',
                    quoc_tich_id = '$quocTich',
                    ton_giao_id = '$tonGiao',
                    dan_toc_id = '$danToc',
                    ho_khau = '$hoKhau',
                    tam_tru = '$tamTru',
                    chinh_sach_id = '$loaiNhanVien',
                    nam_sinh_vien_id = '$trinhDo',
                    lop_id = '$chuyenMon',
                    noi_tot_nghiep_id = '$bangCap',
                    ngay_vao_doan = '$ngayVaoDoan',
                    phuong_thuc_id='$phuongThuc',
                    diem_xettuyen ='$diemXetTuyen',
                    so_dienthoai='$soDienThoai',
                    email='$Email',
                    so_truong='$soTruong',
                    khoa_id = '$phongBan',
                    chuc_vu_id = '$chucVu',
                    trang_thai = '$trangThai',
                    nguoi_sua_id = '$id_user',
                    ngay_sua = '$ngaySua',
                    ma_sinhvien = '$maSinhVien'
                    WHERE id = $id";
        $result = mysqli_query($conn, $update);
        // echo $update;
        // die;
        if($result)
        {
          $success['success'] = 'Lưu thông tin thành công';
          echo '<script>setTimeout("window.location=\'sua-sinh-vien.php?p=staff&a=list-staff&id='.$id.'\'",1000);</script>';

        }
      }
    }
  }

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Chỉnh sửa sinh viên
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
        <li><a href="danh-sach-sinh-vien.php?p=staff&a=list-staff">Sinh viên</a></li>
        <li class="active">Chỉnh sửa thông tin sinh viên</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Chỉnh sửa thông tin sinh viên</h3> &emsp;
              <small>Những ô nhập có dấu <span style="color: red;">*</span> là bắt buộc</small>
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
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Mã số hiệu sinh viên: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" name="maNhanVien" value="<?php echo $row['ma_sv']; ?>" readonly>
                    </div>
                    <div class="form-group">
                      <label>Mã sinh viên <span style="color: red;">*</span>: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập mã sinh viên" name="maSinhVien" value="<?php echo $row['ma_sinhvien']; ?>">
                      <small style="color: red;"><?php if(isset($error['maSinhVien'])){ echo "Mã sinh viên không được để trống"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Họ tên đệm sinh viên <span style="color: red;">*</span>: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên sinh viên" name="hoSinhVien" value="<?php echo $row['ho_sv']; ?>">
                      <small style="color: red;"><?php if(isset($error['hoSinhVien'])){ echo "Tên đệm sinh viên không được để trống"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Tên sinh viên <span style="color: red;">*</span>: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên sinh viên" name="tenNhanVien" value="<?php echo $row['ten_sv']; ?>">
                      <small style="color: red;"><?php if(isset($error['tenNhanVien'])){ echo "Tên sinh viên không được để trống"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Biệt danh: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập biệt danh" name="bietDanh" value="<?php echo $row['biet_danh']; ?>">
                    </div>
                    <div class="form-group">
                      <label>Tình trạng hôn sinh <span style="color: red;">*</span>: </label>
                      <select class="form-control" name="honNhan">
                        <option value="<?php echo $hn_id; ?>"><?php echo $ten_hn; ?></option>
                        <?php 
                          foreach ($arrHN as $hn)
                          {
                            echo "<option value='".$hn['id']."'>".$hn['ten_tinh_trang']."</option>";
                          }
                        ?>
                      </select>
                      <small style="color: red;"><?php if(isset($error['honNhan'])){ echo "Vui lòng chọn tình trạng hôn sinh"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Số CMND <span style="color: red;">*</span>: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập số CMND" name="CMND" value="<?php echo $row['so_cmnd']; ?>">
                      <small style="color: red;"><?php if(isset($error['CMND'])){ echo "Vui lòng nhập số CMND"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Ngày cấp <span style="color: red;">*</span>: </label>
                      <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Nhập nơi cấp" name="ngayCap" value="<?php echo $row['ngay_cap_cmnd']; ?>">
                    </div>
                    <div class="form-group">
                      <label>Nơi cấp <span style="color: red;">*</span>: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập nơi cấp" name="noiCap" value="<?php echo $row['noi_cap_cmnd']; ?>">
                      <small style="color: red;"><?php if(isset($error['noiCap'])){ echo "Vui lòng nhập nơi cấp"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Quốc tịch <span style="color: red;">*</span>: </label>
                      <select class="form-control" name="quocTich">
                      <option value="<?php echo $qt_id; ?>"><?php echo $ten_qt; ?></option>
                      <?php 
                        foreach ($arrQT as $qt)
                        {
                          echo "<option value='".$qt['id']."'>".$qt['ten_quoc_tich']."</option>";
                        }
                      ?>
                      </select>
                      <small style="color: red;"><?php if(isset($error['quocTich'])){ echo "Vui lòng chọn quốc tịch"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Tôn giáo: </label>
                      <select class="form-control" name="tonGiao">
                      <option value="<?php echo $tg_id; ?>"><?php echo $ten_tg; ?></option>
                      <?php 
                      foreach ($arrTG as $tg)
                      {
                        echo "<option value='".$tg['id']."'>".$tg['ten_ton_giao']."</option>";
                      }
                      ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Dân tộc <span style="color: red;">*</span>: </label>
                      <select class="form-control" name="danToc">
                      <option value="<?php echo $dt_id; ?>"><?php echo $ten_dt; ?></option>
                      <?php 
                      foreach ($arrDT as $dt)
                      {
                        echo "<option value='".$dt['id']."'>".$dt['ten_dan_toc']."</option>";
                      }
                      ?>
                      </select>
                      <small style="color: red;"><?php if(isset($error['danToc'])){ echo "Vui lòng chọn dân tộc"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Diện chính sách <span style="color: red;">*</span> : </label>
                      <select class="form-control" name="loaiNhanVien">
                      <option value="<?php echo $nv_id; ?>"><?php echo $ten_nv; ?></option>
                      <?php 
                        foreach ($arrLNV as $lnv)
                        {
                          echo "<option value='".$lnv['id']."'>".$lnv['ten_chinh_sach']."</option>";
                        }
                      ?>
                      </select>
                      <small style="color: red;"><?php if(isset($error['loaiNhanVien'])){ echo "Vui lòng chọn diện chính sách"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Nơi tốt nghiệp: </label>
                      <select class="form-control" name="bangCap">
                      <option value="<?php echo $bc_id; ?>"><?php echo $ten_bc; ?></option>
                      <?php 
                        foreach ($arrBC as $bc)
                        {
                          echo "<option value='".$bc['id']."'>".$bc['ten_noi_tot_nghiep']."</option>";
                        }
                      ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Ngày vào đoàn <span style="color: red;">*</span>: </label>
                      <input type="date" class="form-control" id="exampleInputEmail1" placeholder="Nhập vào đoàn" name="ngayVaoDoan" value="<?php echo $row['ngay_vao_doan']; ?>">
                    </div>
                    <div class="form-group">
                      <label>Phương thức tuyển sinh <span style="color: red;">*</span> : </label>
                      <select class="form-control" name="phuongThuc">
                      <option value="<?php echo $pt_id; ?>"><?php echo $ten_pt; ?></option>
                      <?php 
                        foreach ($arrPT as $pt)
                        {
                          echo "<option value='".$pt['id']."'>".$pt['ten_phuongthuc']."</option>";
                        }
                      ?>
                      </select>
                      <small style="color: red;"><?php if(isset($error['phuongThuc'])){ echo "Vui lòng chọn phương thức tuyển sinh"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Điểm xét tuyển <span style="color: red;">*</span>: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập số điểm" name="diemXetTuyen" value="<?php echo $row['diem_xettuyen']; ?>">
                    </div>
                    <div class="form-group">
                      <label>Khoa <span style="color: red;">*</span>: </label>
                      <select class="form-control" name="phongBan">
                      <option value="<?php echo $pb_id; ?>"><?php echo $ten_pb; ?></option>
                      <?php 
                        foreach ($arrPB as $pb)
                        {
                          echo "<option value='".$pb['id']."'>".$pb['ten_khoa']."</option>";
                        }
                      ?>
                      </select>
                      <small style="color: red;"><?php if(isset($error['phongBan'])){ echo "Vui lòng chọn khoa"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Chức vụ <span style="color: red;">*</span>: </label>
                      <select class="form-control" name="chucVu">
                      <option value="<?php echo $cv_id; ?>"><?php echo $ten_cv; ?></option>
                      <?php 
                      foreach ($arrCV as $cv)
                      {
                        echo "<option value='".$cv['id']."'>".$cv['ten_chuc_vu']."</option>";
                      }
                      ?>
                      </select>
                      <small style="color: red;"><?php if(isset($error['chucVu'])){ echo "Vui lòng chọn chức vụ"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Sinh viên năm <span style="color: red;">*</span>: </label>
                      <select class="form-control" name="trinhDo">
                      <option value="<?php echo $td_id; ?>"><?php echo $ten_td; ?></option>
                      <?php 
                        foreach ($arrTD as $td)
                        {
                          echo "<option value='".$td['id']."'>".$td['ten_nam_sinh_vien']."</option>";
                        }
                      ?>
                      </select>
                      <small style="color: red;"><?php if(isset($error['trinhDo'])){ echo "Vui lòng chọn năm sinh viên"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Lớp: </label>
                      <select class="form-control" name="chuyenMon">
                      <option value="<?php echo $cm_id; ?>"><?php echo $ten_cm; ?></option>
                      <?php 
                        foreach ($arrCM as $cm)
                        {
                          echo "<option value='".$cm['id']."'>".$cm['ten_lop']."</option>";
                        }
                      ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Trạng thái <span style="color: red;">*</span>: </label>
                      <select class="form-control" name="trangThai">
                      <?php 
                        if($row['trang_thai'] == 1)
                        {
                          echo "<option value='1' selected>Đang học</option>";
                          echo "<option value='2'>Đã tốt nghiệp</option>";
                          echo "<option value='0'>Đã nghỉ học</option>";
                        }
                        else if($row['trang_thai'] == 2)
                        {
                          echo "<option value='1' selected>Đang học</option>";
                          echo "<option value='2'>Đã tốt nghiệp</option>";
                          echo "<option value='0'>Đã nghỉ học</option>";
                        }
                        else
                        {
                          echo "<option value='1' selected>Đang học</option>";
                          echo "<option value='2'>Đã tốt nghiệp</option>";
                          echo "<option value='0'>Đã nghỉ học</option>";
                        }
                      ?>
                        
                        
                      </select>
                      <small style="color: red;"><?php if(isset($error['trangThai'])){ echo "Vui lòng chọn trạng thái"; } ?></small>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Ảnh 3x4 (Nếu có): </label>
                      <input type="file" class="form-control" id="exampleInputEmail1" name="hinhAnh">
                      <small style="color: red;"><?php if(isset($error['kichThuocAnh'])){ echo "Kích thước ảnh quá lớn"; } ?></small>
                      <small style="color: red;"><?php if(isset($error['kieuAnh'])){ echo "Chỉ nhận file ảnh dạng: jpg, jpeg, png, gif"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Giới tính <span style="color: red;">*</span>: </label>
                      <select class="form-control" name="gioiTinh">
                      <?php 
                        if($row['gioi_tinh'] == 1)
                        {
                          echo "<option value='1' selected>Nam</option>";
                          echo "<option value='0'>Nữ</option>";
                        }
                        else
                        {
                          echo "<option value='1'>Nam</option>";
                          echo "<option value='0' selected>Nữ</option>";
                        }
                      ?>
                      </select>
                      <small style="color: red;"><?php if(isset($error['gioiTinh'])){ echo "Vui lòng chọn giới tính"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Ngày sinh: </label>
                      <input type="date" class="form-control" id="exampleInputEmail1" name="ngaySinh" value="<?php echo $row['ngay_sinh']; ?>">
                    </div>
                    <div class="form-group">
                      <label>Nơi sinh: </label>
                      <textarea class="form-control" name="noiSinh"><?php echo $row['noi_sinh']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label>Nguyên quán: </label>
                      <textarea class="form-control" name="nguyenQuan"><?php echo $row['nguyen_quan']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label>Hộ khẩu <span style="color: red;">*</span>: </label>
                      <textarea class="form-control" name="hoKhau"><?php echo $row['ho_khau']; ?></textarea>
                      <small style="color: red;"><?php if(isset($error['hoKhau'])){ echo "Vui lòng nhập hộ khẩu"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Tạm trú: </label>
                      <textarea class="form-control" name="tamTru"><?php echo $row['tam_tru']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label>Xuất Thân <span style="color: red;">*</span>: </label>
                      <select class="form-control" name="xuatThan">
                      <option value="<?php echo $xt_id; ?>"><?php echo $ten_xt; ?></option>
                      <?php 
                      foreach ($arrXuatThan as $xt)
                      {
                        echo "<option value='".$xt['id']."'>".$xt['xuat_than']."</option>";
                      }
                      ?>
                      </select>
                      <small style="color: red;"><?php if(isset($error['xuatThan'])){ echo "Vui lòng xuất thân"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Số điện thoại <span style="color: red;">*</span>: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập số điện thoại" name="soDienThoai" value="<?php echo $row['so_dienthoai']; ?>">
                      <small style="color: red;"><?php if(isset($error['soDienThoai'])){ echo "Vui lòng nhập số điện thoại"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>E-mail <span style="color: red;">*</span>: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập E-mail" name="Email" value="<?php echo $row['email']; ?>">
                    </div>
                    <div class="form-group">
                      <label>Sở trường <span style="color: red;">*</span>: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập sở trường" name="soTruong" value="<?php echo $row['so_truong']; ?>">
                    </div>
                    <div> <h3>Thông tin về gia đình</h3>
                    </div>
                    <div class="form-group">
                      <label>Họ tên bố <span style="color: red;">*</span>: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên bố" name="tenBo" value="<?php echo $row['hoten_bo']; ?>">
                      <small style="color: red;"><?php if(isset($error['tenBo'])){ echo "Tên bố không được để trống"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Nghề nghiệp bố: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập nghề nghiệp" name="ngheBo" value="<?php echo $row['nghenghiep_bo']; ?>">
                    </div>
                    <div class="form-group">
                      <label>Ngày sinh bố: </label>
                      <input type="date" class="form-control" id="exampleInputEmail1" name="ngaySinhBo" value="<?php echo $row['ngaysinh_bo']; ?>">
                    </div>
                    <div class="form-group">
                      <label>Số điện thoại bố <span style="color: red;">*</span>: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập số bố" name="soBo" value="<?php echo $row['sdt_bo']; ?>">
                      <small style="color: red;"><?php if(isset($error['soBo'])){ echo "Số bố không được để trống"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Họ tên mẹ <span style="color: red;">*</span>: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên mẹ" name="tenMe" value="<?php echo $row['hoten_me']; ?>">
                      <small style="color: red;"><?php if(isset($error['tenMe'])){ echo "Tên mẹ không được để trống"; } ?></small>
                    </div>
                    <div class="form-group">
                      <label>Nghề nghiệp mẹ: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập nghề nghiệp" name="ngheMe" value="<?php echo $row['nghenghiep_me']; ?>">
                    </div>
                    <div class="form-group">
                      <label>Ngày sinh mẹ: </label>
                      <input type="date" class="form-control" id="exampleInputEmail1" name="ngaySinhMe" value="<?php echo $row['ngaysinh_me']; ?>">
                    </div>
                    <div class="form-group">
                      <label>Số điện thoại mẹ <span style="color: red;">*</span>: </label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nhập số mẹ" name="soMe" value="<?php echo $row['sdt_me']; ?>">
                      <small style="color: red;"><?php if(isset($error['soMe'])){ echo "Số mẹ không được để trống"; } ?></small>
                    </div>
                  </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <?php 
                if($_SESSION['level'] == 1)
                  echo "<button type='submit' class='btn btn-warning' name='save'><i class='fa fa-save'></i> Lưu lại thông tin</button>";
                ?>
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