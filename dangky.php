<style>
    .dangky {
    width: 600px;
    margin: 10px auto;
    }
    input[type=text], input[type=password], input[type=date], input[type=email] {
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
<div>

<h1>Đăng ký khách hàng</h1>

<form class="dangky" action="" method="post">
  <input type="text" name="ten_user" size ="300px" placeholder="Tên khách hàng" ><br>
  Ngày sinh:
  <input type="date" id="date-input" name="ngaysinh" placeholder="Ngày sinh"><br>
  <!-- <input type="text" name="gioitinh" placeholder="Giới tính"><br> -->
  Giới tính:
  <select name="gioitinh" id="">
    <option value="nam">Nam</option>
    <option value="nu">Nữ</option>
  </select>
  <input type="email" name="email" placeholder="E-mail" ><br>
  <input type="password" name="matkhau" placeholder="Mật khẩu" ><br>
  <input type="password" name="confirmpassword" placeholder="Xác nhận mật khẩu" ><br>
  <input type="text" name="dienthoai" pattern="^0\d{9}$" placeholder="Số điện thoại" ><br>
  <input type="text" name="nghenghiep" placeholder="Nghề nghiệp" ><br>
  <input type="text" name="dia_chi" placeholder="Địa chỉ"><br>
  
  <input type="submit" class="button" name="dangky" value="Đăng ký" />
</form>
  <?php
    if (isset($_POST['dangky'])) {
        $conn = mysqli_connect('localhost', 'root', '', 'baohiem') or die('Không thể kết nối database');
      // require_once 'D:\xampp\htdocs\bh_ctdl\connect.php';

        mysqli_set_charset($conn, 'UTF8');
    
        $ten_user = $_POST['ten_user'];
        $ngaysinh = $_POST['ngaysinh'];
        $gioitinh = $_POST['gioitinh'];
        $email= $_POST['email'];
        $matkhau = $_POST['matkhau'];
        $confirmPassword = $_POST['confirmpassword'];
        $nghenghiep = $_POST['nghenghiep'];
        $dienthoai = $_POST['dienthoai'];
        $diachi = $_POST['dia_chi'];
    if($matkhau !== $confirmPassword) {
        header("Location: trangchu.php?quanly=dangky_user&error=passwordsDoNotMatch");
        exit();
    } else {
        $sql = "SELECT email FROM user WHERE email = ?";
        $stmt = mysqli_stmt_init($conn); //Trả về, khởi tạo một đối tượng

        if (!mysqli_stmt_prepare($stmt, $sql)) { // Kiểm tra truy vấn SQL đã thành công hay chưa
            header("Location: trangchu.php?quanly=dangky_user&error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email); 
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowCount = mysqli_stmt_num_rows($stmt); // trả về số bản ghi của $email

            if ($rowCount>0) {  //Tức email đã tồn tại
                header("Location: trangchu.php?quanly=dangky_user&error=emailtaken"); // username đã được sử dụng
                exit();
            } else {
                $sql = "INSERT INTO user (ten_user, email, dia_chi, matkhau, gioitinh, ngaysinh, nghenghiep, dienthoai) VALUES (?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: trangchu.php?quanly=dangky_user&error=sqlerror2");
                    exit();
                } else {
                   // $hashedPass = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "ssssssss", $ten_user, $email, $diachi, $matkhau, $gioitinh, $ngaysinh, $nghenghiep, $dienthoai);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    header("Location: trangchu.php?quanly=dangky_user&success=registered");
                    exit();
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
?>
</div>


