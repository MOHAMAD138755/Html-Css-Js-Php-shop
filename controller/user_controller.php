<?php
session_start();
include("../partial/db.php");
include("../controller/product.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST['form-name'] == 'register'){
        register_user($conn);
    }else if($_POST['form-name'] == 'login'){
        login_user($conn);
    }else if($_POST['form-name'] == 'forget_pass'){
        forget_pass($conn);
    }else if($_POST['form-name'] == 'chnge_pass'){
        chnge_pass($conn);
    }else if($_POST['form-name'] == 'edit_user'){
        edit_user($conn);
    }else if($_POST['form-name'] == 'edit_admin'){
        edit_admin($conn);
    }else if($_POST['form-name'] == 'add_user'){
        add_user($conn);
    }else if($_POST['form-name'] == 'edit_profile'){
        edit_profile($conn);
    }
}
else if($_SERVER["REQUEST_METHOD"] == "GET"){
    if($_GET['form-name'] == 'delete_user'){
        delete_user($conn);
    }else if($_GET['form-name'] == 'delete_admin'){
        delete_admin($conn);
    }
}


function register_user($conn){

     if(!isset($_POST['csrf'],$_SESSION['register']) || !hash_equals($_POST['csrf'],$_SESSION['register'])){
        exit();
    }else{

    $products = new products();
    $ip = $products->get_user_ip();

    $username = $_POST['username'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $email = $_POST['email'];

        $select_username_query = $conn->prepare("SELECT * FROM `users` WHERE `username` = ?");
        $select_username_query->execute([$username]);
        $result = $select_username_query->get_result();
        if($result->num_rows == 0){

        $insert_query = $conn->prepare("INSERT INTO `users` (`username`,`password`,`email`,`ip`) VALUES (?,?,?,?) ");
        $insert_query->execute([$username,$password,$email,$ip]);
        if($insert_query){
        header("location: ../views/index.php");
        }
            }else{
                 header("location: ../views/register.php");
                 $_SESSION['masage'] = "<div style='text-align: center;color:red;'>نام کاربری قبلا استفاده شده</div>";
            }
    }
}


function login_user($conn){
    if(!isset($_POST['csrf'],$_SESSION['login']) || !hash_equals($_POST['csrf'],$_SESSION['login'])){
        exit();
    }else{
        $username = $_POST['username'];
        $password = $_POST['password'];
        $remember = $_POST['remember'] ?? '';

        $select_query = $conn->prepare("SELECT * FROM `users` WHERE `username` = ?");
        $select_query->execute([$username]);
        $result = $select_query->get_result();
        if($result->num_rows == 1){
            $users = $result->fetch_assoc();

            if(password_verify($password,$users['password'])){
            $_SESSION['user_id'] = $users['id'];
            $_SESSION['masage'] = "<div style='text-align: center;color:green;'>ورود موفقیت آمیز</div>";

                if(!empty($remember) && $users['status'] == 'public_user'){
                $remember_token = bin2hex(random_bytes(8));
                setcookie("remember",$remember_token,time() + 3600,"/");
                $update_token_query = $conn->prepare("UPDATE `users` SET `remember_token` = ? WHERE `id` = ?");
                $update_token_query->execute([$remember_token,$users['id']]);
                } else {
                setcookie("remember", "", time() - 3600, "/");
                $update_token_query = $conn->prepare("UPDATE `users` SET `remember_token` = NULL WHERE `id` = ?");
                $update_token_query->execute([$users['id']]);
                }

                if(isset($_SESSION['user_id'])){
                    $update_last_login_query = $conn->prepare("UPDATE `users` SET `last_login` = NOW() WHERE `id` = ?");
                    $update_last_login_query->execute([$users['id']]);
                }

                header("location: ../views/index.php");

                if($users['status'] == 'admin'){
                    $_SESSION['admin'] = true;
                    header("location: ../views/panel.php");
                }

            }else{
            $_SESSION['masage'] = "<div style='text-align: center;color:red;'>نام کاربری یا رمز عبور اشتباه است</div>";
            header("location: ../views/login.php");
            exit();
            }
        }else{
            $_SESSION['masage'] = "<div style='text-align: center;color:red;'>نام کاربری یا رمز عبور اشتباه است</div>";
            header("location: ../views/login.php");
            exit();
            }
    }
}

function forget_pass($conn){
    $email = $_POST['email'];

    $select_id_query = $conn->prepare("SELECT `id` FROM `users` WHERE `email` = ?");
    $select_id_query->execute([$email]);
    $result = $select_id_query->get_result();
    if($result->num_rows == 1){
        $users = $result->fetch_assoc();
        $token = bin2hex(random_bytes(16));
        $token_hash =  hash("sha512",$token);
        $user_id = $users['id'];

        $expires_at = (new DateTime('+1 hour',new DateTimeZone("Asia/Tehran")))->format("Y-m-d H:i:s");

        $insert_query = $conn->prepare("INSERT INTO `password_reset` (`user_id`,`token_hash`,`expires_at`) VALUES (?,?,?)");
        $insert_query->execute([$users['id'],$token_hash,$expires_at]);

        $resetlink = "http://localhost/mini_shop/views/change_pass.php?token=$token&id=$user_id";
        // استفاده از header اختیاری است و با خالی گذاشتن ان مقدار پیشفرض گذاشته میشود
        $header = "Form: no-reply@localhost\r\n".
        "Content-Type: text/plain; charset=utf-8\r\n";
        $subject = "reset password";
        $masage = "click your changh passowrd $resetlink";
        $mail = mail($email,$subject,$masage,$header);
        if($mail){
            $_SESSION['masage'] = "<div style='text-align: center;color:green;'>درخواست با موفقیت به ایمیل شما ارسال شد</div>";
            header("location: ../views/forgot-password.php");
        }

    }
}

function chnge_pass($conn){
    $newpassword = password_hash($_POST['new_password'],PASSWORD_DEFAULT);
    $update_query = $conn->prepare("UPDATE `users` SET `password` = ? WHERE `id` = ?");  
    $update_query->execute([$newpassword,$_POST['id']]); 
    if($update_query){
        $delete_query = $conn->prepare("DELETE FROM `password_reset` WHERE `user_id` = ?");  
        $delete_query->execute([$_POST['id']]); 
        header("location: ../views/login.php");
    }
}

function delete_user($conn){
    $id = $_GET['id'];
    $query = $conn->prepare("DELETE FROM `users` WHERE `id` = ?");
    $query->execute([$id]);
    if($query){
        header("location: ../views/users.php");
    }
}

function delete_admin($conn){
    $id = $_GET['id'];
    $query = $conn->prepare("DELETE FROM `users` WHERE `id` = ?");
    $query->execute([$id]);
    if($query){
        header("location: ../views/admins.php");
    }
}

function edit_user($conn){
    if(!isset($_POST['csrf'],$_SESSION['csrf_edit_user']) || !hash_equals($_POST['csrf'],$_SESSION['csrf_edit_user'])){
        exit();
    }else{
    $update_query = $conn->prepare("UPDATE `users` SET `username` = ? , `email` = ? , `status` = ? WHERE `id` = ?");
    $update_query->execute([$_POST['username'],$_POST['email'],$_POST['status'],$_POST['id']]);
    if($update_query){
        header("location: ../views/users.php");
    }
}
}

function edit_admin($conn){
    if(!isset($_POST['csrf'],$_SESSION['csrf_edit_admin']) || !hash_equals($_POST['csrf'],$_SESSION['csrf_edit_admin'])){
        exit();
    }else{
    $update_query = $conn->prepare("UPDATE `users` SET `username` = ? , `email` = ? , `status` = ? WHERE `id` = ?");
    $update_query->execute([$_POST['username'],$_POST['email'],$_POST['status'],$_POST['id']]);
    if($update_query){
        header("location: ../views/admins.php");
    }
}
}

function add_user($conn){
    if(!isset($_POST['csrf'],$_SESSION['add_user']) || !hash_equals($_POST['csrf'],$_SESSION['add_user'])){
        exit();
    }else{

    $username = $_POST['username'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $email = $_POST['email'];

        $select_username_query = $conn->prepare("SELECT * FROM `users` WHERE `username` = ?");
        $select_username_query->execute([$username]);
        $result = $select_username_query->get_result();
        if($result->num_rows == 0){

        $insert_query = $conn->prepare("INSERT INTO `users` (`username`,`password`,`email`,`ip`) VALUES (?,?,?,?) ");
        $insert_query->execute([$username,$password,$email,"نامشخص(وارد شده توسط ادمین)"]);
        if($insert_query){
        header("location: ../views/users.php");
        }
            }else{
                 header("location: ../views/users.php");
                 $_SESSION['masage_erore'] = "<div style='text-align: center;color:red;'>نام کاربری قبلا استفاده شده</div>";
            }
    }
}

function edit_profile($conn){

    if(!isset($_POST['csrf'],$_SESSION['csrf_edit_profile']) || !hash_equals($_POST['csrf'],$_SESSION['csrf_edit_profile'])){
        exit();
    }else{

    $image = $_FILES['profile'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $bio = $_POST['bio'];
    $exe = ['jpg','png'];
    $extention = ['png','jpg'];
    $path = '';

    $ext = strtolower(pathinfo($image['name'],PATHINFO_EXTENSION));
    if($image['name'] != '' && in_array($ext,$extention) && $image['size'] <= 2 * 1024 * 1024){
        $path = '../user_profile/'.uniqid("profile_",true).basename($image['name']);
        move_uploaded_file($image['tmp_name'],$path);
        
    }


    if($path == ''){

        $select_query = $conn->prepare("SELECT * FROM `users` WHERE `username` = ? AND `id` != ?");
        $select_query->execute([$username,$_SESSION['user_id']]);
        $result_select_query = $select_query->get_result();
        if($result_select_query->num_rows == 0){

        $update_query = $conn->prepare("UPDATE `users` SET `username`=?,`email`=?,`biography`=?  WHERE `id` = ?");
        $update_query->execute([$username,$email,$bio,$_SESSION['user_id']]);
        if($update_query)   {
        header("location: ../views/profile_user.php");
        }

    }else{
        $_SESSION['masage'] = "<div style='color:red;text-align:center'>نام کاربری قبلا استفاده شده</div>";
        header("location: ../views/edit_user_profile.php");
    }


        }else{

            $select_query = $conn->prepare("SELECT * FROM `users` WHERE `username` = ? AND `id` != ?");
            $select_query->execute([$username,$_SESSION['user_id']]);
            $result_select_query = $select_query->get_result();
            if($result_select_query->num_rows == 0){


            $query = $conn->prepare("SELECT `profile` FROM `users` WHERE `id` = ?");
            $query->execute([$_SESSION['user_id']]);
            $result = $query->get_result();
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                unlink($row['profile']);
            }

        

        $update_query = $conn->prepare("UPDATE `users` SET `username`=?,`email`=?,`biography`=?,`profile`=?  WHERE `id` = ?");
        $update_query->execute([$username,$email,$bio,$path,$_SESSION['user_id']]);
        if($update_query)   {
        header("location: ../views/profile_user.php");
        }

        }else{
        $_SESSION['masage'] = "<div style='color:red;text-align:center'>نام کاربری قبلا استفاده شده</div>";
        header("location: ../views/edit_user_profile.php");
        }

    }




    }
}
?>