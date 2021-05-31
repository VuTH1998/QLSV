
<?php 
    
    // get active sidebar
    if(isset($_GET['p']) && isset($_GET['a']))
    {
        $p = $_GET['p'];
        $a = $_GET['a'];
    }
?>

<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../uploads/images/<?php echo $row_acc['hinh_anh']; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>
            <?php echo $row_acc['ten']; ?> <?php echo $row_acc['ho']; ?>
          </p>
          <a href="#"><i class="fa fa-circle text-success"></i>
            <?php 
              if($row_acc['quyen'] == 1)
              {
                echo "Quản trị viên";
              }
              else
              {
                echo "Sinh viên";
              }
            ?>
          </a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Tìm kiếm...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">CƠ SỞ DỮ LIỆU</li>
        <li class="<?php if($p == 'index') echo 'active'; ?> treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Tổng quan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($a == 'statistic') echo 'active'; ?>"><a href="index.php><i class="fa fa-circle-o"></i> Thống kê</a></li>
            <li class="<?php if($a == 'sinhvien') echo 'active'; ?>"><a a href="ds-sinhvien.php?p=index&a=sinhvien"><i class="fa fa-circle-o"></i> Danh sách sinh viên</a></li>
            <li class="<?php if(($p == 'index') && ($a == 'taikhoan')) echo 'active'; ?>"><a href="index_taikhoan.php?p=index&a=taikhoan"><i class="fa fa-circle-o"></i> Danh sách tài khoản</a></li>
          </ul>
        </li>
        <li class="<?php if($p == 'staff') echo 'active'; ?> treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Sinh viên</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if(($p == 'staff') && ($a == 'room')) echo 'active'; ?>"><a href="khoa.php?p=staff&a=room"><i class="fa fa-circle-o"></i> Khoa</a></li>
            <li class="<?php if(($p == 'staff') && ($a == 'position')) echo 'active'; ?>"><a href="chuc-vu.php?p=staff&a=position"><i class="fa fa-circle-o"></i> Chức vụ</a></li>
            <li class="<?php if(($p == 'staff') && ($a == 'level')) echo 'active'; ?>"><a href="sinh-vien-nam.php?p=staff&a=level"><i class="fa fa-circle-o"></i> Năm</a></li>
            <li class="<?php if(($p == 'staff') && ($a == 'specialize')) echo 'active'; ?>"><a href="lop.php?p=staff&a=specialize"><i class="fa fa-circle-o"></i> Ngành học</a></li>
            <li class="<?php if(($p == 'staff') && ($a == 'certificate')) echo 'active'; ?>"><a href="noi-tot-nghiep.php?p=staff&a=certificate"><i class="fa fa-circle-o"></i> Tốt nghiệp</a></li>
            <li class="<?php if(($p == 'staff') && ($a == 'employee-type')) echo 'active'; ?>"><a href="chinh-sach.php?p=staff&a=employee-type"><i class="fa fa-circle-o"></i> Chính sách sinh viên</a></li>
            <li class="<?php if(($p == 'staff') && ($a == 'add-staff')) echo 'active'; ?>"><a href="them-sinh-vien.php?p=staff&a=add-staff"><i class="fa fa-circle-o"></i> Thêm mới sinh viên</a></li>
            <li class="<?php if(($p == 'staff') && ($a =='list-staff')) echo 'active'; ?>"><a href="danh-sach-sinh-vien.php?p=staff&a=list-staff"><i class="fa fa-circle-o"></i> Danh sách sinh viên</a></li>
            <li class="<?php if(($p == 'staff') && ($a =='list-staff2')) echo 'active'; ?>"><a href="timkiem.php?p=staff&a=list-staff"><i class="fa fa-circle-o"></i>Lọc</a></li>
          </ul>
        </li>
        <li class="<?php if($p == 'salary') echo 'active'; ?> treeview">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>Quản lý học phí</span>  
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if(($p == 'salary') && ($a =='salary')) echo 'active'; ?>"><a href="bang-hoc-phi.php?p=salary&a=salary"><i class="fa fa-circle-o"></i> Bảng tính học phí</a></li>
            <li class="<?php if(($p == 'salary') && ($a =='calculator')) echo 'active'; ?>"><a href="tinh-hoc-phi.php?p=salary&a=calculator"><i class="fa fa-circle-o"></i> Tính học phí</a></li>
          </ul>
        </li>
        <li class="<?php if($p == 'salary') echo 'active'; ?> treeview">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>Quản lý học tập</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if(($p == 'salary') && ($a =='salary')) echo 'active'; ?>"><a href="mon_hoc.php?p=salary&a=salary"><i class="fa fa-circle-o"></i> Bảng môn học</a></li>
            <li class="<?php if(($p == 'salary') && ($a =='calculator')) echo 'active'; ?>"><a href="tinh-hoc-phi.php?p=salary&a=calculator"><i class="fa fa-circle-o"></i> Bảng điểm danh</a></li>
          </ul>
        </li>
        <li class="<?php if($p == 'salary') echo 'active'; ?> treeview">
          <a href="#">
          <i class="fa fa-star"></i>
            <span>Quản lý điểm</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if(($p == 'salary') && ($a =='salary')) echo 'active'; ?>"><a href="tinhdiem.php?p=salary&a=salary"><i class="fa fa-circle-o"></i>Tính điểm rèn luyện</a></li>
            <li class="<?php if(($p == 'salary') && ($a =='calculator')) echo 'active'; ?>"><a href="bang-diem-ren-luyen.php?p=salary&a=calculator"><i class="fa fa-circle-o"></i> Bảng điểm rèn luyện</a></li>
            <li class="<?php if(($p == 'salary') && ($a =='calculator2')) echo 'active'; ?>"><a href="xem-diem.php?p=salary&a=calculator2"><i class="fa fa-circle-o"></i> Tra cứu hệ thống</a></li>
          </ul>
        </li>
        <li class="<?php if($p == 'collaborate') echo 'active'; ?> treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Quản lý nội ngoại trú</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if(($p == 'collaborate') && ($a =='add-collaborate')) echo 'active'; ?>"><a href="noi-tru.php?p=collaborate&a=add-collaborate"><i class="fa fa-circle-o"></i> Tạo nội trú</a></li>
            <li class="<?php if(($p == 'collaborate') && ($a =='add-collaborate')) echo 'active'; ?>"><a href="ngoai-tru.php?p=collaborate&a=add-collaborate"><i class="fa fa-circle-o"></i> Tạo ngoại trú</a></li>
            <li class="<?php if(($p == 'collaborate') && ($a =='list-collaborate')) echo 'active'; ?>"><a href="danh-sach-noi-tru.php?p=collaborate&a=list-collaborate"><i class="fa fa-circle-o"></i> Danh sách nội trú</a></li>
            <li class="<?php if(($p == 'collaborate') && ($a =='list-collaborate')) echo 'active'; ?>"><a href="danh-sach-ngoai-tru.php?p=collaborate&a=list-collaborate"><i class="fa fa-circle-o"></i> Danh sách ngoại trú</a></li>
          </ul>
        </li>
        <!--
        <li>
          <a href="pages/widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        -->
        <li class="<?php if($p == 'group') echo 'active'; ?> treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Nhóm sinh viên</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if(($p == 'group') && ($a =='add-group')) echo 'active'; ?>"><a href="tao-nhom.php?p=group&a=add-group"><i class="fa fa-circle-o"></i> Tạo nhóm</a></li>
            <li class="<?php if(($p == 'group') && ($a =='list-group')) echo 'active'; ?>"><a href="danh-sach-nhom.php?p=group&a=list-group"><i class="fa fa-circle-o"></i> Danh sách nhóm</a></li>
          </ul>
        </li>
        <li class="<?php if($p == 'bonus-discipline') echo 'active'; ?> treeview">
          <a href="#">
            <i class="fa fa-star"></i> <span>Khen thưởng - Kỷ luật</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if(($p == 'bonus-discipline') && ($a =='bonus')) echo 'active'; ?>"><a href="khen-thuong.php?p=bonus-discipline&a=bonus"><i class="fa fa-circle-o"></i>Khen thưởng</a></li>
            <li class="<?php if(($p == 'bonus-discipline') && ($a =='discipline')) echo 'active'; ?>"><a href="ky-luat.php?p=bonus-discipline&a=discipline"><i class="fa fa-circle-o"></i> Kỷ luật</a></li>
          </ul>
        </li>
        <!--
        <li>
          <a href="pages/calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
        <li>
          <a href="pages/mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">12</small>
              <small class="label pull-right bg-green">16</small>
              <small class="label pull-right bg-red">5</small>
            </span>
          </a>
        </li>
        -->
        <li class="<?php if($p == 'account') echo 'active'; ?> treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Tài khoản</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($a == 'profile') echo 'active'; ?>"><a href="thong-tin-tai-khoan.php?p=account&a=profile"><i class="fa fa-circle-o"></i> Thông tin tài khoản</a></li>
            <li class="<?php if($a == 'add-account') echo 'active'; ?>"><a href="tao-tai-khoan.php?p=account&a=add-account"><i class="fa fa-circle-o"></i> Tạo tài khoản</a></li>
            <li class="<?php if(($p == 'account') && ($a == 'list-account')) echo 'active'; ?>"><a href="ds-tai-khoan.php?p=account&a=list-account"><i class="fa fa-circle-o"></i> Danh sách tài khoản</a></li>
            <li class="<?php if($a == 'changepass') echo 'active'; ?>"><a href="doi-mat-khau.php?p=account&a=changepass"><i class="fa fa-circle-o"></i> Đổi mật khẩu</a></li>
            <li><a href="dang-xuat.php"><i class="fa fa-circle-o"></i> Đăng xuất</a></li>
          </ul>
        </li>
        <!--
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
          -->
        </li>
        <!--
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>