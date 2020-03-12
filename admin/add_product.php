<?php
if(!defined('SECURITY')){
	die('nope');
}

// kiểm tra form
if(isset($_POST['sbm'])){
    $prd_name = $_POST['prd_name'];
    $prd_price = $_POST['prd_price'];
    $prd_warranty = $_POST['prd_warranty'];
    $prd_accessories = $_POST['prd_accessories'];
    $prd_promotion = $_POST['prd_promotion'];
    $prd_new = $_POST['prd_new'];

    $prd_image = $_FILES['prd_image']['name']; // lấy ra tên file 
    $prd_image_size =  $_FILES['prd_image']['size']; // lấy ra kích thước file  
    $tmp_name_img = $_FILES['prd_image']['tmp_name']; // lưu vào thư mục tạm
    //up ảnh len sever
    $imageFileType = pathinfo('img/'.$prd_image,PATHINFO_EXTENSION); // lấy phần mở rộng của file   
    $maxfilesize   = 1000000 ; //(bytes) giới hạn dung lượng 
    $allowtypes    = array('jpg', 'png'); //những file được up 
    $num_rows_img = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM product WHERE prd_image = '$prd_image'"));
    if($num_rows_img > 0){
       $prd_image = uniqid().'.'.$imageFileType;
    }
    if(!in_array($imageFileType, $allowtypes) ){
        $error = '<div class="alert alert-danger">Chỉ được up file jpg và png!</div>';
    }
    if($prd_image_size > $maxfilesize){
        $error = '<div class="alert alert-danger">Chỉ được upload ảnh dưới 300MB !</div>';
    }

    $cat_id = $_POST['cat_id'];
    $prd_status = $_POST['prd_status'];
    if(isset($_POST['prd_featured'])){
        $prd_featured = $_POST['prd_featured'];
    }else{
        $prd_featured = 0;
    }
    $prd_details = $_POST['prd_details'];

    // nếu không tồn tại biến $error thì thêm sản phẩm vào csdl
    if(!isset($error)){
        $sql = "INSERT INTO product(prd_name, prd_price, prd_warranty, prd_accessories, prd_promotion, prd_new, prd_image, cat_id, prd_status, prd_featured, prd_details) 
        VALUE('$prd_name','$prd_price','$prd_warranty','$prd_accessories','$prd_promotion','$prd_new','$prd_image','$cat_id','$prd_status','$prd_featured','$prd_details')";
        $query = mysqli_query($connect, $sql);

        // nếu thêm thành công thì chuyển hướng
        if(mysqli_affected_rows($connect) > 0){
            move_uploaded_file($tmp_name_img, 'img/'.$prd_image);
            header('location: index.php?page_layout=product');
        }
    }
}
$sql = "SELECT * FROM category ORDER BY  cat_id ASC";
$query = mysqli_query($connect , $sql);

?>
<script src = "ckeditor/ckeditor.js">  </script>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
                <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li><a href="">Quản lý sản phẩm</a></li>
				<li class="active">Thêm sản phẩm</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thêm sản phẩm</h1>
			</div>
        </div><!--/.row-->
        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-6">
                                <form role="form" method="post" enctype="multipart/form-data"> <!-- khi nào có upload thì có enctype -->
                                <div class="form-group">
                                    <label>Tên sản phẩm</label>
                                    <input required name="prd_name" class="form-control" placeholder="" value="<?php if(isset($_POST['prd_name'])){echo $_POST['prd_name'];} ?>">
                                </div>
                                                                
                                <div class="form-group">
                                    <label>Giá sản phẩm</label>
                                    <input required name="prd_price" type="number" min="0" class="form-control" value="<?php if(isset($_POST['prd_price'])){echo $_POST['prd_price'];} ?>">
                                </div>
                                <div class="form-group">
                                    <label>Bảo hành</label>
                                    <input required name="prd_warranty" type="text" class="form-control" value="<?php if(isset($_POST['prd_warranty'])){echo $_POST['prd_warranty'];} ?>">
                                </div>    
                                <div class="form-group">
                                    <label>Phụ kiện</label>
                                    <input required name="prd_accessories" type="text" class="form-control" value="<?php if(isset($_POST['prd_accessories'])){echo $_POST['prd_accessories'];} ?>">
                                </div>                  
                                <div class="form-group">
                                    <label>Khuyến mãi</label>
                                    <input required name="prd_promotion" type="text" class="form-control" value="<?php if(isset($_POST['prd_promotion'])){echo $_POST['prd_promotion'];} ?>">
                                </div>  
                                <div class="form-group">
                                    <label>Tình trạng</label>
                                    <input required name="prd_new" type="text" class="form-control" value="<?php if(isset($_POST['prd_new'])){echo $_POST['prd_new'];} ?>">
                                </div>  
                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ảnh sản phẩm</label>
                                    
                                    <input required name="prd_image" type="file">
                                    <?php if(isset($error)){ echo $error;} ?>
                                    <br>
                                    <div>
                                        <img src="img/product-3.png">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Danh mục</label>
                                    <select name="cat_id" class="form-control">
                                        <?php
                                        while($row = mysqli_fetch_assoc($query)){ 
                                        ?>
                                        <option value=<?php echo $row['cat_id'];?> <?php if(isset($_POST['cat_id']) && $row['cat_id']==$_POST['cat_id']){echo 'selected';} ?>><?php echo $row['cat_name']; ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Trạng thái</label>
                                    <select name="prd_status" class="form-control">
                                        <option value=1 <?php if(isset($_POST['prd_status']) && $_POST['prd_status']==1){echo 'selected';} ?>>Còn hàng</option>
                                        <option value=0 <?php if(isset($_POST['prd_status']) && $_POST['prd_status']==0){echo 'selected';} ?>>Hết hàng</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Sản phẩm nổi bật</label>
                                    <div class="checkbox">
                                        <label>
                                            <input name="prd_featured" type="checkbox" value=1 <?php if(isset($_POST['prd_featured']) && $_POST['prd_featured']==1){echo 'checked';} ?>>Nổi bật
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <label>Mô tả sản phẩm</label>
                                        <textarea required name="prd_details" class="form-control" rows="3"><?php if(isset($_POST['prd_details'])){echo $_POST['prd_details'];} ?></textarea>
                                        <script>CKEDITOR.replace('prd_details');</script>
                                    </div>
                        
                                <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                                <button type="reset" class="btn btn-default">Làm mới</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div><!-- /.col-->
            </div><!-- /.row -->
		
	</div>	<!--/.main-->	

