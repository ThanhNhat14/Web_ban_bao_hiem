<?php
    if(isset($_POST['dangnhap'])){
        $email = $_POST['email'];
        $_SESSION['email']= $email;
        $matkhau = $_POST['matkhau'];
        $sql = "SELECT * FROM user WHERE email='".$email."' AND matkhau='".$matkhau."' LIMIT 1";
        $row = mysqli_query($mysqli,$sql);
        $sqlId = "SELECT id FROM user WHERE email='".$email."' ";
        $queryId = mysqli_query($mysqli,$sqlId);
        $rowId= mysqli_fetch_array($queryId);
        $count = mysqli_num_rows($row);
        if($count >0){
            $row_data=mysqli_fetch_array($row);
            $_SESSION['dangky']=$row_data['ten_user'];
            $_SESSION['dangnhap']=true;
            $_SESSION['id_khachhang']=$row_data['id'];
            $_SESSION['id_user']= $rowId;
            echo "<script>alert('Đăng nhập thành công!');</script>";
            echo '<script>setTimeout(function() { window.location.href = "index.php"; }, 0);</script>';
        }
        else{
            echo '<h3 style="font-style: italic;"> Tài khoản hoặc mật khẩu không đúng. Vui lòng nhập lại!</h3>';
           
        }
    }
?>
  <form action="" autocomplete="" method="POST">    
    <table class="table-login" style="width: 60%; text-align: center; border-collapse: collapse;" >
        <tr>
            <td colspan="2"><h3>Đăng Nhập Tài Khoản</h3></td>
        </tr>
        <tr>
            <td>Tài khoản</td>
           <td> <input type="text" placeholder="Email..."  name="email" id="" ></td>
        </tr>
        <tr>
            <td>Mật khẩu</td>
            <td><input type="password" placeholder="Password..."  name="matkhau" id=""></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="dangnhap" value="Đăng nhập"></td>
        </tr>
    </table>
    </form>