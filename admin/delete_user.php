<?php
session_start();
define('SECURITY', true);
if(isset($_SESSION['mail']) && isset($_SESSION['pass'])){
    include_once('../config/connect.php');
    $user_id = $_GET['user_id'];
    $sql = "DELETE FROM user WHERE user_id = '$user_id'";
    $query = mysqli_query($connect, $sql);
    header('location: index.php?page_layout=user');
}else{
    header('location: index.php');
}
?>