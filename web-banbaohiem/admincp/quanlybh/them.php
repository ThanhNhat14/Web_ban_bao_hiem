<?php
  if(!isset($_SESSION['admin'])){
    exit();
  }
?>
<h4 class="title-them">THÊM BẢO HIỂM</h4>
<table class="table-css" style="width: 50%; padding: 10px; border-collapse: collapse;"border="1px">
<form action="quanlybh/them_bh.php" method="POST" enctype="multipart/form-data">
<tr>
    <td>Tên bảo hiểm</td>
    <td ><input type="text" name="ten_baohiem" required></td>
  </tr>
  <tr>
    <td>Giá bảo hiểm</td>
    <td><input type="text" name="gia_baohiem" required></td>
  </tr> 
  <tr>
    <td>Hình ảnh</td>
    <td><input type="file" name="hinhanh" required></td>
  </tr> 
  <tr>
    <td>Mô tả</td>
    <td><textarea name="mota" id="" cols="30" rows="10" style="width: 319px; height: 172px;"></textarea></td>
  </tr> 
  <tr>
    <td>Tuổi tối thiểu để mua</td>
    <td><input type="text" name="ttt" required></td>
  </tr>
  <tr>
    <td>Tuổi tối đa để mua</td>
    <td><input type="text" name="ttd" ></td>
  </tr>
  <tr>
    <td>Chu kì bảo hiểm</td>
    <td><input type="text" name="tgck" ></td>
  </tr>
  <tr>
    <td>Danh mục bảo hiểm</td>
    <td>
      <select name="danhmuc" id="" required>
      <?php
      $sql_danhmuc = "SELECT * FROM danhmuc ORDER BY id_danhmuc DESC";
      $query_danhmuc = mysqli_query($mysqli,$sql_danhmuc );
       while($row_danhmuc=mysqli_fetch_array($query_danhmuc)){
       ?>
         <option value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
       <?php
      }
      ?>
      </select>
    </td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="thembaohiem" value="Thêm bảo hiểm"></td>
  </tr>
</form>
</table>
