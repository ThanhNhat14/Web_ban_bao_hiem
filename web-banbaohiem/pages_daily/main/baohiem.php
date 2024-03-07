<h3>Chi tiết bảo hiểm</h3>
<?php
$email = $_SESSION['email'];
 $sql_chitiet = "SELECT * FROM chinhsach,danhmuc WHERE chinhsach.id_danhmuc= danhmuc.id_danhmuc 
 AND chinhsach.id_baohiem = '$_GET[id]' LIMIT 1";

 $sql_tuoi ="SELECT tuoi FROM user WHERE email ='$email' ";
 $query_tuoi = mysqli_query($mysqli, $sql_tuoi);
 $row = mysqli_fetch_array($query_tuoi);
 $tuoi = $row['tuoi'];
 $query_chitiet = mysqli_query($mysqli, $sql_chitiet);
    while($row_chitiet=mysqli_fetch_array($query_chitiet)){
?>
<div class="wrapper_chitiet">
    <div class="hinhanh_bh">
        <img width="80%" src="admincp/quanlybh/uploads/<?php echo $row_chitiet['hinhanh'] ?>" alt="">
    </div>
    <form method="POST" action="pages_daily/main/denhopdong.php?idbaohiem=<?php echo $row_chitiet['id_baohiem']?>">
    <div class="chitiet_bh">
            <h3><?php echo $row_chitiet['ten_baohiem'] ?></h3>
            <p > Giá: <?php echo number_format($row_chitiet['gia_baohiem'],0,',','.').'vnd'?> </p>       
            <p>Danh mục bảo hiểm: <?php echo $row_chitiet['tendanhmuc'] ?></p>   
            <p>Thời hạn bảo hiểm: <?php echo $row_chitiet['tgck'] ?> năm</p>   
            <p>Tuổi tối thiểu để mua: <?php echo $row_chitiet['ttt'] ?></p>   
            <p>Tuổi tối đa để mua: <?php echo $row_chitiet['ttd'] ?></p>   
            <p>Mô tả: <?php echo $row_chitiet['mota'] ?></p>
            <?php
            if($tuoi<$row_chitiet['ttt']){
            ?>
            <p><input type="submit" disabled value="Bạn chưa đủ tuổi để đăng ký loại bảo hiểm này"></p>
            <?php
            }else if($row_chitiet['ttd'] !=0 && $tuoi>$row_chitiet['ttd']){
            ?>
                <p><input type="submit" disabled value="Bạn đã quá tuổi để đăng ký loại bảo hiểm này"></p>
                <?php
            }
            else{
            ?>
            <p><input type="submit" name="denhopdong" value="Đến hợp đồng"></p>
            <?php
            }
            ?>
        </div> 
    </form>     
</div>
<?php
 }
?>