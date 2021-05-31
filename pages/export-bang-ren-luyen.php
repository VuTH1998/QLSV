<?php 
	
	// PHPExcel
  	include('Classes/PHPExcel.php');
  	// connect database
  	require_once('../config.php');

  	// export file excel
  	$objExcel = new PHPExcel;
  	$objExcel->setActiveSheetIndex(0);
  	$sheet = $objExcel->getActiveSheet()->setTitle('Bảng rèn luyện');
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
  	// chinh mau dong title
  	$sheet->getStyle('A1:M1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00ffff00');
  	// canh giua
  	$sheet->getStyle('A1:M1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  	// dem so dong
  	$rowCount = 1;
  	// set cho dong dau tien (dong tieu de)
  	$sheet->setCellValue('A' . $rowCount, 'STT');
  	$sheet->setCellValue('B' . $rowCount, 'Mã sinh viên');
	$sheet->setCellValue('C' . $rowCount, 'Tên sinh viên');  
  	$sheet->setCellValue('D' . $rowCount, 'Học kỳ');
  	$sheet->setCellValue('E' . $rowCount, 'Năm');
  	$sheet->setCellValue('F' . $rowCount, 'Tiêu chí 1');
  	$sheet->setCellValue('G' . $rowCount, 'Tiêu chí 2');
	$sheet->setCellValue('H' . $rowCount, 'Tiêu chí 3');  
  	$sheet->setCellValue('I' . $rowCount, 'Tiêu chí 4');
  	$sheet->setCellValue('J' . $rowCount, 'Tiêu chí 5');
    $sheet->setCellValue('K' . $rowCount, 'Tổng điểm');
    $sheet->setCellValue('L' . $rowCount, 'Xếp Loại');
    $sheet->setCellValue('M' . $rowCount, 'Ngày Xét');

  	// do du lieu tu db
  	$sql = "SELECT ma_diem, hinh_anh, nv.id as idNhanVien, ma_sinhvien,  ho_sv, ten_sv, ky_hoc, nam_hoc_sinh_vien, tieu_chi1, tieu_chi2, tieu_chi3, tieu_chi4, tieu_chi5, tong_diem, ngay_xet FROM bang_diem bd, sinhvien nv WHERE nv.id = bd.sinhvien_id ";
  	$result = mysqli_query($conn, $sql);
  	$stt = 0;
  	while ($row = mysqli_fetch_array($result)) 
  	{

        if($row['tong_diem'] < 35)
      {
        $XepLoai = 'Kém';
      }
	  else if($row['tong_diem'] < 50)
      {
        $XepLoai = 'Yếu';
      }
      else if($row['tong_diem'] < 65)
      {
        $XepLoai = 'Trung Bình';
      }
      else if($row['tong_diem'] < 80)
      {
        $XepLoai = 'Khá';
      }
      else if($row['tong_diem'] < 90)
      {
        $XepLoai = 'Tốt';
      }
      else
      {
        $XepLoai = 'Xuất sắc';
      }
  		// do du lieu tang len theo cac cot
  		$rowCount++;
  		$stt++;
  		// do het du lieu ra cac dong
  		$sheet->setCellValue('A' . $rowCount, $stt);
		$sheet->setCellValue('B' . $rowCount, $row['ma_sinhvien']);
	  	$sheet->setCellValue('C' . $rowCount, $row['ho_sv']." ".$row['ten_sv']);
        $sheet->setCellValue('D' . $rowCount, $row['ky_hoc']);
        $sheet->setCellValue('E' . $rowCount, $row['nam_hoc_sinh_vien']);
        $sheet->setCellValue('F' . $rowCount, $row['tieu_chi1']);
        $sheet->setCellValue('G' . $rowCount, $row['tieu_chi2']);
        $sheet->setCellValue('H' . $rowCount, $row['tieu_chi3']);
        $sheet->setCellValue('I' . $rowCount, $row['tieu_chi4']);
        $sheet->setCellValue('J' . $rowCount, $row['tieu_chi5']);
	  	$sheet->setCellValue('K' . $rowCount, $row['tong_diem']);
        $sheet->setCellValue('L' . $rowCount, $XepLoai);
	  	$sheet->setCellValue('M' . $rowCount, $row['ngay_xet']);
  	}

  	// tao border
  	$styleArray = array(
  		'borders' => array(
  			'allborders' => array(
  				'style' => PHPExcel_Style_Border::BORDER_THIN
  			)
  		)
  	);
  	$sheet->getStyle('A1:' . 'M'.($rowCount))->applyFromArray($styleArray);

  	// tao tac xuat file
  	$objWriter = new PHPExcel_Writer_Excel2007($objExcel);
  	$filename = 'bang-ren-luyen.xlsx';
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