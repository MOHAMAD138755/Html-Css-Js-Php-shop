<!doctype html>
<html lang="fa" dir="rtl">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../css/font.css">
<title>افزودن کالا</title>
	<style>
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		@font-face{
			font-family: custon_font;
			src: url("font/BTitrBd.ttf");
		}
		body{
			width: 100%;
			height: 500px;
			font-family: "Vazir";
			background: linear-gradient(to left ,blue,white);
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.container{
			width: 70%;
			height: auto;
			background-color: white;
			border-radius: 10px;
			display: flex;
			justify-content: space-around;
			align-items: center;
		}
		.container .logo{
			width: 20%;
		}
		.container .logo img{
			transform: rotate(-30deg);
		}
		.container .form form input{
			margin-top: 20px;
			width: 250px;
			height: 30px;
			border: none;
			outline: none;
			border-radius: 5px;
			background-color: gray;
			transition: .2s all;
			margin: 10px;
		}
		.container .form form input:focus{
			border: 2px solid blue;
			font-size: 17px;
		}
		.form h2{
			text-align: center;
		}
		button{
			width: 200px;
			height: 25px;
			margin-top: 20px;
			margin-right: 100px;
			margin-bottom: 20px;
			background-color: green;
			border: none;
			outline: none;
			border-radius: 5px;
			font-size: 17px;
			cursor: pointer;
		}
		button:hover{
			transition: .3s all;
			background: darkgreen;
			color: white;
		}
		textarea{
			margin-top: 10px;
			resize: none;
			background-color: gray;
			width: 250px;
			height: auto;
			border: none;
			outline: none;
			border-radius: 5px;
			margin-right: 10px;
		}
		#name{
			margin-right: 25px;
		}
		#count{
			margin-left: 5px;
		}
		#price::placeholder{
			color: white;
			text-align: center;
			font-family: "vasir";
		}
		select{
			width: 250px;
			height: 25px;
			margin-right: 80px;	
			margin-top: 10px;
			background-color: darkgray;
			color: white;	
		}
		@media (max-width:750px){
			textarea{
				margin-top: 30px;
			}
			.container{
				height: auto;
				flex-direction: column-reverse;
				margin-top: 200px;
			}
			.logo img{
				position: relative;
				left: 30px;
			}
			select{
				margin-top:40px; 
			}
		}
		@media (max-width:550px){
			.container{
				width: 80%;
			}
			.container .form form input{
				position: relative;
				top: 20px;
			}
			label{
				position: relative;
				top: 15px;
			}
			button{
				margin-top: 50px;
			}
		}
		@media (max-width:430px){
			.container{
				width: 90%;
			}
/*
			.container .form form input{
				position: relative;
				top: 10px;
			}
*/
		}
	</style>
</head>

<body>
	<?php 
		session_start();
		$csrf_token = bin2hex(random_bytes(16));
		$_SESSION['csrf_add_product'] = $csrf_token;

    include("../partial/db.php");
    $query = $conn->prepare("SELECT * FROM `category`");
    $query->execute();
     $items = $query->get_result()->fetch_all();
    ?>
	<div class="container">
		<div class="logo">
			<img src="../img/logo.webp" alt="logo email" width="150px" height="150px">
		</div>
		<div class="form">
			<h2>افزودن کالا</h2>
			<form action="../controller/product_controller.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="csrf" value="<?= htmlspecialchars($csrf_token) ?>">
				<input type="hidden" name="form-name" value="add_product">
				<label for="name">نام کالا: </label>
				<input type="text" name="name" id="name" required maxlength="50">
				<br>
				<label for="description">توضیحات: </label>
				<textarea rows="3" name="description" id="description" required></textarea>
				<br>
				<label for="count">تعداد کالا: </label>
				<input type="text" name="count" id="count" required>
				<br>
				<label for="price">قیمت کالا: </label>
				<input type="text" name="price" id="price" placeholder="تومان" required>
				<br>
				<label for="image">عکس کالا: </label>
				<input type="file" name="image" id="image" required>
				<br>
				<select name="category" id="category" required>
					<?php foreach($items as $item){ ?>
					<option><?= htmlspecialchars($item[1]) ?></option>
					<?php } ?>
				</select>
				<br>
				<button type="submit">افزودن کالا</button>
			</form>
		</div>
	</div>
</body>
</html>