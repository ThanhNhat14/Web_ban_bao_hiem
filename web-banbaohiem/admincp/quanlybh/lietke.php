<?php
  if(!isset($_SESSION['admin'])){
    header('http://localhost/web-banbaohiem/admincp/trangchu.php');
  }
?>
<script>
            function confirmDelete(id) {
                if (confirm("Bạn có chắc chắn muốn xóa nội dung này không?")) {
                    window.location.href = "quanlybh/xoa.php?id_baohiem=" + id;
                }
            }
//             function editItem(id) {
//                 window.location.href = "quanlybh/sua.php?id_baohiem=" + id;
//  }
// </script>
<style>
    .my-table {
        width: 100%;
        border-collapse: collapse;
    }

    .my-table th, .my-table td {
        padding: 10px;
        border: 1px solid #ccc;
    }

    .my-table th {
        background-color: #f2f2f2;
    }

    .my-table img {
        max-width: 100px;
        height: auto;
    }
</style>
<h1>Danh sách bảo hiểm</h1>
<form method="POST" action="">
    <button type="submit" name="all">Hiện tất cả</button>
    <button type="submit" name="nguoi">Hiện bảo hiểm người</button>
    <button type="submit" name="taisan">Hiện bảo hiểm tài sản</button>
    <?php
    //require_once '../config/config.php';
    if(isset($_SESSION['admin'])){
        if(isset($_POST['all'])){
            $find = "SELECT * FROM chinhsach AS CS JOIN danhmuc AS DM ON CS.id_danhmuc = DM.id_danhmuc ORDER BY id_baohiem ASC";
        }
        else if(isset($_POST['nguoi'])){
            $find = "SELECT * FROM chinhsach AS CS JOIN danhmuc AS DM ON CS.id_danhmuc = DM.id_danhmuc WHERE CS.id_danhmuc='1' ORDER BY  CS.id_baohiem ASC";
        }
        else if(isset($_POST['taisan'])){
            $find = "SELECT * FROM chinhsach AS CS JOIN danhmuc AS DM ON CS.id_danhmuc = DM.id_danhmuc WHERE CS.id_danhmuc='2' ORDER BY CS.id_baohiem ASC";
        }else {
            $find = "SELECT * FROM chinhsach AS CS JOIN danhmuc AS DM ON CS.id_danhmuc = DM.id_danhmuc ORDER BY id_baohiem ASC";
        }
        $result = $mysqli->query($find);
        if ($result->num_rows > 0) {
          //  echo "<table border='1' style='width: auto;'>
          echo "<table class='my-table'>
            <tr>
            <th>Mã bảo hiểm</th>
            <th>Tên bảo hiểm</th>
            <th>Hình ảnh</th>
            <th>Giá bảo hiểm</th>
            <th>Mô tả</th>
            <th>Tuổi tối thiểu tham gia</th>
            <th>Tuổi tối đa tham gia</th>
            <th>Chu kỳ bảo hiểm</th>
            <th>Danh mục bảo hiểm</th>
            <th>Loại bảo hiểm</th>
            <th>Action</th>
            </tr>";
                                
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row["id_baohiem"]."</td>";
                    echo "<td>".$row["ten_baohiem"]."</td>";
                    echo "<td><img src='http://localhost/web-banbaohiem/admincp/quanlybh/uploads/" . $row["hinhanh"] . "' alt='Hình ảnh'></td>";
                    echo "<td>".$row["gia_baohiem"]."</td>";
                    echo "<td>".$row["mota"]."</td>";
                    echo "<td>".$row["ttt"]."</td>";
                    echo "<td>".$row["ttd"]."</td>";
                    echo "<td>".$row["tgck"]."</td>";
                    echo "<td>".$row["id_danhmuc"]."</td>";
                    echo "<td>".$row["tendanhmuc"]."</td>";
                    echo "<td><a href='quanlybh/xoa.php?id_baohiem=".$row["id_baohiem"]."'>Xóa</a>
                            <a href='quanlybh/sua.php?id_baohiem=".$row["id_baohiem"]."'>Sửa</a>
                    </td>";
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