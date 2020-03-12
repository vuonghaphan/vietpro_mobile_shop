<?php

if (isset($_SESSION['cart'])) {
    //cập nhật giỏ hàng
    if (isset($_POST['sbm'])) {
        $_SESSION['cart'] = $_POST['cart'];
        //print_r($_SESSION['cart']);
    }
    $cart = $_SESSION['cart'];
    $arr_key = array_keys($cart); // chuyển key thành vlue
    $str_key = implode(',', $arr_key); // nối các value 

    $sql = "SELECT * FROM product WHERE prd_id IN($str_key)";
    $query = mysqli_query($connect, $sql);

    // $sql = "SELECT * FROM product WHERE prd_id IN($str_key)";
    // $query = mysqli_query($connect, $sql);
?>
    <!--	Cart	-->
    <div id="my-cart">
        <div class="row">
            <div class="cart-nav-item col-lg-7 col-md-7 col-sm-12">Thông tin sản phẩm</div>
            <div class="cart-nav-item col-lg-2 col-md-2 col-sm-12">Tùy chọn</div>
            <div class="cart-nav-item col-lg-3 col-md-3 col-sm-12">Giá</div>
        </div>
        <form method="post">
            <?php
            $total = 0;
            while ($row = mysqli_fetch_assoc($query)) {
                $total += $cart[$row['prd_id']] * $row['prd_price'];
            ?>
                <div class="cart-item row">
                    <div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                        <img src="admin/img/<?php echo $row['prd_image']; ?>">
                        <h4><?php echo $row['prd_name']; ?></h4>
                    </div>

                    <div class="cart-quantity col-lg-2 col-md-2 col-sm-12">
                        <input name="cart[<?php echo $row['prd_id']; ?>]" type="number" id="quantity" class="form-control form-blue quantity" value="<?php echo $cart[$row['prd_id']]; ?>" min="1">
                    </div>
                    <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b><?php echo number_format($row['prd_price'], 0, '', '.'); ?></b><a href="modules/cart/del_cart.php?prd_id=<?php echo $row['prd_id']; ?>">Xóa</a></div>
                </div>
            <?php } ?>
            <div class="row">
                <div class="cart-thumb col-lg-7 col-md-7 col-sm-12">
                    <button id="update-cart" class="btn btn-success" type="submit" name="sbm">Cập nhật giỏ hàng</button>
                </div>
                <div class="cart-total col-lg-2 col-md-2 col-sm-12"><b>Tổng cộng:</b></div>
                <div class="cart-price col-lg-3 col-md-3 col-sm-12"><b><?php echo number_format($total, 0, '', '.'); ?></b></div>
            </div>
        </form>

    </div>
<?php } ?>
<!--	End Cart	-->
<?php
include_once('modules/customer/customer.php');
?>