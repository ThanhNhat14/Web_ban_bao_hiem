<style>
    /* CSS cho bảng */
    table {
        width: 90%;
        border-collapse: collapse;
        margin: 0 auto;
    }

    th, td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        color: #800080;
    }

    td {
        background-color: #fff;
    }

    /* CSS cho tiêu đề bảng */
    .thong-tin-khach-hang h2 {
        color: #800080;
        text-align: center;
    }
     /* CSS cho nút sửa */
     .edit-button {
        display: inline-block;
        padding: 8px 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .edit-button:hover {
        background-color: #45a049;
    }
</style>

<?php 
if (isset($_GET['email'])&&!empty($_SESSION['email'])) {
    $email_user = $_GET['email'];

    // Thực hiện truy vấn CSDL để lấy thông tin khách hàng với ID tương ứng
    $sql = "SELECT * FROM user WHERE email = '$email_user' ";
    $query = mysqli_query($mysqli, $sql);

    // Kiểm tra xem có dữ liệu khách hàng hay không
    if (mysqli_num_rows($query) > 0) {
        $thongTinKhachHang = mysqli_fetch_assoc($query);

        // Hiển thị thông tin khách hàng
        ?>
        <div class="thong-tin-khach-hang">
            <h2>Thông tin khách hàng</h2>
            <p>ID: <?php echo $thongTinKhachHang['id']; ?></p>
            <h3>Họ tên: <?php echo $thongTinKhachHang['ten_user']; ?></h3>
            <p>Giới tính: <?php echo $thongTinKhachHang['gioitinh']; ?><p>Ngày sinh: <?php echo $thongTinKhachHang['ngaysinh'].
            "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tuổi: ".$thongTinKhachHang['tuoi']?></p></p>
            <p>Email: <?php echo $thongTinKhachHang['email']; ?></p>
            <p>
                 Số điện thoại: <?php echo $thongTinKhachHang['dienthoai']; ?>
                <a href="index.php?quanly=suadienthoai&id=<?php echo $thongTinKhachHang['id']; ?>"><button class="edit-button">Sửa</button></a>
            </p>
            <!-- Các thông tin khác -->
            <h2 style="color: #800080; text-align: center;">Bảo Hiểm Đã Mua </h2>
            <table style="width: 90%;">
                <thead>
                    <tr style="color: #800080; text-align: center;">
                        <th>Tên bảo hiểm</th>
                        <th>Số lượng</th>
                        <th>Thời hạn bảo hiểm</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Truy vấn các hợp đồng tương ứng với ID khách hàng
                    $id_khachhang = $thongTinKhachHang['id'];
                    $sql_hopdong_mua = "SELECT hopdong.id_baohiem, chinhsach.ten_baohiem, hopdong.soluong, DATE(DATE_ADD(hopdong.ngayky_hopdong, INTERVAL chinhsach.tgck YEAR)) AS thoihan_baohiem
                                        FROM hopdong
                                        INNER JOIN chinhsach ON chinhsach.id_baohiem = hopdong.id_baohiem
                                        WHERE hopdong.id_user = '$id_khachhang'";
                    $query_hopdong_mua = mysqli_query($mysqli, $sql_hopdong_mua);

                    // Hiển thị danh sách các hợp đồng
                    if (mysqli_num_rows($query_hopdong_mua) > 0) {
                        while ($row_hopdong_mua = mysqli_fetch_assoc($query_hopdong_mua)) {
                            echo "<tr>";
                            echo "<td>" . $row_hopdong_mua['ten_baohiem'] . "</td>";
                            echo "<td>" . $row_hopdong_mua['soluong'] . "</td>";
                            echo "<td>" . $row_hopdong_mua['thoihan_baohiem'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>";
                        echo "<td colspan='3'>Không có hợp đồng nào hiện đã mua";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php
}
} else {
    echo "<h3>Không tìm thấy thông tin khách hàng</h3>";
}
?>