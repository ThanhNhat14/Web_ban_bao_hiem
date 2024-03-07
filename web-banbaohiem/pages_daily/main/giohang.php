
<h2 style="text-align: center; color: red; font-style: italic;">Bảo Hiểm Của
<?php
    if(isset($_SESSION['dangky'])){
       echo ' '.$_SESSION['dangky'];
    } else
    echo "Khách";
?>
</h2>

<table class="tb-giohang">
  <tr>
    <th style="width: 15px;">Id</th>
    <th>Tên Bảo Hiểm</th>
    <th style="width: 150px;">Hình ảnh</th>
    <th>Số lượng</th>
    <th>Giá</th>
    <th style="width: 150px;">Thành tiền</th>
    <th>Quản lý</th>
  </tr>
<?php
    if(isset($_SESSION['cart'])){
        $i=0;
        $tongtien=0;
      foreach($_SESSION['cart'] as $cart_item){
        $thanhtien= $cart_item['soluong']*$cart_item['gia_baohiem'];
        $tongtien+=$thanhtien;
        $i++;
?>
  <tr>
    <td><?php echo $i ?></td>
    <td><?php echo $cart_item['ten_baohiem'] ?></td>
    <td><img src="admincp/quanlybh/uploads/<?php echo $cart_item['hinhanh'] ?>" width="150px" alt=""></td>
    <td >
        <a href="pages_daily/main/denhopdong.php?tru=<?php echo $cart_item['id'] ?>"><i class="fa-solid fa-minus"></i></a>
        <?php echo $cart_item['soluong'] ?>
        <a href="pages_daily/main/denhopdong.php?cong=<?php echo $cart_item['id'] ?>"><i class="fa-solid fa-plus"></i></a>

    </td>
    <td><?php echo number_format($cart_item['gia_baohiem'],0,',','.').'vnd'; ?></td>
    <td><?php echo number_format($thanhtien,0,',','.').'vnd'; ?></td>
    <td><a href="pages_daily/main/denhopdong.php?xoa=<?php echo $cart_item['id'] ?>"><input type="button" value="Xóa"></a></td>
  </tr>
  <?php
      }
  ?>
   <tr>
    <td colspan="7">
        <h4>Tổng tiền: <?php echo number_format($tongtien,0,',','.').'vnd';?></h4><br/>
        <a href="pages_daily/main/denhopdong.php?xoatatca=1">
        <input type="button" value="Xóa tất cả"></a>
        <?php
          if(isset($_SESSION['dangky'])){
        ?>
        
        <a href="pages_daily/main/thanhtoan.php"><input type="button" value="Đặt Hàng"></a>
        <?php
          }else{
        ?>
        <p> <a href="index.php?quanly=dangky"><input type="button" value="Đăng Ký Đặt Hàng"></a></p>
        <?php
          }
        ?>
      </td>
  </tr>
  <?php

    }else{
  ?>
  <tr>
    <td colspan="7"><p>Hiện tại chưa có bảo hiểm sẵn sàng mua của bạn!</p></td>
   
  </tr>
  <?php
    }
  ?>
  
</table>