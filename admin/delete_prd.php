<?php
session_start();
define('SECURITY', true);
if(isset($_SESSION['mail']) && isset($_SESSION['pass'])){
    include_once('../config/connect.php');
    $prd_id = $_GET['prd_id'];
    $sql_img = mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM product WHERE prd_id = '$prd_id'"));
    $sql = "DELETE FROM product WHERE prd_id = '$prd_id'";
    $query = mysqli_query($connect, $sql);
    if(mysqli_affected_rows($connect) > 0){
        if(file_exists('img/'.$sql_img['prd_image'])){
            unlink('img/'.$sql_img['prd_image']);
        }else{
            echo 'ảnh không tồn tại';
        }
    }
    header('location: index.php?page_layout=product');
}else{
    header('location: index.php');
}
?>