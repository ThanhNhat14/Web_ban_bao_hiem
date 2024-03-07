<?php
    require_once('../config/config.php');
    $tenbaohiem = $_POST['ten_baohiem'];
    $giabh = $_POST['gia_baohiem'];
     //xử lý hình ảnh
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $hinhanh = time().'_'.$hinhanh;
    $mota = $_POST['mota'];
    $tuoitoithieu = $_POST['ttt'];
    $tuoitoida = $_POST['ttd'];
    $chuki = $_POST['tgck'];
    $danhmuc= $_POST['danhmuc'];

    if(isset($_POST['thembaohiem'])){
        //them
        // Tạo prepared statement
    $stmt = $mysqli->prepare("INSERT INTO chinhsach (ten_baohiem, gia_baohiem, hinhanh, mota, ttt, ttd, tgck, id_danhmuc) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Kiểm tra lỗi trong prepared statement
    if ($stmt === false) {
        die('Lỗi trong truy vấn SQL: ' . $mysqli->error);
    }

    // Gắn các giá trị vào các tham số trong prepared statement
    $stmt->bind_param("ssssiiii", $tenbaohiem, $giabh, $hinhanh, $mota, $tuoitoithieu, $tuoitoida, $chuki, $danhmuc);
    
    // Thực thi prepared statement
    $result = $stmt->execute();

    // Kiểm tra kết quả thực thi
    if ($result === false) {
        die('Lỗi trong truy vấn SQL: ' . $stmt->error);
    }
    // Di chuyển file ảnh tải lên vào thư mục
    move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
   // echo $hinhanh_tmp."uploads/".$hinhanh;
    // Chuyển hướng trang
    header("Location:../trangchu.php?action=quanlybaohiem&query=them&sussecUpload");
    }
    
    $mysqli->close();
    ?>