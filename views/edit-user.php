<!doctype html>
<html lang="fa" dir="rtl">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="../css/font.css">
<title>ویرایش  مشخصات کاربران</title>
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
			margin-right: 120px;
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
        #title{
            margin-right: 65px;
        }
        #status{
            position: relative;
            left:10px;
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
		$_SESSION['csrf_edit_user'] = $csrf_token;

    include("../partial/db.php");
    $id = $_GET['id'];
    $query = $conn->prepare("SELECT * FROM `users` WHERE `id` = ?");
    $query->execute([$id]);
    $users = $query->get_result()->fetch_all();
    ?>
	<div class="container">
		<div class="logo">
			<img src="../img/logo.webp" alt="logo email" width="150px" height="150px">
		</div>
		<div class="form">
			<h2>ویرایش اطلاعات ادمین</h2>
			<form action="../controller/user_controller.php" method="post">
				<input type="hidden" name="csrf" value="<?= htmlspecialchars($csrf_token) ?>">
				<input type="hidden" name="form-name" value="edit_user">
                <input type="hidden" name="id" value="<?= htmlspecialchars($users[0][0]) ?>">
                <label for="username">نام کاربری: </label>
				<input type="text" name="username" id="username" value="<?= htmlspecialchars($users[0][1]) ?>">
                <br>
				<label for="email">ایمیل کاربر: </label>
				<input type="email" name="email" id="email" value="<?= htmlspecialchars($users[0][3]) ?>">
				<br>
				<label for="status">سطح کاربری: </label>
				<input name="status" id="status" type="text"  value="<?= htmlspecialchars($users[0][6]) ?>" >
				<br>
				<button type="submit">ویرایش  کاربر</button>
			</form>
		</div>
	</div>
</body>
</html>