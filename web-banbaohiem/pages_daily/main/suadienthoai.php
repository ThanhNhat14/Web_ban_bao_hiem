<?php
if(empty($_SESSION['email'])){
    exit();
}
if(isset($_SESSION['email'])){
    $email=$_SESSION['email'];
 } else {
    $email= "";
 }

if (isset($_GET['id'])) {
    $id_khachhang = $_GET['id'];

    // Kiểm tra xem có dữ liệu được gửi từ form hay không
    if (isset($_POST['dienthoai'])) {
        $dienthoai_moi = $_POST['dienthoai'];

        // Thực hiện truy vấn để cập nhật số điện thoại mới
        $sql = "UPDATE user SET dienthoai = '$dienthoai_moi' WHERE id = '$id_khachhang'";
        $query = mysqli_query($mysqli, $sql);

        if ($query) {
            // Sửa số điện thoại thành công
            echo "Sửa số điện thoại thành công.";
            echo '<script>setTimeout(function() { window.location.href = "index.php?quanly=thongtin&email=' . $email . '"; }, 0);</script>';
        } else {
            // Sửa số điện thoại không thành công
            echo "Đã xảy ra lỗi trong quá trình sửa số điện thoại.";
        }
    }

    // Truy vấn thông tin khách hàng với ID tương ứng
    $sql = "SELECT * FROM user WHERE id = '$id_khachhang' ";
    $query = mysqli_query($mysqli, $sql);

    // Kiểm tra xem có dữ liệu khách hàng hay không
    if (mysqli_num_rows($query) > 0) {
        $thongTinKhachHang = mysqli_fetch_assoc($query);

        // Hiển thị form để sửa số điện thoại
        ?>
        <h2>Sửa số điện thoại</h2>
        <form method="POST" action="">
            <label for="dienthoai">Số điện thoại mới:</label>
            <input style="width: 20%;" type="text" name="dienthoai" value="<?php echo $thongTinKhachHang['dienthoai']; ?>" required>
            <input style="width: 8%; "  type="submit" value="Lưu">
        </form>
        <?php
    } else {
        echo "<h3>Không tìm thấy thông tin khách hàng</h3>";
    }
} else {
    echo "<h3>Không tìm thấy ID khách hàng</h3>";
}
?>