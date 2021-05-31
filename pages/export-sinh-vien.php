<?php 
	
	// PHPExcel
  	include('Classes/PHPExcel.php');
  	// connect database
  	require_once('../config.php');

  	// export file excel
  	$objExcel = new PHPExcel;
  	$objExcel->setActiveSheetIndex(0);
  	$sheet = $objExcel->getActiveSheet()->setTitle('Bảng sinh viên');
  	// dinh dang file excel
  	// - dinh dang cho du kich thuoc noi dung
  	$sheet->getColumnDimension("A")->setAutoSize(true);
  	$sheet->getColumnDimension("B")->setAutoSize(true);
  	$sheet->getColumnDimension("C")->setAutoSize(true);
  	$sheet->getColumnDimension("D")->setAutoSize(true);
  	$sheet->getColumnDimension("E")->setAutoSize(true);
  	$sheet->getColumnDimension("F")->setAutoSize(true);
  	$sheet->getColumnDimension("G")->setAutoSize(true);
  	$sheet->getColumnDimension("H")->setAutoSize(true);
    $sheet->getColumnDimension("I")->setAutoSize(true);
    $sheet->getColumnDimension("J")->setAutoSize(true);
    $sheet->getColumnDimension("K")->setAutoSize(true);
    $sheet->getColumnDimension("L")->setAutoSize(true);
    $sheet->getColumnDimension("M")->setAutoSize(true);
    $sheet->getColumnDimension("N")->setAutoSize(true);
    $sheet->getColumnDimension("O")->setAutoSize(true);
    $sheet->getColumnDimension("P")->setAutoSize(true);
    $sheet->getColumnDimension("Q")->setAutoSize(true);
    $sheet->getColumnDimension("R")->setAutoSize(true);
    $sheet->getColumnDimension("S")->setAutoSize(true);
    $sheet->getColumnDimension("T")->setAutoSize(true);
    $sheet->getColumnDimension("U")->setAutoSize(true);
    $sheet->getColumnDimension("V")->setAutoSize(true);
    $sheet->getColumnDimension("W")->setAutoSize(true);
	$sheet->getColumnDimension("X")->setAutoSize(true);
	$sheet->getColumnDimension("Y")->setAutoSize(true);
	$sheet->getColumnDimension("Z")->setAutoSize(true);
	$sheet->getColumnDimension("AA")->setAutoSize(true);
	$sheet->getColumnDimension("AB")->setAutoSize(true);
	$sheet->getColumnDimension("AC")->setAutoSize(true);
	$sheet->getColumnDimension("AD")->setAutoSize(true);
	$sheet->getColumnDimension("AE")->setAutoSize(true);
	$sheet->getColumnDimension("AF")->setAutoSize(true);
	$sheet->getColumnDimension("AG")->setAutoSize(true);
	$sheet->getColumnDimension("AH")->setAutoSize(true);
	$sheet->getColumnDimension("AI")->setAutoSize(true);
	$sheet->getColumnDimension("AJ")->setAutoSize(true);
	$sheet->getColumnDimension("AK")->setAutoSize(true);
	$sheet->getColumnDimension("AL")->setAutoSize(true);
	$sheet->getColumnDimension("AM")->setAutoSize(true);
  	// chinh mau dong title
  	$sheet->getStyle('A1:W1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00ffff00');
  	// canh giua
  	$sheet->getStyle('A1:W1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  	// dem so dong
  	$rowCount = 1;
  	// set cho dong dau tien (dong tieu de)
  	$sheet->setCellValue('A' . $rowCount, 'STT');
  	$sheet->setCellValue('B' . $rowCount, 'Khoá học');
	$sheet->setCellValue('C' . $rowCount, 'Mã sinh viên');
	$sheet->setCellValue('D' . $rowCount, 'Họ và tên đệm sinh viên');
  	$sheet->setCellValue('E' . $rowCount, 'Tên sinh viên');
	$sheet->setCellValue('F' . $rowCount, 'Nhóm Ngành');
	$sheet->setCellValue('G' . $rowCount, 'Khoa');
	$sheet->setCellValue('H' . $rowCount, 'Chức vụ');
  	$sheet->setCellValue('I' . $rowCount, 'Giới tính');
  	$sheet->setCellValue('J' . $rowCount, 'Ngày sinh');
	$sheet->setCellValue('K' . $rowCount, 'Quốc tịch');
	$sheet->setCellValue('L' . $rowCount, 'Dân tộc');
	$sheet->setCellValue('M' . $rowCount, 'Diện chính sách');
	$sheet->setCellValue('N' . $rowCount, 'Tôn giáo');
	$sheet->setCellValue('O' . $rowCount, 'Số CMND');
	$sheet->setCellValue('P' . $rowCount, 'Ngày cấp');
	$sheet->setCellValue('Q' . $rowCount, 'Nơi cấp');
  	$sheet->setCellValue('R' . $rowCount, 'Nơi sinh');
	$sheet->setCellValue('S' . $rowCount, 'Tình trạng hôn nhân');
	$sheet->setCellValue('T' . $rowCount, 'Nguyên quán');
	$sheet->setCellValue('U' . $rowCount, 'Hộ khẩu');
    $sheet->setCellValue('V' . $rowCount, 'Tạm trú');
	$sheet->setCellValue('W' . $rowCount, 'Xuất Thân');
    $sheet->setCellValue('X' . $rowCount, 'Tốt nghiệp THPT');
	$sheet->setCellValue('Y' . $rowCount, 'Ngày vào đoàn');
	$sheet->setCellValue('Z' . $rowCount, 'Nơi vào đoàn');
	$sheet->setCellValue('AA' . $rowCount, 'Số điện thoại');
  	$sheet->setCellValue('AB' . $rowCount, 'Email');
  	$sheet->setCellValue('AC' . $rowCount, 'Sở trường');
    $sheet->setCellValue('AD' . $rowCount, 'Phương thức xét tuyển');
    $sheet->setCellValue('AE' . $rowCount, 'Điểm xét tuyển');
    $sheet->setCellValue('AF' . $rowCount, 'Họ tên Bố');
    $sheet->setCellValue('AG' . $rowCount, 'Ngày sinh');
    $sheet->setCellValue('AH' . $rowCount, 'Nghề Nghiệp');
    $sheet->setCellValue('AI' . $rowCount, 'Số điện thoại');
    $sheet->setCellValue('AJ' . $rowCount, 'Họ tên Mẹ');
    $sheet->setCellValue('AK' . $rowCount, 'Ngày sinh');
    $sheet->setCellValue('AL' . $rowCount, 'Nghê nghiệp');
    $sheet->setCellValue('AM' . $rowCount, 'Số điện thoại');
   

  	// do du lieu tu db
  	$sql = "SELECT nv.id as id, ma_sv, hinh_anh, ma_sinhvien, ho_sv, ten_sv, biet_danh, gioi_tinh, nv.ngay_tao as ngay_tao, ngay_sinh, noi_sinh, so_cmnd, ten_tinh_trang, ngay_cap_cmnd, ngay_vao_doan, so_dienthoai, email, so_truong, ten_phuongthuc,diem_xettuyen, hoten_bo, ngaysinh_bo, nghenghiep_bo, sdt_bo, hoten_me, ngaysinh_me, nghenghiep_me, sdt_me, noi_cap_cmnd, nguyen_quan, ten_khoahoc, xuat_than ten_quoc_tich, ten_dan_toc, ten_ton_giao, ho_khau, tam_tru, ten_chinh_sach, ten_nam_sinh_vien, ten_lop, ten_noi_tot_nghiep, ten_khoa, ten_chuc_vu, trang_thai FROM sinhvien nv, khoa_hoc kh, xuatthan xt, quoc_tich qt, dan_toc dt, ton_giao tg, chinh_sach lnv,phuongthuc_xettuyen pt, nam_sinh_vien td, lop cm, noi_tot_nghiep bc, khoa pb, chuc_vu cv, tinh_trang_hon_nhan hn WHERE nv.khoahoc_id = kh.id AND  nv.xuat_than_id = xt.id AND  nv.phuong_thuc_id = pt.id AND  nv.quoc_tich_id = qt.id AND nv.dan_toc_id = dt.id AND nv.ton_giao_id = tg.id AND nv.chinh_sach_id = lnv.id AND nv.nam_sinh_vien_id = td.id AND nv.lop_id = cm.id AND nv.noi_tot_nghiep_id = bc.id AND nv.khoa_id = pb.id AND nv.chuc_vu_id = cv.id AND nv.hon_nhan_id = hn.id ORDER BY nv.id DESC";
  	$result = mysqli_query($conn, $sql);
  	$stt = 0;
  	while ($row = mysqli_fetch_array($result)) 
  	{
  		// do du lieu tang len theo cac cot
  		$rowCount++;
  		$stt++;

      // cau hinh lai cac truong
      if($row['gioi_tinh'] == 1)
      {
        $gioiTinh = 'Nam';
      }
      else
      {
        $gioiTinh = 'Nữ';
      }

      if($row['trang_thai'] == 1)
      {
        $trangThai = 'Đang học';
      }
	  else if($row['trang_thai'] == 2)
      {
        $trangThai = 'Đã tốt nghiệp';
      }
      else
      {
        $trangThai = 'Đã nghỉ học';
      }

  		// do het du lieu ra cac dong
  		$sheet->setCellValue('A' . $rowCount, $stt);
		$sheet->setCellValue('B' . $rowCount, $row['ten_khoahoc']);
		$sheet->setCellValue('C' . $rowCount, $row['ma_sinhvien']);  
	  	$sheet->setCellValue('D' . $rowCount, $row['ho_sv']);
		$sheet->setCellValue('E' . $rowCount, $row['ten_sv']);
		$sheet->setCellValue('F' . $rowCount, $row['ten_lop']);
		$sheet->setCellValue('G' . $rowCount, $row['ten_khoa']);
		$sheet->setCellValue('H' . $rowCount, $row['ten_chuc_vu']);
		$sheet->setCellValue('I' . $rowCount, $gioiTinh);
		$sheet->setCellValue('J' . $rowCount, date_format(date_create($row['ngay_sinh']), 'd/m/Y'));
		$sheet->setCellValue('K' . $rowCount, $row['ten_quoc_tich']);
		$sheet->setCellValue('L' . $rowCount, $row['ten_dan_toc']);
		$sheet->setCellValue('M' . $rowCount, $row['ten_chinh_sach']);
		$sheet->setCellValue('N' . $rowCount, $row['ten_ton_giao']);
		$sheet->setCellValue('O' . $rowCount, $row['so_cmnd']);
		$sheet->setCellValue('P' . $rowCount, date_format(date_create($row['ngay_cap_cmnd']), 'd/m/Y'));
		$sheet->setCellValue('Q' . $rowCount, $row['noi_cap_cmnd']);
		$sheet->setCellValue('R' . $rowCount, $row['noi_sinh']);
		$sheet->setCellValue('S' . $rowCount, $row['ten_tinh_trang']);
		$sheet->setCellValue('T' . $rowCount, $row['nguyen_quan']);
		$sheet->setCellValue('U' . $rowCount, $row['ho_khau']);
		$sheet->setCellValue('V' . $rowCount, $row['tam_tru']);
		$sheet->setCellValue('W' . $rowCount, $row['xuat_than']);
		$sheet->setCellValue('X' . $rowCount, $row['ten_noi_tot_nghiep']);
		$sheet->setCellValue('Y' . $rowCount, $row['ngay_vao_doan']);
		$sheet->setCellValue('Z' . $rowCount, $row['ten_noi_tot_nghiep']);
		$sheet->setCellValue('AA' . $rowCount, $row['so_dienthoai']);
		$sheet->setCellValue('AB' . $rowCount, $row['email']);
		$sheet->setCellValue('AC' . $rowCount, $row['so_truong']);
		$sheet->setCellValue('AD' . $rowCount, $row['ten_phuongthuc']);
		$sheet->setCellValue('AE' . $rowCount, $row['diem_xettuyen']);
		$sheet->setCellValue('AF' . $rowCount, $row['hoten_bo']);
		$sheet->setCellValue('AG' . $rowCount, $row['ngaysinh_bo']);
		$sheet->setCellValue('AH' . $rowCount, $row['nghenghiep_bo']);
		$sheet->setCellValue('AI' . $rowCount, $row['sdt_bo']);
		$sheet->setCellValue('AJ' . $rowCount, $row['hoten_me']);
		$sheet->setCellValue('AK' . $rowCount, $row['ngaysinh_me']);
		$sheet->setCellValue('AL' . $rowCount, $row['nghenghiep_me']);
		$sheet->setCellValue('AM' . $rowCount, $row['sdt_me']);
  	}

  	// tao border
  	$styleArray = array(
  		'borders' => array(
  			'allborders' => array(
  				'style' => PHPExcel_Style_Border::BORDER_THIN
  			)
  		)
  	);
  	$sheet->getStyle('A1:' . 'W'.($rowCount))->applyFromArray($styleArray);

  	// tao tac xuat file
  	$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
  	$filename = 'sinh-vien.xlsx';
  	$objWriter->save($filename);

  	// cau hinh khi xuat file
  	header('Content-Disposition: attachment; filename="' .$filename. '"'); // tra ve file kieu attachment
  	header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');
  	header('Content-Legth: ' . filesize($filename));
  	header('Content-Transfer-Encoding: binary');
  	header('Cache-Control: must-revalidate');
  	header('Pragma: no-cache');
  	readfile($filename);
  	return;

?>