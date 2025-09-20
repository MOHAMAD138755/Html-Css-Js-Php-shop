
<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>پروفایل شما</title>

  <style>
    body {
      font-family: "Tahoma", sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
      direction: rtl;
    }

        @font-face {
        font-family: "Vazir";
        src: url(../fonts/Vazir.ttf);
        }
        *{
            font-family: "Vazir";
        }

    .container {
      max-width: 800px;
      margin: 40px auto;
      padding: 20px;
      background-color: #ffffff;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      border-radius: 10px;
      height:auto;
    }

    .post-title {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 10px;
      color: #333;
    }

    .post-meta {
      font-size: 14px;
      color: #777;
      margin-bottom: 20px;
    }

    .post-image {
      width: 100%;
      border-radius: 6px;
      margin-bottom: 20px;
    }

    .post-content {
      font-size: 18px;
      line-height: 2;
      color: #444;
      display:flex;
    }
    .post-content p{
       padding:10px;
    }
	  @media (max-width:500px){
		  button{
			  margin-top: 30px;
		  }
	  }
	  button{
		  width: 200px;
		  height: 30px;
		  background-color: green;
		  color: white;
		  margin-right: 30px;
		  border: none;
		  margin-top: 30px;
		  margin-bottom: 30px;
	  }
	  button:hover{
		  cursor: pointer;
		  background-color: aqua;
		  color: black;
	  }
	input[type = 'text']{
		  height: 30px;
		  border: 1px solid gray;
		  outline: none;
		  border-radius: 5px;
	  }
	  button::after{
		  content: "✔";
	  }
	  input[type = 'text']:focus{
		  border: 2px solid blue;
		  color: green;
	  }
	  .comment{
		  width: 60%;
		  height: auto;
		  border-top: 1px solid black;
	  }
	  .comment img{
/*		  margin-right: 200px;*/
	  }
	  #reply{
		  width: 200px;
	  }
	  #comment_user{
		  width: 350px;
	  }
	  pre{
		  word-wrap: break-word;
		  white-space: pre-wrap;
		  line-height: 30px;
		  font-style: oblique;
	  }
	  .comment h2{
		  word-wrap: break-word;
		  white-space: pre-wrap;
		  line-height: 30px;
	  }
	  .comment p{
		  word-wrap: break-word;
		  white-space: pre-wrap;
		  line-height: 30px;
	  }
      .contact form{
  text-align: center;
  padding:2rem;
  border:.1rem solid rgba(0,0,0,.3);
}

.contact form .inputBox input, .contact form textarea{
  padding:1rem;
  font-size: 1.7rem;
  background:#f7f7f7;
  text-transform: none;
  margin:1rem 0;
  border:.1rem solid rgba(0,0,0,.3);
  width: 30%;
}

.contact form textarea{
  height: 10rem;
  resize: none;
  width: 70%;
  height: 100px;
}
.btn{
    width: 150px;
    height: 30px;
    border:none;
    background-color:green;
    color:white;
    border-radius: 5px;
}
.btn:hover{
    background-color:darkgreen;
    cursor:pointer;
}
.image_user img{
  width: 200px;
  height:200px;
  margin-right:50px;
}
.comment_text_answer{
  margin-right:80px;
}
.reply-form form textarea{
  width: 50%;
  height: 40px;
  resize: none;
  background-color:#f7f7f7;
}
.user_image img{
    width:80%;
    height:350px;
    background-color:gray;
    margin-right:90px;
}
.btn{
    display:flex;
    margin-right:150px;
}
footer{
    width: 100%;
    height:auto;
    background-color:blue;
    color:white;
    text-align:center;
}
footer button{
    width:70%;
}
.cart{
  display:flex;
}
  </style>
</head>
<body>


    <?php 
    session_start();
    include("../controller/product.php");
    if(isset($_SESSION['user_id'])){
        $product = new products();   $cart_list = $product->cart_list($_SESSION['user_id']);
    ?>
    
    <?php foreach($cart_list as $cart){?>
  <div class="container">
      <h2 style="text-align:center">سبد خرید</h2>


    <h1 class="post-title">نام محصول: <?= htmlspecialchars($cart[7]) ?> </h1>
    <div class="post-meta">توضیحات : <?= htmlspecialchars($cart[8]) ?> </div>
    <div class="user_image"><img src=" <?= htmlspecialchars($cart[9]) ?? ''?> "></div>
    <div class="quantity">
        <span>تعداد درخواست : <?= htmlspecialchars($cart[3]) ?></span>
        <br>
        <span>تعداد موجود : <?= htmlspecialchars($cart[10]) ?></span>
        <br>
        <span>تاریخ ورود به سبد : <?= htmlspecialchars($cart[5]) ?></span>
    </div>
    <div class="post-meta">قیمت محصول : <?= htmlspecialchars(number_format($cart[11],0,'.','/')) ?> تومان </div>  
    <div class="post-meta"> قیمت محصول به تعداد: <?= htmlspecialchars(number_format($cart[11]*$cart[3],0,'.','/')) ?> تومان </div>   
    <br> 

      <div class="cart">

    <a href="../controller/cart_controller.php?id=<?= htmlspecialchars($cart[0]) ?>&form-name=delete_cart">
    <button style="background-color:red">حذف محصول از سبد</button>
    </a>

    <form method="post" action="address.php">
    <input type="hidden" name="price" value="<?= htmlspecialchars($cart[11]*$cart[3]) ?>">
    <button type="submit" style="background-color:green">پرداخت</button>
    </form>

      </div>
    <hr> 
    <?php } ?>


    <?php }else{
        header("location: login.php");
    } ?>

    <footer>

        <?php $sum_price = $product->sum_price($_SESSION['user_id']);
        ?>

        <p> قیمت کل محصولات: <?= htmlspecialchars(number_format($sum_price[0][0] ?? 0,0,'.','/')) ?> تومان </p>
    <form method="post" action="address.php">
    <input type="hidden" name="price" value="<?= htmlspecialchars($cart[11]*$cart[3]) ?>">
    <button style="background-color:green">پرداخت همه محصولات</button>
    </form>

    </footer>
</body>
</html>