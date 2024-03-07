<script>
            function confirmDelete(id) {
                if (confirm("Bạn có chắc chắn muốn xóa nội dung này không?")) {
                    window.location.href = "tuvan/xoa.php?id=" + id;
                }
            }
        </script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* body {
	background-image: url("https://bcp.cdnchinhphu.vn/334894974524682240/2023/4/17/bhnt-16817422143811377523842.jpg");
        }  */
        h2{
            width: 520px;
            margin: 25px 85px;
            height: 40px;
            padding: 0px 41px;
            color: goldenrod;
            border:#94deed;
            font-size: 45px;
        }
        .container {
            max-width: 600px;
            margin: -19px auto;
            padding: 21px;
        }

        .record {
            background-color: #94deed;
            padding: 10px;
            margin-bottom: 10px;
        }

        .record h3 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        .record p {
            margin: 5px 0;
            color: #666;
        }

        .delete-button {
            background-color: #ff0000;
            color: #fff;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .delete-button:hover {
            background-color: #cc0000;
        }
    </style>
    <title>Hộp thư tư vấn</title>
</head>
<body>
    <div class="container">
        <h2>Hộp thư tư vấn</h2>
      
        <?php
           // session_start();
          //  require_once '../config/config.php';
            if(isset($_SESSION['admin'])){
            $sql = "SELECT id, ten, email, phone, comment, time from tuvan";
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                // Load dữ liệu lên website
                while($row = $result->fetch_assoc()) {
                    echo "<div class='record'>";
                    echo "<h3>Id: ".$row["id"]."</h3>";
                    echo "<p>Họ tên: " . $row["ten"]. "</p>";
                    echo "<p>Email: ". $row["email"]."</p>";
                    echo "<p>Số điện thoại: ".$row["phone"]."</p>";
                    echo "<p>Nội dung: ".$row["comment"]."</p>";
                    echo "<p>Vào lúc: ".$row["time"]."</p>";
                    echo "<button onclick='confirmDelete(".$row["id"].")' class='delete-button'>Xóa</button>";
                    echo "</div>";
                }
            }
        }
            $mysqli->close();
        ?>
    </div>
</body>
</html>