
<?php
session_start();
require_once '../config/config.php';
?>

<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <div class="container">
        <?php
    //     session_start();
    // require_once '../config/config.php';

    // Kiểm tra xem tham số "id_hopdong" đã được truyền vào không
    if (isset($_GET['id_hopdong'])) {
        $id_hopdong = $_GET['id_hopdong'];

        // Thực hiện câu truy vấn DELETE để xóa bản ghi
        $delete_sql = "DELETE FROM hopdong WHERE id_hopdong = '$id_hopdong'";
        if ($mysqli->query($delete_sql) === TRUE) {
            echo "Hợp đồng đã bị loại bỏ";
            echo "<div class='button'><a href='http://localhost/web-banbaohiem/admincp/trangchu.php?action=hopdong&query=?'>Trở lại</a></div>";

        } else {
            echo "Lỗi xóa bản ghi: ";
        }   
    }else 
            echo "Không xóa được bản ghi";

    $mysqli->close();
        ?>
    </div>
</body>
</html>