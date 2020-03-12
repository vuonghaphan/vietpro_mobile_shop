<div id="search" class="col-lg-6 col-md-6 col-sm-12">
    <form action="index.php" class="form-inline" method="GET">
        <input type="hidden" name="page_layout" value="search">
        <input name="keyword" class="form-control mt-3" type="search" placeholder="Tìm kiếm" aria-label="Search">
        <button class="btn btn-danger mt-3" type="submit">Tìm kiếm</button>
    </form>
</div>
<?php
//câu lệnh tìm kiếm trong mysql
//SELECT * FROM product WHERE prd_name LIKE '%iphone%gold%'  : lấy ra sp có từ khóa iphone và gold

//explode : dung cắt 1 chuỗi ra từng mảnh
//iphone gold = [iphone] [gold]

//implode: để chèn các kí tự % vào tìm kiếm 

?>