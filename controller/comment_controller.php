<?php
session_start();
include("../partial/db.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if($_POST['form-name'] == 'add_comment'){
        add_comment($conn);
    }else if($_POST['form-name'] == "add_comment_reply"){
        add_comment_reply($conn);
    }
}else if($_SERVER['REQUEST_METHOD'] == "GET"){
    if($_GET['form-name'] == 'delete_comment'){
        delete_comment($conn);
    }
}


function add_comment($conn){
    $comment_body = $_POST['comment_body'];
    $insert_query = $conn->prepare("INSERT INTO `comments` (`comment_body`,`user_id`,`product_id`) VALUES (?,?,?)");
    $insert_query->execute([$comment_body,$_SESSION['user_id'],$_POST['id']]);
    if($insert_query){
        header("location: ../views/single_product.php?id=".$_POST['id']);
    }
}

function add_comment_reply($conn){
    $comment_body_reply = $_POST['comment_body_reply'];
    $comment_id = $_POST['comment_id'];
    $product_id = $_POST['product_id'];
    $insert_query = $conn->prepare("INSERT INTO `comments` (`comment_body`,`user_id`,`product_id`,`comment_id`) VALUES (?,?,?,?)");
    $insert_query->execute([$comment_body_reply,$_SESSION['user_id'],$product_id,$comment_id]);
    if($insert_query){
        header("location: ../views/single_product.php?id=".$product_id);
    }   
}

function delete_comment($conn){
    $delete_query = $conn->prepare("DELETE FROM `comments` WHERE `id` = ?");
    $delete_query->execute([$_GET['id']]);
    if($delete_query){
        header("location: ../views/comments.php");
    } 
}


?>