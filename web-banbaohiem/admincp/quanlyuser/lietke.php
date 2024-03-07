<script>
            function confirmDelete(id) {
                if (confirm("Bạn có chắc chắn muốn xóa nội dung này không?")) {
                    window.location.href = "quanlyuser/xoa.php?id=" + id;
                }
            }
            </script>

<h1>Danh sách người dùng</h1>
<form method="POST" action="">
    <input type="text" name="search_value_user" placeholder="Tìm" style='width: 360px;'>
    <button type="submit" name="search">Tìm kiếm</button>
    <button type="submit" name="all">Hiện tất cả</button>
    <button type="submit" name="nam">Nam</button>
    <button type="submit" name="nu">Nữ</button>

    <?php
  //  require_once 'D:\xampp\htdocs\bh_ctdl\connect.php';
    if(isset($_SESSION['admin'])){
        if(isset($_POST['search'])){
            $search_value = $_POST['search_value_user'];
            // Thực hiện câu truy vấn SELECT với điều kiện tìm kiếm
            $find = "SELECT * FROM user WHERE ten_user LIKE '%$search_value%' OR id LIKE '$search_value' 
            OR email LIKE '$search_value' ORDER BY ten_user DESC ";

        }
        else
         if(isset($_POST['all'])){
            $find = "SELECT * FROM user ORDER BY ten_user DESC";
        }
        else if(isset($_POST['nam'])){
            $find = "SELECT * FROM user WHERE gioitinh='Nam' ORDER BY ten_user DESC";
        }
        else if(isset($_POST['nu'])){
            $find = "SELECT * FROM user WHERE gioitinh='nu' ORDER BY ten_user DESC";
        }else {
            $find = "SELECT * FROM user ORDER BY ten_user DESC";
        }
        $result = $mysqli->query($find);
                if ($result->num_rows > 0) {
                    echo "<table border='1' style='width: auto;'>
                            <tr>
                                <th>Mã người dùng</th>
                                <th>Tên người dùng</th>
                                <th>Email</th>
                                <th>Mật khẩu</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Tuổi</th>
                                <th>Nghề nghiệp</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Action</th>
                            </tr>";
        
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["id"]."</td>";
                        echo "<td>".$row["ten_user"]."</td>";
                        echo "<td>".$row["email"]."</td>";
                        echo "<td>".md5($row["matkhau"])."</td>";
                        echo "<td>".$row["gioitinh"]."</td>";
                        echo "<td>".$row["ngaysinh"]."</td>";
                        echo "<td>".$row["tuoi"]."</td>";
                        echo "<td>".$row["nghenghiep"]."</td>";
                        echo "<td>".$row["dienthoai"]."</td>";
                        echo "<td>".$row["dia_chi"]."</td>";
                        echo "<td><button onclick='confirmDelete(".$row["id"].")'>Xóa</button></td>";
                        echo "</tr>";
                    }
                   echo "</table>";
                } else {
                    echo "Không tìm thấy kết quả";
                }
            }
          //  $mysqli->close();
    ?>
  </form>