<?php
    session_start();
    include("../../admincp/config/config.php");
    //trừ số lượng
    if(isset($_GET['tru'])){
        $id=$_GET['tru'];
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['id']!=$id){
                $product[]=array('ten_baohiem'=>$cart_item['ten_baohiem'],'id'=>$cart_item['id'],'gia_baohiem'=>$cart_item['gia_baohiem'], 'soluong'=>$cart_item['soluong'] ,'hinhanh'=>$cart_item['hinhanh']);
                $_SESSION['cart']=$product;
            }else{
                $tangsoluong=$cart_item['soluong']-1;
                if($cart_item['soluong']>1){
                $product[]=array('ten_baohiem'=>$cart_item['ten_baohiem'],'id'=>$cart_item['id'],'gia_baohiem'=>$cart_item['gia_baohiem'], 'soluong'=>$tangsoluong ,'hinhanh'=>$cart_item['hinhanh']);
                }
                else{
                $product[]=array('ten_baohiem'=>$cart_item['ten_baohiem'],'id'=>$cart_item['id'],'gia_baohiem'=>$cart_item['gia_baohiem'], 'soluong'=>$cart_item['soluong'],'hinhanh'=>$cart_item['hinhanh']);

                }
                $_SESSION['cart']=$product;
            }
        }
        header('Location:../../index.php?quanly=giohang');

    }
    //cộng số lượng
    if(isset($_GET['cong'])){
        $id=$_GET['cong'];
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['id']!=$id){
                $product[]=array('ten_baohiem'=>$cart_item['ten_baohiem'],'id'=>$cart_item['id'],'gia_baohiem'=>$cart_item['gia_baohiem'], 'soluong'=>$cart_item['soluong'] ,'hinhanh'=>$cart_item['hinhanh']);
                $_SESSION['cart']=$product;
            }else{
                $tangsoluong=$cart_item['soluong']+1;
                if($cart_item['soluong']<10){
                $product[]=array('ten_baohiem'=>$cart_item['ten_baohiem'],'id'=>$cart_item['id'],'gia_baohiem'=>$cart_item['gia_baohiem'], 'soluong'=>$tangsoluong ,'hinhanh'=>$cart_item['hinhanh']);
                }
                else{
                $product[]=array('ten_baohiem'=>$cart_item['ten_baohiem'],'id'=>$cart_item['id'],'gia_baohiem'=>$cart_item['gia_baohiem'], 'soluong'=>$cart_item['soluong'],'hinhanh'=>$cart_item['hinhanh']);

                }
                $_SESSION['cart']=$product;
            }
        }
        header('Location:../../index.php?quanly=giohang');

    }
    //xoa bao hiem
    if(isset($_SESSION['cart'])&& isset($_GET['xoa'])){
        $id=$_GET['xoa'];
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['id']!=$id){
                $product[]=array('ten_baohiem'=>$cart_item['ten_baohiem'],'id'=>$cart_item['id'],'gia_baohiem'=>$cart_item['gia_baohiem'], 'soluong'=>$cart_item['soluong'],'hinhanh'=>$cart_item['hinhanh']);

            }
            $_SESSION['cart']=$product;
        header('Location:../../index.php?quanly=giohang');

        }
    }
    //Xóa tất cả
    if(isset($_GET['xoatatca'])&& $_GET['xoatatca']==1){
        unset($_SESSION['cart']);
        header('Location:../../index.php?quanly=giohang');

    }
    // session_destroy();
    //Thêm vào giỏ hàng
    if(isset($_POST['denhopdong'])){
        $id=$_GET['idbaohiem'];
        $soluong=1;
        $sql = "SELECT * FROM chinhsach WHERE id_baohiem='".$id."' LIMIT 1";
        $query =mysqli_query($mysqli,$sql);
        $row=mysqli_fetch_array($query);
        if($row){
            $new_product=array(array('ten_baohiem'=>$row['ten_baohiem'],'id'=>$id,'gia_baohiem'=>$row['gia_baohiem'], 'soluong'=>$soluong,'hinhanh'=>$row['hinhanh']));
            if(isset($_SESSION['cart'])){
                $found = false;
                foreach($_SESSION['cart'] as $cart_item){
                    //Nếu dữ liệu trùng
                    if($cart_item['id']==$id){
                        $product[]=array('ten_baohiem'=>$cart_item['ten_baohiem'],'id'=>$cart_item['id'],'gia_baohiem'=>$cart_item['gia_baohiem'], 'soluong'=>$soluong +1,'hinhanh'=>$cart_item['hinhanh']);
                        $found = true;
                    }else{
                        //dữ liệu k trùng
                        $product[]=array('ten_baohiem'=>$cart_item['ten_baohiem'],'id'=>$cart_item['id'],'gia_baohiem'=>$cart_item['gia_baohiem'], 'soluong'=> $cart_item['soluong'],'hinhanh'=>$cart_item['hinhanh']);
                    }
                }
                if($found == false){
                    //liên kết dữ liệu
                    $_SESSION['cart']=array_merge($product, $new_product);
                }
                else{
                    $_SESSION['cart']=$product;
                }
            }else{
                $_SESSION['cart']=$new_product;
            }
        }
        header('Location:../../index.php?quanly=giohang');
     } 

?>