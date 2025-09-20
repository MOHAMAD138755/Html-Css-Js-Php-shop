<?php
session_start();
include("../partial/db.php");


if($_GET['form-name'] == 'like'){
    product_like($conn);
}else if($_GET['form-name'] == 'deslike'){
    product_deslike($conn);
}else if($_GET['form-name'] == 'delete_like'){
    delete_like($conn);
}


function product_like($conn){

    $insert_query = $conn->prepare("INSERT INTO `product_likes` (`type`,`user_id`,`product_id`,`create_at`) VALUES (?,?,?,NOW())");
    $insert_query->execute(["like",$_SESSION['user_id'],$_GET['id']]);
    if($insert_query){
        header("location: ../views/index.php");
    }
}

function product_deslike($conn){

    $insert_query = $conn->prepare("INSERT INTO `product_likes` (`type`,`user_id`,`product_id`,`create_at`) VALUES (?,?,?,NOW())");
    $insert_query->execute(["deslike",$_SESSION['user_id'],$_GET['id']]);
    if($insert_query){
        header("location: ../views/index.php");
    }
}

function delete_like($conn){
    $id = $_GET['id'];
    $delete_query = $conn->prepare("DELETE FROM `product_likes` WHERE `id` = ?");
    $delete_query->execute([$id]);
    if($delete_query){
        header("location: ../views/users_likes.php");
    }
}

?>