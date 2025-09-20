<?php

class products{


    public function all_product(){
         include("../partial/db.php");
         $List = [];
         $query = $conn->prepare("SELECT * FROM `products`");
         $query->execute();
         $products = $query->get_result();
         if($products->num_rows > 0){
            $items = $products->fetch_all();
            array_push($List,$items);
         }
         return $List[0] ?? [];
    }

    public function search_product($name,$price){
        include("../partial/db.php");
         $List = [];
         $query = $conn->prepare("SELECT * FROM `products` WHERE `name` LIKE '%$name%' OR `price` LIKE '%$price%'");
         $query->execute();
         $products = $query->get_result();
         if($products->num_rows > 0){
            $items = $products->fetch_all();
            array_push($List,$items);
         }
          return $List[0] ?? [];
    }



      public function search_category($title,$title_english){
        include("../partial/db.php");
         $List = [];
         $query = $conn->prepare("SELECT * FROM `category` WHERE `title` LIKE '%$title%' OR `title_english` LIKE '%$title_english%'");
         $query->execute();
         $products = $query->get_result();
         if($products->num_rows > 0){
            $items = $products->fetch_all();
            array_push($List,$items);
         }
          return $List[0] ?? [];
    }


    public function get_user_ip(){
         if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            return  $_SERVER["HTTP_CLIENT_IP"];
         }else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
         }else{
            return $_SERVER["REMOTE_ADDR"];
         } 
    }

    
    public function product_item(){
         include("../partial/db.php");
         $List = [];
         $query = $conn->prepare("SELECT * FROM `products` WHERE `count` != 0");
         $query->execute();
         $products = $query->get_result();
         if($products->num_rows > 0){
            $items = $products->fetch_all();
            array_push($List,$items);
         }
         return $List[0] ?? [];
    }

    public function all_category(){
       include("../partial/db.php");
         $List = [];
         $query = $conn->prepare("SELECT * FROM `category`");
         $query->execute();
         $products = $query->get_result();
         if($products->num_rows > 0){
            $items = $products->fetch_all();
            array_push($List,$items);
         }
         return $List[0] ?? [];
    }

    public function single_product($product_id){
      include("../partial/db.php");
         $List = [];
         $query = $conn->prepare("SELECT * FROM `products` WHERE `id` = ?");
         $query->execute([$product_id]);
         $products = $query->get_result();
         if($products->num_rows > 0){
            $items = $products->fetch_assoc();
            array_push($List,$items);
         }
         return $List[0] ?? [];
    }

    public function comments_list($product_id){
         include("../partial/db.php");
         $List = [];
         $query = $conn->prepare("SELECT * FROM `comments` WHERE `product_id` = ? AND `comment_id` = 0");
         $query->execute([$product_id]);
         $result = $query->get_result();
         if($result->num_rows > 0){
            $items = $result->fetch_all();
            array_push($List,$items);
         }
         return $List[0] ?? [];
    }

    public function comment_list_user($user_id){
         include("../partial/db.php");
         $List = [];
         $query = $conn->prepare("SELECT * FROM `users` WHERE `id` = ?");
         $query->execute([$user_id]);
         $result = $query->get_result();
         if($result->num_rows > 0){
            $items = $result->fetch_assoc();
            array_push($List,$items);
         }
         return $List[0] ?? [];
    }

    public function reply_list($product_id,$comment_id){
         include("../partial/db.php");
         $List = [];
         $query = $conn->prepare("SELECT * FROM `comments` WHERE `product_id` = ? AND `comment_id` = ?");
         $query->execute([$product_id,$comment_id]);
         $result = $query->get_result();
         if($result->num_rows > 0){
            $items = $result->fetch_all();
            array_push($List,$items);
         }
         return $List[0] ?? [];
    }

    public function reply_list_user($user_id){
         include("../partial/db.php");
         $List = [];
         $query = $conn->prepare("SELECT * FROM `users` WHERE `id` = ?");
         $query->execute([$user_id]);
         $result = $query->get_result();
         if($result->num_rows > 0){
            $items = $result->fetch_assoc();
            array_push($List,$items);
         }
         return $List[0] ?? [];
    }

    public function product_list_category($category_id){
      include("../partial/db.php");
         $List = [];
         $query = $conn->prepare("SELECT * FROM `products` WHERE `category_id` = ?");
         $query->execute([$category_id]);
         $products = $query->get_result();
         if($products->num_rows > 0){
            $items = $products->fetch_all();
            array_push($List,$items);
         }
         return $List[0] ?? [];
    }

    public function comment_list_user_panel(){
      include("../partial/db.php");
         $List = [];
         $query = $conn->prepare("SELECT * FROM `comments` JOIN `users` ON comments.user_id = users.id
         JOIN `products` ON comments.product_id = products.id 
         ");
         $query->execute();
         $products = $query->get_result();
         if($products->num_rows > 0){
            $items = $products->fetch_all();
            array_push($List,$items);
         }
         return $List[0] ?? [];
    }

    public function count_comment($product_id){
         include("../partial/db.php");
         $List = [];
         $query = $conn->prepare("SELECT COUNT(*) FROM `comments`  WHERE `product_id` = ?");
         $query->execute([$product_id]);
         $products = $query->get_result();
         if($products->num_rows > 0){
            $items = $products->fetch_all();
            array_push($List,$items);
         }
         return $List[0] ?? [];
    }

    public function users($user_id){
      include("../partial/db.php");
         $List = [];
         $query = $conn->prepare("SELECT * FROM `users` WHERE `id` = ?");
         $query->execute([$user_id]);
         $products = $query->get_result();
         if($products->num_rows > 0){
            $items = $products->fetch_assoc();
            array_push($List,$items);
         }
         return $List[0] ?? [];
    }

    public function likes_deslike($user_id,$product_id){
      include("../partial/db.php");
      $query = $conn->prepare("SELECT * FROM `product_likes` WHERE `user_id` = ? AND `product_id` = ?");
      $query->execute([$user_id,$product_id]);
      $result = $query->get_result();
      if($result->num_rows > 0){
         return true;
      }
      else{
         return false;
      }
    }

    public function list_user_likes($user_id){
      include("../partial/db.php");
      $List = [];
      $query = $conn->prepare("SELECT * FROM `product_likes` JOIN `products` ON product_likes.product_id = products.id WHERE `user_id` = ? AND `type` = ?");
      $query->execute([$user_id,"like"]);
      $result = $query->get_result();
      if($result->num_rows > 0){
         $row = $result->fetch_all();
         array_push($List,$row);
      }
      return $List[0] ?? [];
    }

    public function list_likes_deslike(){
         include("../partial/db.php");
         $List = [];
         $query = $conn->prepare("SELECT * FROM `product_likes` JOIN `users` ON product_likes.user_id = users.id JOIN `products` ON product_likes.product_id = products.id
         ");
         $query->execute();
         $products = $query->get_result();
         if($products->num_rows > 0){
            $items = $products->fetch_all();
            array_push($List,$items);
         }
         return $List[0] ?? [];
    }

      public function count_like($product_id){
         include("../partial/db.php");
         $List = [];
         $query = $conn->prepare("SELECT COUNT(*) FROM `product_likes` JOIN `products` ON product_likes.product_id = products.id WHERE `type` != ? AND `product_id` = ?");
         $query->execute(["deslike",$product_id]);
         $products = $query->get_result();
         if($products->num_rows > 0){
            $items = $products->fetch_all();
            array_push($List,$items);
         }
         return $List[0] ?? [];
    }

     public function count_deslike($product_id){
         include("../partial/db.php");
         $List = [];
         $query = $conn->prepare("SELECT COUNT(*) FROM `product_likes` JOIN `products` ON product_likes.product_id = products.id WHERE `type` != ? AND `product_id` = ?");
         $query->execute(["like",$product_id]);
         $products = $query->get_result();
         if($products->num_rows > 0){
            $items = $products->fetch_all();
            array_push($List,$items);
         }
         return $List[0] ?? [];
    }

    public function cart($user_id,$product_id){
      include("../partial/db.php");
      $List = [];
      $query = $conn->prepare("SELECT * FROM `cart_pivot` WHERE `user_id` = ? AND `product_id` = ?");
      $query->execute([$user_id,$product_id]);
      $result = $query->get_result();
      if($result->num_rows > 0){
         return true;
      }
      else{
         return false;
      }
    }

    public function cart_list($user_id){
      include("../partial/db.php");
      $List = [];
      $query = $conn->prepare("SELECT * FROM `cart_pivot` JOIN `products` ON cart_pivot.product_id = products.id WHERE `user_id` = ?");
      $query->execute([$user_id]);
      $result = $query->get_result();
      if($result->num_rows > 0){
         $row = $result->fetch_all();
         array_push($List,$row);
      }
      return $List[0] ?? [];
    }

    public function sum_price($user_id){
      include("../partial/db.php");
      $List = [];
      $query = $conn->prepare("SELECT SUM(item_count*price) FROM `cart_pivot` WHERE `user_id` = ?");
      $query->execute([$user_id]);
      $result = $query->get_result();
      if($result->num_rows > 0){
         $row = $result->fetch_all();
         array_push($List,$row);
      }
      return $List[0] ?? [];
    }

    public function send_payment($merchant_id,$amount,$callback){

      $data = [

         "merchant_id" => $merchant_id,
         "amount" => $amount,
         "callback" => $callback,
         "description" => "payment",
      ];

         $ch = curl_init("url: payment..... ");
         curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
         curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($data));
         curl_setopt($ch,CURLOPT_HTTPHEADER,['Content-Type: application/json']);
         $response = curl_exec($ch);
         curl_close($ch);

         return json_decode($response);

    }

    public function search_product_items($search){
        include("../partial/db.php");
        $List = [];
        $query = $conn->prepare("SELECT * FROM `products` JOIN `category` ON products.category_id = category.id WHERE `name` LIKE '%$search%' OR `description` LIKE '%$search%' OR `price` LIKE '%$search%'");
        $query->execute();
        $products = $query->get_result();
        if($products->num_rows > 0){
            $items = $products->fetch_all();
            array_push($List,$items);
        }
        return $List[0] ?? [];
    }

}

?>