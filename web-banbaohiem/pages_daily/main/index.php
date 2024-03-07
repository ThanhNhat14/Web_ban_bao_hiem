<?php
$sql_pro = "SELECT * FROM chinhsach,danhmuc WHERE chinhsach.id_danhmuc= danhmuc.id_danhmuc ORDER BY chinhsach.id_baohiem DESC LIMIT 21";
$query_pro = mysqli_query($mysqli, $sql_pro);
 
?>
<h3>Sản phẩm mới:</h3>
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
                    ?>
                   
                </ul>