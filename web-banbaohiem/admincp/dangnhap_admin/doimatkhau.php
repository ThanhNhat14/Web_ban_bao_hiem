<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu admin</title>
    <style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
		}

		h1 {
			text-align: center;
			margin-top: 50px;
		}

		form {
			width: 300px;
			margin: 0 auto;
			background-color: #fff;
			padding: 20px;
			border: 1px solid #ccc;
			border-radius: 5px;
			margin-top: 20px;
		}

		input[type="password"] {
			width: 100%;
			padding: 10px;
			margin-bottom: 10px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
		}

		input[type="submit"] {
			width: 100%;
			padding: 10px;
			background-color: #4CAF50;
			color: #fff;
			border: none;
			border-radius: 4px;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-color: #45a049;
		}
	</style>
</head>
<body>
	<h1>Đổi mật khẩu admin</h1>
	<form action="" method="POST">
		Mật khẩu hiện tại:
		<input type="password" id="oldpassword" name="oldpassword" placeholder="Mật khẩu hiện tại"><br>

		Mật khẩu mới:
		<input type="password" id="newpassword" name="newpassword" placeholder="Mật khẩu mới"><br>

		Xác nhận mật khẩu mới:
		<input type="password" id="confirmpassword" name="confirmpassword" placeholder="Xác nhận mật khẩu mới"><br>

		<input type="submit" value="Thay đổi mật khẩu" name="submit">
<?php

if (empty($_SESSION['admin'])) {
    header('Location: ../admincp/trangchu.php');
    exit();
}

if (isset($_POST['submit'])) {
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];
    if (!$oldpassword || !$newpassword || !$confirmpassword) {
        echo "Vui lòng nhập đầy đủ mật khẩu.";
        //<a href='javascript: history.go(0)'>Trở lại</a>";
        exit;
    }
    // Kiểm tra mật khẩu cũ
//    $mysqli = mysqli_connect('localhost', 'root', '', 'baohiem') or die('Không thể kết nối database');
    $username = $_SESSION['admin'];
    $query = "SELECT password FROM admin WHERE username='$username'";
    $result = mysqli_query($mysqli, $query);
    $row = mysqli_fetch_array($result);
    $matkhau = $row['password'];
    if ($oldpassword == $matkhau) {    
        // Mật khẩu cũ đúng, thực hiện thay đổi mật khẩu mới
        if ($newpassword == $confirmpassword) {
            $update_query = "UPDATE admin SET password='$newpassword' WHERE username='$username'";
            mysqli_query($mysqli, $update_query);

            // Đăng xuất người dùng và chuyển hướng đến trang đăng nhập
            session_destroy();
            header('Location: ../admincp/trangchu.php?changepassword=success');
            exit();
        } else {
            //$error_message = "Xác nhận mật khẩu mới không chính xác!";
            echo "Xác nhận mật khẩu mới không chính xác!";
        }
    } else {
        //$error_message = "Mật khẩu cũ không đúng!";
        echo "Mật khẩu cũ không đúng!";
    }
}
?>
	</form>
</body>
</html>
