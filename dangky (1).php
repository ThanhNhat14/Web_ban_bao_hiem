<?php
    
    if(isset($_POST['dangky'])){
        $ten_user=$_POST['ten_user'];
        $email=$_POST['email'];
        $diachi=$_POST['dia_chi'];
        $matkhau=$_POST['matkhau'];
        $xacnhan_matkhau=$_POST['xacnhan_matkhau'];
        $gioitinh=$_POST['gioitinh'];
        $ngaysinh=$_POST['ngaysinh'];
        $nghenghiep=$_POST['nghenghiep'];
        $dienthoai=$_POST['dienthoai'];
      
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Kiểm tra xem mật khẩu và xác nhận lại mật khẩu có giống nhau hay không
            if ($matkhau === $xacnhan_matkhau) {
                // Mật khẩu đã được xác nhận
                $isRegistered = true;
                if ($isRegistered) {
                    echo "<script>alert('Đăng ký thành công!');</script>";
                    echo '<script>setTimeout(function() { window.location.href = "index.php?quanly=dangnhap"; },0);</script>';
                }
                $sql_dangky= mysqli_query($mysqli, "INSERT INTO user(ten_user,email,dia_chi,matkhau,xacnhan_matkhau,gioitinh,ngaysinh,nghenghiep,dienthoai) 
                VALUE('".$ten_user."','".$email."','".$diachi."','".$matkhau."','".$xacnhan_matkhau."','".$gioitinh."','".$ngaysinh."','".$nghenghiep."','".$dienthoai."')");
                    if($sql_dangky){
                    $_SESSION['dangky']=$ten_user;
                    $_SESSION['id_khachhang']= mysqli_insert_id($mysqli);
                    }
            } 
            else {
                // Mật khẩu và xác nhận lại mật khẩu không giống nhau
                echo'<h3 style="color:red;">Mật khẩu và xác nhận lại mật khẩu không khớp!</h3>';   
                
            }
        } 
        
    }
?>
<h3 style="text-align: center;">ĐĂNG KÝ TÀI KHOẢN</h3>
<form action="" method="POST">
    <table class="dangky"  style="border-collapse:collapse ; width: 40%;">
       <tr>
           <td>Họ và tên</td>
           <td><input type="text" size="300px" name="ten_user"></td>
       </tr>
       <tr>
           <td>Email</td>
           <td><input type="email" size="300px" name="email"></td>
       </tr>
       <tr>
           <td>Địa chỉ</td>
           <td><input type="text" size="300px" name="dia_chi"></td>
        </tr>
        <tr>
           <td><label for="password">Mật khẩu:</label></td>
           <td><input type="password"  size="300px" id="password" name="matkhau" required></td>
       </tr>

       <tr>
           <td> <label for="confirm_password">Xác nhận lại mật khẩu:</label></td>
           <td> <input type="password" id="confirm_password" name="xacnhan_matkhau" required></td>
       </tr>
       <tr>
           <td>Giới tính</td>
           <td><input type="text" size="300px" name="gioitinh"></td>
       </tr>
       <tr>
           <td>Ngày sinh</td>
           <td>
               <label for="date-input"></label>
               <input type="date" id="date-input" name="ngaysinh">
           </td>
           
       </tr>
       <tr>
            <td>Nghề nghiệp</td>
            <td><input type="text" size="300px" name="nghenghiep"></td>
        </tr>
        <tr>
            <td>Điện thoại</td>
            <td><input type="text" size="300px" name="dienthoai"></td>
        </tr>
       
       <tr>
           <td >
            <input type="submit" name="dangky" value="Đăng ký">
            
          </td>
           <td><a href="index.php?quanly=dangnhap"><input type="button" value="Đăng nhập"></a></td>
        </tr>
    </table>
</form>