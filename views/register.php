<?php session_start();
if(isset($_SESSION['masage'])){
  echo $_SESSION['masage'];
}
unset($_SESSION['masage']);
?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<!-- <link href="images/favicon.png" rel="icon" /> -->
<title>ثبت نام</title>
<meta name="description" content="Login and Register Form Html Template">
<meta name="author" content="harnishdesign.net">

<!-- Web Fonts
========================= -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i' type='text/css'>

<!-- Stylesheet
========================= -->
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../css/all.min.css" />
<link rel="stylesheet" type="text/css" href="../css/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="../css/font.css" />
<!-- Colors Css -->
<link id="color-switcher" type="text/css" rel="stylesheet" href="../css/color-red.css" />
</head>
<body>



<?php

	$csrf_token = bin2hex(random_bytes(16));
	$_SESSION['register'] = $csrf_token;
?>


<!-- Preloader -->
<div class="preloader preloader-dark">
  <div class="lds-ellipsis">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>
<!-- Preloader End -->

<div id="main-wrapper" class="oxyy-login-register">
  <div class="hero-wrap min-vh-100">
    <div class="hero-mask opacity-4 bg-secondary"></div>
    <div class="hero-bg hero-bg-scroll" style="background-image:url('img/login-bg-5.jpg');"></div>
    <div class="hero-content d-flex min-vh-100">
      <div class="container my-auto">
        <div class="row">
          <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
            <div class="hero-wrap rounded shadow-lg p-4 py-sm-5 px-sm-5 my-4">
              <div class="hero-mask opacity-9 bg-dark"></div>
              <div class="hero-content">
                <!-- <div class="logo mb-4"> <a class="d-flex justify-content-center" href="index.html" title="Oxyy"><img src="img/logo.png" alt="Oxyy"></a> </div> -->
                <form id="registerForm" class="form-dark" method="post" action="../controller/user_controller.php">
                  <div class="form-group icon-group">
                    <input type="hidden" name="form-name" value="register">
                    <input type="hidden" name="csrf" value="<?= htmlspecialchars($csrf_token) ?>">
                    <input type="text" class="form-control" id="fullName" required placeholder="نام کاربری" maxlength="80" name="username">
                    <span class="icon-inside"><i class="fas fa-user"></i></span> </div>
                  <div class="form-group icon-group">
                    <input type="password" class="form-control" id="emailAddress" required placeholder="رمز عبور" maxlength="5" name="password">
                    <span class="icon-inside"><i class="fas fa-envelope"></i></span> </div>
                  <div class="form-group icon-group">
                    <input type="email" class="form-control" id="loginPassword" required placeholder="ایمیل" maxlength="100" name="email">
                    <span class="icon-inside"><i class="fas fa-lock"></i></span> </div>
                  <button class="btn btn-primary btn-block mt-4 mb-3" type="submit">ثبت نام</button>
                  <!-- <p class="text-center text-muted text-2 mt-2 mb-0">شما قبول دارید<a class="btn-link text-light" href="#">قوانین</a> و <a class="btn-link text-light" href="#">سیاست حریم خصوصی</a></p> -->
                </form>
                <div class="d-flex align-items-center mt-2 mb-3">
                  <hr class="flex-grow-1 border-dark">
                  <span class="mx-2 text-muted text-2">ورود با</span>
                  <hr class="flex-grow-1 border-dark">
                </div>
                <div class="d-flex  flex-column align-items-center mb-3">
                  <!-- <ul class="social-icons social-icons-rounded">
                    <li class="social-icons-facebook"><a href="#" data-toggle="tooltip" data-original-title="Sign Up with Facebook"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="social-icons-twitter"><a href="#" data-toggle="tooltip" data-original-title="Sign Up with Twitter"><i class="fab fa-twitter"></i></a></li>
                    <li class="social-icons-google"><a href="#" data-toggle="tooltip" data-original-title="Sign Up with Google"><i class="fab fa-google"></i></a></li>
                    <li class="social-icons-linkedin"><a href="#" data-toggle="tooltip" data-original-title="Sign Up with Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
                  </ul> -->
                </div>
                <p class="text-2 text-muted text-center mb-0">حساب کاربری دارید؟ <a class="btn-link text-light text-3" href="login.php">وارد شدن</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script --> 
<script src="../js/jquery.min.js"></script> 
<script src="../js/bootstrap.bundle.min.js"></script> 
<!-- Style Switcher --> 
<script src="../js/switcher.min.js"></script> 
<script src="../js/theme.js"></script>
</body>
</html>