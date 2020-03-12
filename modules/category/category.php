<?php

$cat_name = $_GET['cat_name'];
$cat_id = $_GET['cat_id'];

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}
//gán số lượng sản phẩm cần hiển thị
$row_per_page = 6; // số lượng sản phẩm hiển thị trên 1 trang = 5
$per_row = $page * $row_per_page - $row_per_page; //per_row la key
//tính số bản ghi 
// $sql = "SELECT * FROM product";
// $query = mysqli_query($connect, $sql);
// $total_row = mysqli_num_rows($query);
$total_row = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM product WHERE cat_id = $cat_id"));
$total_pages = ceil($total_row/$row_per_page); // hàm làm tròn số trong PHP
//nút preview page 
$list_pages = '';                                                                                                                                        
$page_prev = $page - 1; 
if($page_prev <= 0 ){ 
    $page_prev = 1;
}
$list_pages .='<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_name='.$cat_name.'&cat_id='.$cat_id.'&page='.$page_prev.'">Trang trước</a></li>'; 
// tính toán số trang 
for($i = 1; $i <= $total_pages ; $i++){
    if($i == $page){
        $active = 'active';
    }else{
        $active = '';
    }
    $list_pages.='<li class="page-item '.$active.'" ><a class="page-link" href="index.php?page_layout=category&cat_name='.$cat_name.'&cat_id='.$cat_id.'&page='.$i.'">'.$i.'</a></li>';
}
// nút next page 
$page_next = $page + 1;
if($page_next >= $total_pages){
    $page_next = $total_pages;
}
$list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&cat_name='.$cat_name.'&cat_id='.$cat_id.'&page='.$page_next.'">Trang sau</a></li>';


$query = mysqli_query($connect,"SELECT * FROM product WHERE cat_id = $cat_id ORDER BY prd_id DESC LIMIT $per_row, $row_per_page");
$num_rows = mysqli_num_rows($query);
?>


<!--	List Product	-->
<div class="products">
    <h3><?php echo $cat_name; ?> (hiện có <?php echo $num_rows; ?> sản phẩm)</h3>
    <div class="product-list row">
        <?php while($row = mysqli_fetch_assoc($query)){ ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
            <div class="product-item card text-center">
                <a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>"><img src="admin/img/<?php echo $row['prd_image']; ?>"></a>
                <h4><a href="#"><?php echo $row['prd_name']; ?></a></h4>
                <p>Giá Bán: <span><?php echo $row['prd_price']; ?></span></p>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<!--	End List Product	-->

<div id="pagination">
    <ul class="pagination">
            <?php echo $list_pages; ?>
    </ul>
</div>