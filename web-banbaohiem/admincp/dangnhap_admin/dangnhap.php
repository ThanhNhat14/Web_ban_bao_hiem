<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
</head>
<style>
    .dangnhap {
    width: 600px;
    margin: 10px auto;
    }
    input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    }
       
    .button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    }
       
    .button:hover {
    opacity: 0.8;
    }
</style>
<body>
    <?php
    if(empty($_SESSION['admin']))
    echo "
    <form action='' class='dangnhap' method='POST'>
        <h1>Đăng nhập admin</h1>
        Tên đăng nhập: <input type='text' name='username' placeholder='username'/>
        Mật khẩu: <input type='password' name='password' placeholder='password'/>
        <input type='submit' class='button' name='dangnhap' value='Đăng nhập' />
        ";
        ?>

        <?php 

    if (isset($_POST['dangnhap'])) {
    
    $username = addslashes($_POST['username']);
    $password = addslashes($_POST['password']);

    if (!$username || !$password) {
        echo "Vui lòng nhập đầy đủ tên đăng nhập hoặc mật khẩu.
        <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }

    $password = md5($password);

    // Sử dụng câu truy vấn có tham số để tránh lỗ hổng bảo mật SQL injection
    $query = "SELECT username, password FROM admin WHERE username = ?";
    $stmt = mysqli_stmt_init($mysqli);
    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);

            if ($password != md5($row['password'])) {
                echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
                exit;
            } else {
                $_SESSION['admin'] = $username;

                if (isset($_SESSION['admin'])) {
                  //  echo "<h2 class='success'>Xin chào <b>".$_SESSION['admin']."</b>. Bạn đã đăng nhập thành công!</h2>";
                    header('Location: ../admincp/trangchu.php');
                    exit();
                } else {
                    header("Location: dangnhap.php");
                    exit();
                }
            }
        } else {
            echo "Tên đăng nhập không tồn tại. Vui lòng nhập lại.";
        }
    } else {
        echo "Đã xảy ra lỗi. Vui lòng thử lại sau.";
    }
    mysqli_stmt_close($stmt);
    mysqli_close($mysqli);
}
?>
    </form>

</body>
</html>

