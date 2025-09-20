<?php

include("../partial/db.php");

if($_GET['form-name'] == 'download'){
    download_image($conn);
}


function download_image($conn){
    $id = $_GET['id'];
    $query = $conn->prepare("SELECT `image` FROM `products` WHERE `id` = ?");
    $query->execute([$id]);
    $result = $query->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();


        $file_path = $row['image'];
        $file_name = basename($file_path);

        header("Content-Description: File Transfer");
        header("Content-Type: image/png");
        header("Content-Desposition: attachment; filename=".$file_name);
        header("Content-Length:".filesize($file_path));
        flush();
        readfile($file_path);
        exit();
    }else{
        echo "تصویر پیدا نشد";
    }
}


?>