<?php
session_start();
include("../partial/db.php");

if($_GET){

if($_GET['form-name'] == 'deny_category'){
    deny_category($conn);
}

}

else if($_POST){
    if($_POST['form-name'] == 'edit_category'){
    edit_product($conn);
}
}

function  deny_category($conn){
$id = $_GET['id'];
$query = $conn->prepare("DELETE FROM `category` WHERE `id` = ?");
$query->bind_param("i",$id);
$query->execute();
if($query){
    header("location: ../views/categories.php");
}
}

function edit_product($conn){

if(!isset($_POST['csrf'],$_SESSION['csrf_edit_category']) || !hash_equals($_POST['csrf'],$_SESSION['csrf_edit_category'])){
    exit();
}else{

$id = $_POST['id'];
$title = $_POST['title'];
$title_english = $_POST['title_english'];

$query = $conn->prepare("UPDATE `category` SET `title`= ? ,`title_english`= ? WHERE id = ?");
$query->bind_param("ssi",$title,$title_english,$id);
$query->execute();
if($query){
    header("location: ../views/categories.php");
}
}
}

?>