<?php
// session_start();
//include_once('./config/connect.php');
function loginFromSocialCallback ($fbUser) { 
    include_once('../../config/connect.php');
    $sql = "SELECT * FROM user WHERE user_mail = '".$fblUser['email']."'";
    $query = mysqli_query($connect, $sql );
    $num_rows = mysqli_num_rows($query);
    if($num_rows == 0){
        $sql = "INSERT INTO user (user_id , user_full, user_mail) 
        VALUE('".$fblUser['id']."','".$fblUser['name']."','".$fblUser['email']."')";
        $query = mysqli_query($connect, $sql);
        if(!$query){
            echo mysqli_error($connect);
            exit;
        }
        $sql = "SELECT * FROM user WHERE user_mail = '".$fblUser['email']."'";
        $query = mysqli_query($connect, $sql);
        
        if($num_rows > 0){
            $user_fb = mysqli_fetch_assoc($query);
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }
            $user_fb = $_SESSION['fbUser']; 
            // header('location: ../index.php');
        }
        
    }


    // $fbUser = $_SESSION['fbUser']; 
    // header('location: ../index.php');
}

?>