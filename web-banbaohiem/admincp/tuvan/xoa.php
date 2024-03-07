<?php
session_start();
require_once '../config/config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        h2 {
            color: #333;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }

        .button {
            margin-top: 10px;
        }

        .button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        .button a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $del = "DELETE FROM tuvan WHERE id = $id";
            if (mysqli_query($mysqli, $del)) {
                echo "<h2 class='success'>Xóa bản ghi thành công.</h2>";
                echo "<div class='button'><a href='javascript: history.go(-1)'>Trở lại</a></div>";
            } else {
                echo "<h2 class='error'>Lỗi: " . mysqli_error($mysqli) . "</h2>";
            }
        } else {
            echo "<h2 class='error'>Không xóa được bản ghi</h2>";
        }
        mysqli_close($mysqli);
        ?>
    </div>
</body>
</html>
