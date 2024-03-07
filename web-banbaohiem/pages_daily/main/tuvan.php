<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hộp thư tư vấn</title>
</head>
<body>
    <div class="container" >
        <h1>Câu hỏi tư vấn</h1>
        <h4>“ Mời bạn điền thông tin và gửi cho chúng tôi Các chuyên viên tư vấn của chúng tôi 
            sẽ trả lời bạn trong thời gian sớm nhất. Xin chân thành cảm ơn! ”</h4>
        <form action="" id="comment" method="post" autocomplete="off" >
            <style>
                input{
                    height: 30px;
                    margin-top: 15px;
                    margin-bottom: 15px;
                }
                textarea#comment {
                    margin-top: 15px;
                }               
            </style>
            <label for="name"></label>
            <input style="width: 579px;" type="text" name="name" id="name" placeholder="Họ & tên *" required>
            <br>
            <label for="email"></label>
            <input style="width: 579px;" type="email" name="email" id="email" placeholder="Email *"  required>
            <br>
            <label for="phone"></label>
            <input style="width: 579px;" pattern="^0\d{9}$" type="phone" name="phone" id="phone" placeholder="Điện thoại *" >
            <br>
            <label for="comment"></label>
            <textarea name="comment" id="comment" placeholder="Câu trả lời tư vấn của chúng tôi sẽ gửi đến mail hoặc số điện thoại của bạn trong vòng 24h" style="width: 581px; height: 160px; resize:none;" required></textarea>
            <br>
            <button type="submit" >Gửi</button>
        </form>
    </div>
</body>
</html>

<?php

$id ="";
$name = "";
$email = "";
$phone = "";
$comment = "";
$time ="";
//Lấy giá trị POST từ form vừa submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["name"])) { $name = $_POST['name']; }
    if(isset($_POST["email"])) { $email = $_POST['email']; }
    if(isset($_POST["phone"])) { $phone = $_POST['phone']; }
    if(isset($_POST["comment"])) { $comment = $_POST['comment']; }
    //Code xử lý, insert dữ liệu vào table
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $time = date("F j, Y, h:i a");
    $sql = "INSERT INTO tuvan (id, ten, email, phone, comment, time)
    VALUES ('$id', '$name', '$email', '$phone', '$comment','$time')";

    if (mysqli_query($mysqli, $sql)) {
         // Xóa dữ liệu đã gửi sau khi chèn vào cơ sở dữ liệu
         echo "<h4  style='color:green' > CẢM ƠN BẠN ĐÃ NHẬN XÉT. </h4>";
         echo "<h4 style='color:green'>CHÚNG TÔI SẼ LIÊN HỆ BẠN SAU...</h4>";
        unset($_POST['name']);
        unset($_POST['email']);
        unset($_POST['phone']);
        unset($_POST['comment']);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
    }
}
//Đóng database
mysqli_close($mysqli);
?>