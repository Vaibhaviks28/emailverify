<?php

session_start();

include 'config.php';

if(isset($_GET['token'])){

    $token = $_GET['token'];

    $sql = " UPDATE registration Set status='active' WHERE token='$token' ";
    $result = mysqli_query($conn,$sql);

    if($result){
        if(isset($_SESSION['msg'])){
            $_SESSION['msg'] = "Account Updated Successfully";
            header('location:index.php');
        }else{
            $_SESSION['msg'] = "You are Logged out";
            header('location:index.php');
        }
    }else{
        $_SESSION['msg'] = "Account Not Updated";
            header('location:register.php');
    }

}

?>