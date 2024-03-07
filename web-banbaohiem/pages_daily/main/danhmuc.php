<?php
//$sql_pro = "SELECT * FROM chinhsach WHERE chinhsach.id_danhmuc='$_GET[id]' ORDER BY id_baohiem DESC";
$sql_pro = "SELECT * FROM chinhsach AS CS JOIN danhmuc AS DM ON CS.id_danhmuc = DM.id_danhmuc WHERE CS.id_danhmuc='$_GET[id]' ORDER BY  CS.id_baohiem DESC";
$sql_pro1 = "SELECT * FROM danhmuc WHERE danhmuc.id_danhmuc ='$_GET[id]' LIMIT 1";
$query_pro = mysqli_query($mysqli,$sql_pro);
$query_pro1 = mysqli_query($mysqli,$sql_pro1);
$row_title = mysqli_fetch_array($query_pro1);
?>
<h3>Danh mục sản phẩm: <?php if(isset($row_title['tendanhmuc'])){
       echo $row_title['tendanhmuc'] ;
}else{
    echo 'Không  có dữ liệu';
} ?>
</h3>
                <ul class="list-pro">
                    <?php
                        while($row_pro = mysqli_fetch_array($query_pro)){
                    ?>
                    <li>
                        <a href="index.php?quanly=baohiem&id=<?php echo $row_pro['id_baohiem']?>">
                        <img src="admincp/quanlybh/uploads/<?php echo $row_pro['hinhanh'] ?>" alt="Bảo hiểm">
                            <p class="title-pro"> <?php echo $row_pro['ten_baohiem'] ?> </p>       
                            <p class="title-pro"> Giá: <?php echo number_format($row_pro['gia_baohiem'],0,',','.').'vnd'?> / Hạn: <?php echo $row_pro['tgck'] ?> năm </p>       
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
