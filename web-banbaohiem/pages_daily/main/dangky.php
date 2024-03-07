<?php
    
    if(isset($_POST['dangky'])){
        // $mysqli= mysqli_connect('localhost', 'root', '', 'baohiem') or die('Không thể kết nối database');

        mysqli_set_charset($mysqli, 'UTF8');
    
        $ten_user = $_POST['ten_user'];
        $ngaysinh = $_POST['ngaysinh'];
        $gioitinh = $_POST['gioitinh'];
        $email= $_POST['email'];
        $matkhau = $_POST['matkhau'];
        $confirmPassword = $_POST['confirm_password'];
        $nghenghiep = $_POST['nghenghiep'];
        $dienthoai = $_POST['dienthoai'];
        $diachi = $_POST['dia_chi'];
    if($matkhau !== $confirmPassword) {
        // header("Location: index.php?quanly=dangky_user&error=passwordsDoNotMatch");
        echo "<script>alert('Đăng ký không thành công! Hãy kiểm tra lại mật khẩu!');</script>";
        echo '<script>setTimeout(function() { window.location.href = "index.php?quanly=dangky"; },0);</script>';     
        exit();
    } else {
        $sql = "SELECT email FROM user WHERE email = ?";
        $stmt = mysqli_stmt_init($mysqli); //Trả về, khởi tạo một đối tượng

        if (!mysqli_stmt_prepare($stmt, $sql)) { // Kiểm tra truy vấn SQL đã thành công hay chưa
            // header("Location: index.php?quanly=dangky_user&error=sqlerror1");
            echo "<script>alert('Đăng ký không thành công! Lỗi truy vấn dữ liệu!');</script>";
            echo '<script>setTimeout(function() { window.location.href = "index.php?quanly=dangky"; },0);</script>';
        
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email); 
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowCount = mysqli_stmt_num_rows($stmt); // trả về số bản ghi của $email

            if ($rowCount>0) {  //Tức email đã tồn tại
                // header("Location: index.php?quanly=dangky_user&error=emailtaken"); // username đã được sử dụng
                echo "<script>alert('Đăng ký không thành công! Email này đã tồn tại!');</script>";
                echo '<script>setTimeout(function() { window.location.href = "index.php?quanly=dangky"; },0);</script>';
                
                exit();
            } else {
                $sql = "INSERT INTO user (ten_user, email, dia_chi, matkhau, gioitinh, ngaysinh, nghenghiep, dienthoai) VALUES (?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($mysqli);
                $_SESSION['dangky']=$ten_user;
                $_SESSION['id_khachhang']= mysqli_insert_id($mysqli);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    // header("Location: index.php?quanly=dangky_user&error=sqlerror2");
                    echo "<script>alert('Đăng ký không thành công! Hãy kiểm tra lại!');</script>";
                    echo '<script>setTimeout(function() { window.location.href = "index.php?quanly=dangky"; },0);</script>';            
                    exit();
                } else {
                   // $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                   
                    mysqli_stmt_bind_param($stmt, "ssssssss", $ten_user, $email, $diachi, $matkhau, $gioitinh, $ngaysinh, $nghenghiep, $dienthoai);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    // header("Location: index.php?quanly=dangky_user&success=registered");
                    echo "<script>alert('Đăng ký thành công!');</script>";
                    echo '<script>setTimeout(function() { window.location.href = "index.php?quanly=dangnhap"; },0);</script>';
            
                    exit();
                }
            }
        }
       mysqli_stmt_close($stmt);
        mysqli_close($mysqli);
    }
    }
?>
<h3 style="text-align: center;">ĐĂNG KÝ TÀI KHOẢN</h3>
<form action="" autocomplete="off" method="POST">
    <table class="dangky"  style="border-collapse:collapse ; width: 40%;">
       <tr>
            <td>Họ và Tên</td>   
           <td><input type="text" name="ten_user"  size ="280px" placeholder="Tên khách hàng" ></td>
       </tr>
       <tr>
           <td>Ngày sinh</td>
           <td>
               <label for="date-input"></label>
               <input type="date" id="date-input"  style ="width: 210px;" placeholder="Ngày sinh" name="ngaysinh">
           </td>
           
       </tr>
       <tr>
            <td>Giới tính</td>
            <td>
                <select name="gioitinh" style ="width: 220px; height: 30px;" id="">
                    <option value="nam">Nam</option>
                    <option value="nu">Nữ</option>
                </select>     
            </td>
        </tr>
       <tr>
           <td>Email</td>
           <td><input type="email" size="300px" placeholder="E-mail" name="email"></td>
       </tr>

        <tr>
           <td><label for="password">Mật khẩu:</label></td>
           <td><input type="password"  size="300px" id="password" placeholder="Mật khẩu" name="matkhau" required></td>
       </tr>
       <tr>
           <td> <label for="confirm_password">Xác nhận lại mật khẩu:</label></td>
           <td> <input type="password" id="confirmpassword" placeholder="Xác nhận mật khẩu" name="confirm_password" required></td>
       </tr>
       <tr>
            <td>Điện thoại</td>
            <td><input type="text" size="300px" name="dienthoai"  pattern="^0\d{9}$" placeholder="Số điện thoại"></td>
        </tr>
        <tr>
            <td>Nghề nghiệp</td>
            <td><input type="text" size="300px" placeholder="Nghề nghiệp" name="nghenghiep"></td>
        </tr>
       <tr>
           <td>Địa chỉ</td>
           <td><input type="text" size="300px" placeholder="Địa chỉ" name="dia_chi"></td>
        </tr>
       <tr>
           <td >
            <input type="submit" name="dangky" value="Đăng ký">
            
          </td>
           <td><a href="index.php?quanly=dangnhap"><input type="button" value="Đăng nhập"></a></td>
        </tr>
    </table>
</form>