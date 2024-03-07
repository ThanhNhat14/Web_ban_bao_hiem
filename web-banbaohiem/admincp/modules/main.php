<div class="clear"></div>
<div class="main">
<?php
 if(isset($_GET['action']) && $_GET['query']){
    $tam=$_GET['action'];
    $query=$_GET['query'];
}
else{
    $tam='';
    $query='';
}
if($tam=='hopthu'&& $query=='?'){
    include("../admincp/tuvan/hopthu.php");
}
else if($tam=='hopdong' && $query=='?'){
    include("../admincp/hopdong/hopdong.php");
}
else if($tam=='dangnhap_admin'&& $query=='dangnhap'){
    include("dangnhap_admin/dangnhap.php");
}
else if($tam=='dangxuat'&& $query=='?'){
    include("dangnhap_admin/session.php");
}
else if($tam=='doimatkhau'&& $query=='?'){
    include("dangnhap_admin/doimatkhau.php");
}
// else if($tam=='quanlydanhmucbaohiem' && $query=='them'){
//   include("modules/quanlydanhmucbh/lietke.php");
//   include("modules/quanlydanhmucbh/them.php");
// }
// else if($tam=='quanlydanhmucbaohiem' && $query=='sua'){
//   include("modules/quanlydanhmucbh/sua.php");
// }
else if($tam=='quanlybaohiem' && $query=='?'){
  include("quanlybh/lietke.php");
  include("quanlybh/them.php");
}
// else if($tam=='quanlybaohiem' && $query=='sua'){
//   include("quanlybh/sua.php");
// }
else if($tam=='quanlyuser' && $query=='?'){
  include("../admincp/quanlyuser/lietke.php");
}
else{
  include("modules/dashboard.php");
}
    ?>
</div>