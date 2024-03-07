<?php
    session_start();
    if (isset($_SESSION['admin'])){
        unset($_SESSION['admin']); // xóa session login
        header("Location: ../admincp/trangchu.php");
    }else
    echo "Kha";
?>