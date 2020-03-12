<?php
if(!defined('SECURITY')){
	die('nope');
}
if(isset($_POST['sbm'])){
    $cat_name = $_POST['cat_name'];
    $sql = "SELECT * FROM category WHERE cat_name = '$cat_name' ";    
    $query = mysqli_query($connect, $sql);
    $num_rows = mysqli_num_rows($query);
    if($num_rows > 0 ){
        $error = '<div class="alert alert-danger">danh mục đã trùng !</div>';
    }else{
        $sql = "INSERT INTO category(cat_name) VALUE('$cat_name')";
        $query = mysqli_query($connect, $sql);
        header('location: index.php?page_layout=category');
    }
}

?>	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="">Quản lý danh mục</a></li>
				<li class="active">Thêm danh mục</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Thêm danh mục</h1>
			</div>
		</div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-8">
                            <?php if(isset($error)){echo $error;}?>
                            <form role="form" method="post">
                            <div class="form-group">
                                <label>Tên danh mục:</label>
                                <input required type="text" name="cat_name" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            <button type="submit" name="sbm" class="btn btn-success">Thêm mới</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </div>
                    	</form>
                    </div>
                </div>
            </div><!-- /.col-->
	</div>	<!--/.main-->	
