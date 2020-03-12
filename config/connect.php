<?php
if(!defined('SECURITY')){
	die('nope');
}
$connect = mysqli_connect('localhost','root','','phpk178');
if($connect){
    mysqli_query($connect, "SET NAMES 'utf8' ");
    //print_r('kết nối thành công!');
}else{
    die('kết nối thất bại!');
}
?>