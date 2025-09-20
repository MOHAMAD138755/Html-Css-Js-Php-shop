<?php
session_start();
include("../partial/db.php");
include("product.php");


if($_POST['address_name'] == 'user_address'){
    user_address($conn);
}


function user_address($conn){

    if(!isset($_POST['csrf'],$_SESSION['user_address']) || !hash_equals($_POST['csrf'],$_SESSION['user_address'])){
        exit();
    }else{

    $merchant_id = "";
    $calback = "";
    $price = $_POST['price'] * 10;
    $user_id = $_SESSION['user_id'];
    $full_name = $_POST['full_name'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $code_post = $_POST['code_post'];


    if( !empty(trim($full_name)) && !empty(trim($city)) && !empty(trim($province)) && !empty(trim($address)) && !empty(trim($phone)) &&
    !empty(trim($code_post)) && strlen($phone) == 11 && strlen($code_post) == 10
    ) {
        
    $insert_query = $conn->prepare("INSERT INTO `user_address` (`user_id`,`full_name`,`city`,`province`,`address`,`phone`,`code_post`) VALUES (?,?,?,?,?,?,?)");
    $insert_query->execute([$user_id,$full_name,$city,$province,$address,$phone,$code_post]);
    if($insert_query){
        


//            $product = new products();
//            $send = $product->send_payment($merchant_id,$price,$calback);
//            if($send->Status == 100){
//            $status = "موفقیت آمیز  ";
//            $authority = $send->Authority;
//            $insert_payment_query = $conn->prepare("INSERT INTO `payment` (`user_id`,`price`,`status`,`authority`,`create_at`) VALUES (?,?,?,?,NOW()) ");
//            $insert_payment_query->execute([$_SESSION['user_id'],$price,$status,$authority]);


//            header("location: payment url");

            header("location: ../views/address.php");

//        }


    }

 }else{
    $_SESSION['masage'] = "<div style='text-align:center;color:red;font-size:20px'>مشخصات به درستی وارد نشده</div>";
    header("location: ../views/address.php");
 }


 }
    }


?>