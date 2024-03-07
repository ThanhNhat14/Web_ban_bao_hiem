<?php
if(isset($_POST['timkiem'])){
    $tukhoa=$_POST['tukhoa'];
}
else{
    $tukhoa='';
}
$sql_pro = "SELECT * FROM chinhsach,danhmuc WHERE chinhsach.id_danhmuc=danhmuc.id_danhmuc AND chinhsach.ten_baohiem LIKE '%". $tukhoa."%'";
$query_pro = mysqli_query($mysqli, $sql_pro);

 
?>
<h3>Từ Khóa Tìm Kiếm: <?php echo $_POST['tukhoa'] ?> </h3>
                <ul class="list-pro">
                    <?php
                    while($row = mysqli_fetch_array($query_pro)){

                    ?>
                    <li>
                        <a href="index.php?quanly=baohiem&id=<?php echo $row['id_baohiem']?>">
                           <img src="admincp/quanlybh/uploads/<?php echo $row['hinhanh'] ?>" alt="">
                            <p class="title-pro" ><?php echo $row['ten_baohiem'] ?></p>       
                            <p class="title-pro"> Giá: <?php echo number_format($row['gia_baohiem'],0,',','.').'vnd'?> </p>       
                            <p class="title-pro">Thời hạn bảo hiểm: <?php echo $row['tgck'] ?> năm</p>   
                        </a>
                    </li>
                    <?php
                    }
                    if($query_pro->num_rows<1)
                        echo "Không có kết quả cần tìm";    
                    ?>
                   
                </ul>