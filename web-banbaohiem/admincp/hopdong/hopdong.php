<script>
            function confirmDelete(id) {
                if (confirm("Bạn có chắc chắn muốn xóa nội dung này không?")) {
                    window.location.href = "http://localhost/web-banbaohiem/admincp/hopdong/xoahd.php?id_hopdong=" + id;
                }
            }
            </script>

<h1>Danh sách hợp đồng</h1>
<form method="POST" action="">
    <input type="text" name="search_value" placeholder="Tìm" style='width: 360px;'>
    <button type="submit" name="search">Tìm kiếm</button>
    <button type="submit" name="all">Hiện tất cả</button>
    <button type="submit" name="non-pay">Hiện chưa thanh toán</button>
    <button type="submit" name="paid">Hiện đã thanh toán</button>

    <?php
    $sql = "SELECT hd.id_hopdong, hd.id_baohiem, cs.ten_baohiem, hd.ten_khachhang, hd.gioitinh, hd.ngaysinh, hd.tuoi, hd.nghenghiep,
    hd.diachi, hd.ngayky_hopdong, hd.handongtien, hd.thoihan_baohiem, hd.trangthai FROM hopdong AS hd LEFT JOIN chinhsach AS cs 
    ON hd.id_baohiem = cs.id_baohiem"; 
    if(isset($_SESSION['admin'])){
        if(isset($_POST['search'])){
            $search_value = $_POST['search_value'];
            // Thực hiện câu truy vấn SELECT với điều kiện tìm kiếm
            $find = $sql." WHERE hd.ten_khachhang LIKE '%$search_value%' OR hd.id_baohiem LIKE '$search_value'
                OR cs.ten_baohiem LIKE '%$search_value%' OR hd.id_hopdong LIKE '$search_value' ORDER BY hd.ten_khachhang DESC ";
        }
        else if(isset($_POST['all'])){
            $find = $sql." ORDER BY hd.ten_khachhang DESC";
        }
        else if(isset($_POST['non-pay'])){
            $find = $sql." WHERE trangthai='0' ORDER BY ten_khachhang DESC";
        }
        else if(isset($_POST['paid'])){
            $find = $sql." WHERE trangthai='1' ORDER BY ten_khachhang DESC";
        }else {
            $find = $sql." ORDER BY hd.ten_khachhang DESC";
        }
        $result = $mysqli->query($find);
                if ($result->num_rows > 0) {
                    echo "<table border='1' style='width: auto;'>
                            <tr>
                                <th>Mã hợp đồng</th>
                                <th>Mã bảo hiểm</th>
                                <th>Tên bảo hiểm</th>
                                <th>Tên khách hàng</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Tuổi</th>
                                <th>Nghề nghiệp</th>
                                <th>Địa chỉ</th>
                                <th>Ngày ký hợp đồng</th>
                                <th>Thời hạn đóng tiền</th>
                                <th>Thời hạn bảo hiểm</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>";
        
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["id_hopdong"]."</td>";
                        echo "<td>".$row["id_baohiem"]."</td>";
                        echo "<td>".$row["ten_baohiem"]."</td>";
                        echo "<td>".$row["ten_khachhang"]."</td>";
                        echo "<td>".$row["gioitinh"]."</td>";
                        echo "<td>".$row["ngaysinh"]."</td>";
                        echo "<td>".$row["tuoi"]."</td>";
                        echo "<td>".$row["nghenghiep"]."</td>";
                        echo "<td>".$row["diachi"]."</td>";
                        echo "<td>".$row["ngayky_hopdong"]."</td>";
                        echo "<td>".$row["handongtien"]."</td>";
                        echo "<td>".$row["thoihan_baohiem"]."</td>";
                        echo "<td>".$row["trangthai"]."</td>";
                        echo "<td><button onclick='confirmDelete(".$row["id_hopdong"].")'>Xóa</button></td>";
                        echo "</tr>";
                    }
                   echo "</table>";
                } else {
                    echo "Không tìm thấy kết quả";
                }
            }
         //   $mysqli->close();
    ?>
  </form>