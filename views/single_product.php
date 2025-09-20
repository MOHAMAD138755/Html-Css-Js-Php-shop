
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
img{
    width:150px;
    height:150px;
    border-radius:50%;
    background-color:gray;
}

  </style>
</head>
<body>


	<?php
  session_start();
    include("../controller/product.php");
    $product = new products();
    $product_items = $product->single_product($_GET['id']);
	?>


  <!-- نمایش محصول -->
  <div class="container">
    <h1 class="post-title">نام محصول: <?= htmlspecialchars($product_items['name']) ?></h1>
    <div class="post-meta">توضیحات: <?= htmlspecialchars($product_items['description']) ?></div>
    <img src=" <?= htmlspecialchars($product_items['image']) ?>" alt="تصویر مصحول" class="post-image" width="200px" height="400px">
    <div class="post-content">
      <p>
        این یک متن نمونه برای پست تکی است. در این قسمت می‌توان متن کامل مقاله یا پست وبلاگی را قرار داد. همچنین می‌توانید از پاراگراف‌های مختلف، نقل قول‌ها، تصاویر، ویدیوها و ... درون این بخش استفاده کنید.
      </p>
      <p>
        هدف از طراحی صفحه سینگل پست این است که کاربر بتواند محتوای کامل یک مطلب را به‌صورت خوانا و مرتب مشاهده کند.
      </p>
    </div>

    <hr>  



  <!--  نمایش کامنت ها به همراه کاربران و فرم ریپلای و نمایش آن-->

  <?php $comments = $product->comments_list($_GET['id']);
  foreach($comments as $comment){
    $users = $product->comment_list_user($comment[2]);
  ?>
  <div class="show_comment">
    <div class="image_user">
          <img src="<?= htmlspecialchars($users['profile']) ?? ''?>" alt="user_logo">
    </div>
    <div class="comment_text">
        <p> نام کاربر: <?= htmlspecialchars($users['username']) ?> </p>
        <p> نظر:  <?= htmlspecialchars($comment[1]) ?> </p>
        <p> نوع کاربر: <?= htmlspecialchars($users['status']) ?> </p>
    </div>
  
    <br>
    
    <?php $reply_comments = $product->reply_list($_GET['id'],$comment[0]);
     foreach($reply_comments as $item){
      $users_reply = $product->reply_list_user($item[2]);?>
     <div class="comment_text_answer">
      <div class="image_user">
          <img src="<?= htmlspecialchars($users_reply['profile']) ?>" alt="user_logo">
    </div>
        <p> نام کاربر:  <?= htmlspecialchars($users_reply['username']) ?></p>
        <p> ریپلای: <?= htmlspecialchars($item[1]) ?> </p></p>
        <p> نوع کاربر: <?= htmlspecialchars($users_reply['status']) ?> </p>
    </div>
    <?php } if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != $comment[2]) {?>
    <div class="reply-form">

      <form method="post" action="../controller/comment_controller.php">
        <input type="hidden" name="form-name" value="add_comment_reply">
        <input type="hidden" name="comment_id" value="<?= htmlspecialchars($comment[0]) ?>">
        <input type="hidden" name="product_id" value="<?= htmlspecialchars($_GET['id']) ?>">
        <textarea placeholder="ریپلای" id="comment_body" cols="30" rows="10" name="comment_body_reply" required></textarea>
        <button type="submit"></button>
      </form>
      <br>
    </div>
    <?php } ?>
  </div>
    <hr>
  <?php } ?>





    <br>
    <!-- فرم اضافه کردن کامنت -->
     <?php if(isset($_SESSION['user_id'])) {?>
    <section class="contact" id="contact">
    <h2 class="heading"> نظر خود را   <span>بنویسید</span></h2>
    <form action="../controller/comment_controller.php" method="post">
        <input type="hidden" name="form-name" value="add_comment">
        <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id']) ?>">
        <textarea placeholder="پیام" id="comment_body" cols="30" rows="10" name="comment_body" required></textarea>
        <br>
        <input type="submit" value="ارسال پیام" class="btn">
    </form>
    </section>

    <?php }else{?>
      <b style="color:red;">کاربر گرامی برای وارد کردن نظر خود در سایت ورود کنید</b>
    <?php } ?>





</body>
</html>