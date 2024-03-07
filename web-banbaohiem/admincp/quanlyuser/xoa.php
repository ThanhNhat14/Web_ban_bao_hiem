<?php
    //session_start();
    require_once '../config/config.php';

    // Kiểm tra xem tham số "id" đã được truyền vào không
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Thực hiện câu truy vấn DELETE để xóa bản ghi
        $delete_sql = "DELETE FROM user WHERE id = '$id'";
        if ($mysqli->query($delete_sql) === TRUE) {
            echo "Người dùng này đã được xóa bỏ";
            echo "<div class='button'><a href='javascript: history.go(-1)'>Trở lại</a></div>";
        } else {
            echo "Lỗi xóa bản ghi: ";
        }   
    }else 
            echo "Không xóa được bản ghi";

    $mysqli->close();
?>