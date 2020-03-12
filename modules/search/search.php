<?php 
if(isset($_GET['keyword'])){
    $keyword = $_GET['keyword'];
}else{
    $keyword = '';
}
//bóc tách key
//explode ('iphone','xs')
$arr_key = explode(" ",$keyword);
//nối
$key_end = '%'.implode("%",$arr_key).'%';
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}
//gán số lượng sản phẩm cần hiển thị
$row_per_page = 3; // số lượng sản phẩm hiển thị trên 1 trang = 5
$per_row = $page * $row_per_page - $row_per_page; //per_row la key
//tính số bản ghi 
$total_row = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM product WHERE prd_name LIKE ('$key_end') "));
$total_pages = ceil($total_row/$row_per_page); // hàm làm tròn số trong PHP
//nút preview page 
$list_pages = '';                                                                                                                                        
$page_prev = $page - 1; 
if($page_prev <= 0 ){
    $page_prev = 1;
}
$list_pages .='<li class="page-item"><a class="page-link" href="index.php?page_layout=search&keyword='.$keyword.'&page='.$page_prev.'">Trang trước</a></li>'; 
// tính toán số trang 
for($i = 1; $i <= $total_pages ; $i++){
    if($i == $page){
        $active = 'active';
    }else{
        $active = '';
    }
    $list_pages.='<li class="page-item '.$active.'"><a class="page-link" href="index.php?page_layout=search&keyword='.$keyword.'&page='.$i.'">'.$i.'</a></li>';
    //$list_pages.='<li class="page-item '.$active.'" ><a class="page-link" href="index.php?page_layout=search&page='.$i.'">'.$i.'</a></li>';
}
// nút next page 
$page_next = $page + 1;
if($page_next >= $total_pages){
    $page_next = $total_pages;
}

$list_pages .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=search&keyword='.$keyword.'&page='.$page_next.'">Trang sau</a></li>';


$query = mysqli_query($connect,"SELECT * FROM product WHERE prd_name LIKE ('$key_end') LIMIT $per_row, $row_per_page");
// $num_rows = mysqli_num_rows($query);
// $sql = "SELECT * FROM product WHERE prd_name LIKE ('$key_end') ";
// $query = mysqli_query($connect, $sql); 

?>


<!--	List Product	-->
<div class="products">   
    <div id="search-result">Kết quả tìm kiếm với sản phẩm <span><?php echo $keyword; ?></span></div>
    <div class="product-list row">
        <?php while( $row = mysqli_fetch_assoc($query)){ ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mx-product">
            <div class="product-item card text-center">
                <a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>"><img src="admin/img/<?php echo $row['prd_image']; ?>"></a>
                <h4><a href="index.php?page_layout=product&prd_id=<?php echo $row['prd_id']; ?>"><?php echo $row['prd_name']; ?></a></h4>
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
        <!-- <li class="page-item"><a class="page-link" href="#">Trang trước</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Trang sau</a></li> -->
    </ul>
</div>