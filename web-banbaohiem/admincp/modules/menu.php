<ul class="list-admin">
    <?php
    session_start();
    if(!isset($_SESSION['admin'])){
        echo  "<li><a href='trangchu.php?action=dangnhap_admin&query=dangnhap'>Đăng nhập</a></li>";
    }
    else{
        echo 
       "<li><a href='trangchu.php?action=quanlybaohiem&query=?'>Quản lý bảo hiểm</a></li>
        <li><a href='trangchu.php?action=hopthu&query=?'>Hộp thư</a></li>
        <li><a href='trangchu.php?action=quanlyuser&query=?'>Người dùng</a></li>
        <li><a href='trangchu.php?action=hopdong&query=?'>Hợp đồng</a></li>
        <li><a href='trangchu.php?action=dangxuat&query=?'>Đăng xuất</a></li>
        <li><a href='trangchu.php?action=doimatkhau&query=?'>Đổi mật khẩu</a></li>";
    }
    ?>
</ul>