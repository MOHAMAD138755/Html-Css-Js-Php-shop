
<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>محصول تکی</title>

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
  width: 70px;
  height:70px;
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
a{
    text-decoration: none;
    padding:5px;
}
  </style>
</head>
<body>


	<?php
    session_start();
    include("../controller/product.php");
    $product = new products();
    $category_items = $product->product_list_category($_GET['id']);
	?>


  <!-- نمایش محصول -->
   <?php foreach($category_items as $item){ ?>
  <div class="container">
    <h1 class="post-title">نام محصول: <?= htmlspecialchars($item[1]) ?></h1>
    <div class="post-meta">توضیحات: <?= htmlspecialchars($item[2]) ?></div>
    <img src="<?= htmlspecialchars($item[3]) ?>" alt="تصویر مصحول" class="post-image" width="200px" height="400px">
    <div class="post-content">
      <p> تعدا محصول:  <?= htmlspecialchars($item[4]) ?> </p>
      <p> قیمت محصول:  <?= htmlspecialchars($item[5]) ?> </p>

              <?php if(!$product->cart($_SESSION['user_id'] ?? '',$item[0])){ 
                if(isset($_SESSION['user_id'])){ ?>
                
                <form action="../controller/cart_controller.php" method="post">
                <input type="hidden" name="form-name" value="add_cart">
                <input type="hidden" name="id" value="<?= htmlspecialchars($item[0]) ?>">
                <input type="hidden" name="price" value="<?= htmlspecialchars($item[5]) ?>">
                <label style="font-size:22px;">تعداد محصول را انتخاب کن:</label>
                <input type="number" min="1"name="count_product" max="<?= htmlspecialchars($item[4]) ?>" value="1" style="font-size:20px;color:green">
                <button type="submit" class="btn" style="width:365px">افزودن به سبد خرید</button>
                </form>

                 <?php }else echo "<a href='login.php'><button class='btn' style='width:60%;background-color:red'>برا ی خرید ورود کنید</button></a>";}else{ ?>

                <a href="cart_list.php" class="btn" style="color:green;background:yellow">به سبد خرید اضافه شد</a>

                <?php } ?>


      <a href="single_product.php?id=<?= htmlspecialchars($item[0]) ?>" class="btn">خواندن نظرات</a>
    </div>
    <hr>
    <?php } ?>


</body>
</html>