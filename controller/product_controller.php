<?php
session_start();
include("../partial/db.php");

if($_POST['form-name'] == 'add_category'){
    add_category($conn);
}else if($_POST['form-name'] == 'add_product'){
    add_product($conn);
}else if($_GET['form-name'] == 'delete_product'){
    delete_product($conn);
}else if($_POST['form-name'] == 'edit_product'){
    edit_product($conn);
}


function edit_product($conn){
    if(!isset($_POST['csrf'],$_SESSION['csrf_edit_product']) || !hash_equals($_POST['csrf'],$_SESSION['csrf_edit_product'])){
        exit();
    }
    else{

    $name = $_POST['name'];
    $description = $_POST['description'];
    $count = $_POST['count'];
    $image = $_FILES['image'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $path = '';

    $extention = ['png','jpg'];
    $ext = strtolower(pathinfo($image['name'],PATHINFO_EXTENSION));
    if($image['name'] != '' && in_array($ext,$extention) && $image['size'] <= 2 * 1024 * 1024){
        $path = '../img/'.basename($image['name']);
        move_uploaded_file($image['tmp_name'],$path);
    }

    if($path == ''){
        $update_query = $conn->prepare("UPDATE `products` SET `name` = ?, `description` = ?, `count` = ?, `price` = ?, `category_id` = ? WHERE `id` = ?");
        $update_query->execute([$name,$description,$count,$price,$category,$_POST['id']]);
        if($update_query){
            header("location: ../views/panel.php");
        }
    }else{
        $update_query = $conn->prepare("UPDATE `products` SET `name` = ?, `description` = ? ,`count` = ? ,`image` = ? ,`price` = ?, `category_id` = ? WHERE `id` = ?");
        $update_query->execute([$name,$description,$count,$path,$price,$category,$_POST['id']]);
        if($update_query){
            header("location: ../views/panel.php");
        }
    }
    
    }
}



function delete_product($conn){
    $id = $_GET['id'];
    $query = $conn->prepare("DELETE FROM `products` WHERE `id` = ?");
    $query->execute([$id]);
    if($query){
        header("location: ../views/panel.php");
    }
}



function add_category($conn){
   $title = $_POST['title'];
   $title_english = $_POST['title_english'];

   $select_query = $conn->prepare("SELECT * FROM `category` WHERE `title` = ? AND `title_english` = ?");
   $select_query->execute([$title,$title_english]);
   $result = $select_query->get_result();
   if($result->num_rows == 0){
   $query = $conn->prepare("INSERT INTO `category` (`title`,`title_english`) VALUES (?,?) ");
   $query->bind_param("ss",$title,$title_english);
   $query->execute();
   if($query){
    header("location: ../views/categories.php");
   }
}else{
    header("location: ../views/categories.php");
}
}



function add_product($conn){

    if(!isset($_POST['csrf'],$_SESSION['csrf_add_product']) || !hash_equals($_POST['csrf'],$_SESSION['csrf_add_product'])){
        exit();
    }
    else{

    $name = $_POST['name'];
    $description = $_POST['description'];
    $count = $_POST['count'];
    $image = $_FILES['image'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $category_query = $conn->prepare("SELECT * FROM `category` WHERE `title` = ?");
    $category_query->execute([$category]);
    $category_id = $category_query->get_result()->fetch_all()[0][0];var_dump($category_id);
    
    if(!empty($name) && !empty($description) && !empty($count) && !empty($image) && !empty($price) && !empty($category)){
    $extention = ['png','jpg'];
    $ext = strtolower(pathinfo($image['name'],PATHINFO_EXTENSION));
    if(in_array($ext,$extention) && $image['size'] <= 2 * 1024 * 1024){
    $dir = "../img/".basename($image['name']);
    move_uploaded_file($image['tmp_name'],$dir);
    $insert_query = $conn->prepare("INSERT INTO `products`(`name`,`description`,`image`,`count`,`price`,`category_id`) VALUE (?,?,?,?,?,?)");
    $insert_query->execute([$name,$description,$dir,$count,$price,$category_id]);
    if($insert_query){
         header("location: ../views/panel.php");
    }
    }else{
        header("location: ../views/panel.php");
    }
}else{
    header("location: ../views/panel.php");
}
}
}
?>