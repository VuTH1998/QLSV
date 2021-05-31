<?php 
	
	// PHPExcel
  	include('Classes/PHPExcel.php');
  	// connect database
  	require_once('../config.php');

  	// export file excel
  	$objExcel = new PHPExcel;
  	$objExcel->setActiveSheetIndex(0);
  	$sheet = $objExcel->getActiveSheet()->setTitle('Bảng học phí');
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
  	// chinh mau dong title
  	$sheet->getStyle('A1:J1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00ffff00');
  	// canh giua
  	$sheet->getStyle('A1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  	// dem so dong
  	$rowCount = 1;
  	// set cho dong dau tien (dong tieu de)
  	$sheet->setCellValue('A' . $rowCount, 'STT');
  	$sheet->setCellValue('B' . $rowCount, 'Mã học phí');
	$sheet->setCellValue('C' . $rowCount, 'Mã sinh viên');  
  	$sheet->setCellValue('D' . $rowCount, 'Tên sinh viên');
  	$sheet->setCellValue('E' . $rowCount, 'Chức vụ');
  	$sheet->setCellValue('F' . $rowCount, 'Học phí kỳ');
  	$sheet->setCellValue('G' . $rowCount, 'Số tín chỉ');
	$sheet->setCellValue('H' . $rowCount, 'Đã đóng');  
  	$sheet->setCellValue('I' . $rowCount, 'Còn nợ');
  	$sheet->setCellValue('J' . $rowCount, 'Ngày dóng');

  	// do du lieu tu db
  	$sql = "SELECT ma_hoc_phi, hinh_anh, nv.id as idNhanVien,ma_sinhvien,  ho_sv, ten_sv, ten_chuc_vu, hoc_phi_ky, so_tin_chi,  da_nop, con_no, ngay_dong FROM hoc_phi l, sinhvien nv, chuc_vu cv WHERE nv.id = l.sinhvien_id AND nv.chuc_vu_id = cv.id";
  	$result = mysqli_query($conn, $sql);
  	$stt = 0;
  	while ($row = mysqli_fetch_array($result)) 
  	{
  		// do du lieu tang len theo cac cot
  		$rowCount++;
  		$stt++;
  		// do het du lieu ra cac dong
  		$sheet->setCellValue('A' . $rowCount, $stt);
	  	$sheet->setCellValue('B' . $rowCount, $row['ma_hoc_phi']);
		$sheet->setCellValue('C' . $rowCount, $row['ma_sinhvien']);
	  	$sheet->setCellValue('D' . $rowCount, $row['ho_sv']." ".$row['ten_sv']);
	  	$sheet->setCellValue('E' . $rowCount, $row['ten_chuc_vu']);
	  	$sheet->setCellValue('F' . $rowCount, number_format($row['hoc_phi_ky'])."vnđ");
	  	$sheet->setCellValue('G' . $rowCount, $row['so_tin_chi']);
		  $sheet->setCellValue('H' . $rowCount, number_format($row['da_nop'])."vnđ");
	  	$sheet->setCellValue('I' . $rowCount, number_format($row['con_no'])."vnđ");
	  	$sheet->setCellValue('J' . $rowCount, $row['ngay_dong']);
  	}

  	// tao border
  	$styleArray = array(
  		'borders' => array(
  			'allborders' => array(
  				'style' => PHPExcel_Style_Border::BORDER_THIN
  			)
  		)
  	);
  	$sheet->getStyle('A1:' . 'J'.($rowCount))->applyFromArray($styleArray);

  	// tao tac xuat file
  	$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
  	$filename = 'bang-hoc-phi.xlsx';
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