<?php
session_start();
require_once '../config/config.php';
if(!isset($_SESSION['admin'])){
    exit();
}
// Lấy id_baohiem từ yêu cầu gửi đến
$id_baohiem = $_GET['id_baohiem'];

// Câu truy vấn SQL để lấy bản ghi từ bảng chinhsach
$sql = "SELECT * FROM chinhsach WHERE id_baohiem = '$id_baohiem'";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_assoc($result);

// Đóng kết nối
mysqli_close($mysqli);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Chỉnh sửa chính sách bảo hiểm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        h1 {
            color: #333333;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            max-width: 500px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333333;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            margin-bottom: 20px;
            background-color: #f8f8f8;
            color: #333333;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    
    <form method="POST" action="update_chinhsach.php" enctype="multipart/form-data">
        <h1 style="color: green;">Cập nhật chính sách bảo hiểm</h1>
        <input type="hidden" name="id_baohiem" value="<?php echo $row['id_baohiem']; ?>">

        <label for="ten_baohiem">Tên bảo hiểm:</label>
        <input type="text" name="ten_baohiem" value="<?php echo $row['ten_baohiem']; ?>" required><br>

        <label for="gia_baohiem">Giá bảo hiểm:</label>
        <input type="text" name="gia_baohiem" value="<?php echo $row['gia_baohiem']; ?>" required><br>

        <label for="hinhanh">Hình ảnh:</label>
        <img src="http://localhost/web-banbaohiem/admincp/quanlybh/uploads/<?php echo $row['hinhanh']; ?>" alt="Hình ảnh">
        <input type="file" name="hinhanh">

        <label for="mota">Mô tả:</label>
        <textarea name="mota" required><?php echo $row['mota']; ?></textarea><br>

        <label for="ttt">Tuổi tối thiểu tham gia:</label>
        <input type="text" name="ttt" value="<?php echo $row['ttt']; ?>" required><br>

        <label for="ttd">Tuổi tối đa tham gia:</label>
        <input type="text" name="ttd" value="<?php echo $row['ttd']; ?>" ><br>

        <label for="tgck">Thời gian chu kỳ (năm):</label>
        <input type="text" name="tgck" value="<?php echo $row['tgck']; ?>" required><br>

        <label for="id_danhmuc">ID danh mục:</label>
        <input type="text" name="id_danhmuc" value="<?php echo $row['id_danhmuc']; ?>" required><br>

        <input type="submit" value="Lưu">
    </form>
</body>
</html>