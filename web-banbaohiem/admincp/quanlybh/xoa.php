<?php
    session_start();
    require_once '../config/config.php';
    if(!isset($_SESSION['admin'])){
        exit();
    }
   // require_once 'D:\xampp\htdocs\bh_ctdl\connect.php';

    // Kiểm tra xem tham số "id_baohiem" đã được truyền vào không
    if (isset($_GET['id_baohiem'])) {
        $id_baohiem= $_GET['id_baohiem'];

        // Thực hiện câu truy vấn DELETE để xóa bản ghi
        $delete_sql = "DELETE FROM chinhsach WHERE id_baohiem = '$id_baohiem'";
        if ($mysqli->query($delete_sql) === TRUE) {
            echo "Chính sách bảo hiểm này đã bị loại bỏ";
            echo "<div class='button'><a href='http://localhost/web-banbaohiem/admincp/trangchu.php?action=quanlybaohiem&query=?'>Trở lại</a></div>";
        } else {
            echo "Lỗi xóa bản ghi: ";
        }   
    }else 
            echo "Không xóa được bản ghi";

    $mysqli->close();
?>