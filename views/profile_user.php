
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
.user_image img{
    width:150px;
    height:150px;
    border-radius:50%;
    background-color:gray;
}
  </style>
</head>
<body>


    <?php session_start();

    $csrf_token = bin2hex(random_bytes(16));
	$_SESSION['csrf_edit_profile'] = $csrf_token;

    include("../controller/product.php");
    if(isset($_SESSION['user_id'])){
        $product = new products();      $users = $product->users($_SESSION['user_id']); $user_id = $_SESSION['user_id'];
    ?>
  
  <div class="container">
      <h2 style="text-align:center">مشخصات شما</h2>
        <?php if(isset($_SESSION['masage'])) echo $_SESSION['masage']; unset($_SESSION['masage']); ?>


    <h1 class="post-title">نام شما: <?= htmlspecialchars($users['username']) ?> </h1>
    <div class="post-meta">ایمیل شما: <?= htmlspecialchars($users['email']) ?> </div>
    <div class="user_image"><img src=" <?= htmlspecialchars($users['profile']) ?? ''?> "></div>
    <div class="edit">

        <a href="edit_user_profile.php">
        <button>ویرایش پروفایل</button>
        </a>

    </div>
    <div class="post-content">
      <p>بیوگرافی: </p>
      <p>
           <?= htmlspecialchars($users['biography']) ?? ''?>
      </p>
    </div>
    <hr>  

    <?php }else{
        header("location: login.php");
    } ?>

</body>
</html>