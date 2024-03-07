<?php
    session_start();
    include("../../admincp/config/config.php");
    $id_khachhang=$_SESSION['id_khachhang'];
    $code_order=rand(0,9999);
    $insert_cart ="INSERT INTO tb_cart(id,code_cart,cart_status) VALUE ('".$id_khachhang."','".$code_order."',1)";
    $cart_query = mysqli_query($mysqli,$insert_cart);
    if($cart_query){
        //thêm giỏ hàng chi tiết
        foreach($_SESSION['cart'] as $key => $value ){
            $id_baohiem=$value['id'];
            $soluong = $value['soluong'];
            $ten_baohiem =$value['ten_baohiem'];
            $insert_order_details="INSERT INTO tb_cart_detail(code_cart,id_baohiem,soluong)
             VALUE ('".$code_order."','".$id_baohiem."','".$soluong."')";
            mysqli_query($mysqli,$insert_order_details);
         }
         $sql_hopdong = "SELECT tb_cart_detail.id_baohiem, chinhsach.ten_baohiem, user.ten_user, user.gioitinh, user.ngaysinh, 
                        user.nghenghiep, chinhsach.tgck, chinhsach.id_danhmuc, user.dia_chi 
               FROM tb_cart_detail
               JOIN chinhsach ON chinhsach.id_baohiem = tb_cart_detail.id_baohiem
               JOIN user ON user.id = '$id_khachhang'
               JOIN tb_cart ON tb_cart.code_cart = tb_cart_detail.code_cart
               WHERE tb_cart.id = '$id_khachhang'";   

        $query_hopdong = mysqli_query($mysqli, $sql_hopdong);
        $insuranceIds = array(); // Mảng để theo dõi các id_baohiem đã được chèn vào bảng hopdong

        while ($row_hopdong = mysqli_fetch_array($query_hopdong)) {
            $id_baohiem = $row_hopdong['id_baohiem'];
        
            // Kiểm tra xem bảo hiểm đã tồn tại trong hopdong chưa
            $check_existing_query = "SELECT * FROM hopdong WHERE id_baohiem = '$id_baohiem' AND id_user = '$id_khachhang'";
            $check_existing_result = mysqli_query($mysqli, $check_existing_query);
        
            if (mysqli_num_rows($check_existing_result) == 0) {
                // Bảo hiểm chưa tồn tại trong hopdong, tiến hành chèn
                $insert_hopdong = "INSERT INTO hopdong (id_baohiem, ten_baohiem, soluong, id_user, ten_khachhang, 
                gioitinh, ngaysinh, nghenghiep, diachi, thoihan_baohiem, trangthai)
                VALUES ('$id_baohiem', '{$row_hopdong['ten_baohiem']}', '$soluong', 
                '$id_khachhang', '{$row_hopdong['ten_user']}', '{$row_hopdong['gioitinh']}', '{$row_hopdong['ngaysinh']}', 
                '{$row_hopdong['nghenghiep']}', '{$row_hopdong['dia_chi']}','{$row_hopdong['tgck']}', '1')";
            mysqli_query($mysqli, $insert_hopdong);
            }
        }
    //     while ($row_hopdong = mysqli_fetch_array($query_hopdong)) {
    //     $id_baohiem = $row_hopdong['id_baohiem'];

    //     if (!in_array($id_baohiem, $insuranceIds)) {
    //     // Thêm ID bảo hiểm vào mảng
    //     $insuranceIds[] = $id_baohiem;

    //     // Tiến hành chèn bản ghi vào bảng hopdong
    //     $insert_hopdong = "INSERT INTO hopdong (id_baohiem,id_user ,ten_baohiem, ten_khachhang, gioitinh, ngaysinh, nghenghiep, thoihan_baohiem)
    //                        VALUES ('$row_hopdong[id_baohiem]','".$id_khachhang."', '$row_hopdong[ten_baohiem]', '$row_hopdong[ten_user]', '$row_hopdong[gioitinh]', '$row_hopdong[ngaysinh]', '$row_hopdong[nghenghiep]', '$row_hopdong[tgck]')";
    //     mysqli_query($mysqli, $insert_hopdong);
    //     }
    // }

        //  $sql_hopdong = "SELECT * FROM chinhsach,user,tb_cart_detail,tb_cart WHERE chinhsach.id_baohiem = tb_cart_detail.id_baohiem AND tb_cart.code_cart=tb_cart_detail.code_cart
        //   AND user.id=$id_khachhang" ;
        //  $query_hopdong =mysqli_query($mysqli,$sql_hopdong); 
        //  $insuranceIds = array();
        //  while($row_hopdong=mysqli_fetch_array($query_hopdong)){
        //     $id_baohiem = $row_hopdong['id_baohiem'];
        //     if (!in_array($id_baohiem, $insuranceIds)) {
        //         // Thêm ID bảo hiểm vào mảng
        //         $insuranceIds[] = $id_baohiem;
        
        //         $insert_hopdong = "INSERT INTO hopdong (id_baohiem, ten_baohiem, ten_khachhang, gioitinh, ngaysinh, nghenghiep, thoihan_baohiem)
        //                            VALUES ('$row_hopdong[id_baohiem]', '$row_hopdong[ten_baohiem]', '$row_hopdong[ten_user]', '$row_hopdong[gioitinh]', '$row_hopdong[ngaysinh]', '$row_hopdong[nghenghiep]', '$row_hopdong[tgck]')";
        //         mysqli_query($mysqli, $insert_hopdong);
        //     }
        // //     $insert_hopdong="INSERT INTO hopdong(id_baohiem,ten_baohiem,ten_khachhang,gioitinh,ngaysinh,nghenghiep,thoihan_baohiem)
        // //     VALUE ('$row_hopdong[id_baohiem]','$row_hopdong[ten_baohiem]','$row_hopdong[ten_user]','$row_hopdong[gioitinh]','$row_hopdong[ngaysinh]',
        // //   ' $row_hopdong[nghenghiep]','$row_hopdong[tgck]')";
        // //     mysqli_query($mysqli,$insert_hopdong);
      
        //  }
  
    }
   
    unset($_SESSION['cart']);
    header('Location:../../index.php?quanly=camon');
?>
