<?php
    require_once('../config/config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $id_baohiem = $_POST['id_baohiem'];
    $ten_baohiem = $_POST['ten_baohiem' ];
    $gia_baohiem = $_POST['gia_baohiem'];
    // $hinhanh = $_FILES['hinhanh']['name'];
    // $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    // $hinhanh = time().'_'.$hinhanh;
    $mota = $_POST['mota'];
    $ttt = $_POST['ttt'];
    $ttd = $_POST['ttd'];
    $tgck = $_POST['tgck'];
    $id_danhmuc = $_POST['id_danhmuc'];
    
    $sql = "SELECT hinhanh FROM chinhsach WHERE id_baohiem = '$id_baohiem'";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($_FILES['hinhanh']['name'] !== '') {
        $hinhanh = $_FILES['hinhanh']['name'];
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $hinhanh = time().'_'.$hinhanh;
        move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
    } else {
        // Không có tệp tin mới, giữ nguyên giá trị của trường hinhanh trong cơ sở dữ liệu
        $hinhanh = $row['hinhanh'];
    }

    $update = "UPDATE chinhsach SET ten_baohiem = '$ten_baohiem', gia_baohiem = '$gia_baohiem', hinhanh ='$hinhanh',
    mota ='$mota', ttt ='$ttt', ttd ='$ttd', tgck = '$tgck', id_danhmuc ='$id_danhmuc' WHERE id_baohiem = '$id_baohiem'";
    if($mysqli->query($update) === TRUE){
       // move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);
        header('Location: http://localhost/web-banbaohiem/admincp/trangchu.php?action=quanlybaohiem&query=?&updateSuccess');
    }
    else{
        echo "Lỗi truy vấn: " . $mysqli->error;
    }
    $mysqli->close();
}
?>