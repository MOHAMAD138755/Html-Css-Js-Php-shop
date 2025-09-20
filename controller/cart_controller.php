<?php
session_start();
include("../partial/db.php");

if($_POST['form-name'] == 'add_cart'){
    add_cart($conn);
}if($_GET['form-name'] == 'delete_cart'){
    delete_cart($conn);
}


function add_cart($conn){
    $product_id = $_POST['id'];
    $count_product = $_POST['count_product'];
    $price = $_POST['price'];
    $insert_query = $conn->prepare("INSERT INTO `cart_pivot` (`user_id`,`product_id`,`item_count`,`price`,`create_at`) VALUES (?,?,?,?,NOW())");
    $insert_query->execute([$_SESSION['user_id'],$product_id,$count_product,$price]);
    if($insert_query){
        header("location: ../views/index.php");
    }
}

function delete_cart($conn){
    $id = $_GET['id'];
    $delete_query = $conn->prepare("DELETE FROM `cart_pivot` WHERE `id` = ?");
    $delete_query->execute([$id]);
    if($delete_query){
        header("location: ../views/cart_list.php");
    }
}


?>