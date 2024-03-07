<div id="main">
         <?php
            include("sidebar/sidebar.php");
         ?>
            <div class="maincontent">
              <?php
                if(isset($_GET['quanly'])){
                    $tam=$_GET['quanly'];
                }
                else{
                    $tam='';
                }
                if($tam=='danhmucbaohiem'){
                  include("main/danhmuc.php");
                }else if($tam=='giohang'){
                    include("main/giohang.php");
                }
                else if($tam=='baohiem'){
                 include("main/baohiem.php");
                }
                else if($tam=='tintuc'){
                  include("main/tintuc.php");
                }
                else if($tam=='tuvan'){
                  include("main/tuvan.php");
                }
                else if($tam=='timkiem'){
                  include("main/timkiem.php");
                 }
                else if($tam=='dangky'){
                  include("main/dangky.php");
                }
                else if($tam=='dangnhap'){
                  include("main/dangnhap.php");
                }
                else if($tam=='thanhtoan'){
                  include("main/thanhtoan.php");
                }
                else if($tam=='camon'){
                  include("main/camon.php");
                }
                else if($tam=='thongtin'){
                  include("main/thongtin.php");
                 }
                 else if($tam=='suadienthoai'){
                  include("main/suadienthoai.php");
                 }
                else{
                  include("main/index.php");
                }
              ?>
            </div>
            <div class="clear"></div>
        </div>