
<?php
 $sql_danhmuc = "SELECT * FROM danhmuc ORDER BY id_danhmuc DESC";
 $query_danhmuc = mysqli_query($mysqli,$sql_danhmuc );
 if(isset($_SESSION['email'])){
    $email=$_SESSION['email'];
 } else {
    $email= "";
 }
?>
<?php
    if(isset($_GET['dangxuat']) && $_GET['dangxuat']==1){
        unset($_SESSION['email']);
        unset($_SESSION['dangky']);
        unset($_SESSION['dangnhap']);
        unset($_SESSION['id_khachhang']);
        unset($_SESSION['id_user']);
       // session_unset();
        header('Location:index.php');
        // unset($_SESSION['dangky']);
        // unset($_SESSION['email']);
    }
    
?>

 
<div class="menu">
    <ul class="list-menu">
        <li><a href="index.php">Trang chủ</a></li>
    <?php
        while($row_danhmuc=mysqli_fetch_array($query_danhmuc)){
    ?>
        <li><a href="index.php?quanly=danhmucbaohiem&id=<?php echo $row_danhmuc['id_danhmuc']  ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></a></li>
        <?php
     }
     ?>
        <li><a href="index.php?quanly=tintuc">Tin tức</a></li>
        <li><a href="index.php?quanly=giohang">Giỏ hàng</a></li>
        <?php
            if(isset($_SESSION['dangnhap']) ){
        ?>
        <li><a href="index.php?quanly=tuvan">Tư vấn</a></li>
        <li><a href="index.php?quanly=dangxuat&dangxuat=1">Đăng xuất</a></li>
        <?php
            }else{
        ?>
        <li><a href="index.php?quanly=dangky">Đăng ký</a></li>
        <?php
            }
        ?>  
       
    </ul>
    
    <p class="menu-search">
        <form action="index.php?quanly=timkiem" method="POST">
        <input type="text" placeholder="Tìm bảo hiểm..." name="tukhoa" id="" style="width: 50%; height: 20px;"> 
        <input style=" background-color: rgba(0,0,0,0);" name="timkiem" type="submit" value="&#xf002; Search" class="submit-button"> 
        </form> 
    </p>
            
    <p class="menu-account">
            <form action="index.php?quanly=thongtin&email=<?php echo $email ?>" method="POST">
            <input style="background-color: rgba(0,0,0,0);" name="thongtin" type="submit" value="&#xf007; Account" class="account-button"> 
            </form> 
    
    </p>
    
    <div class="clear"></div>
    
</div>
