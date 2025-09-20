<?php session_start();
include("../partial/db.php");

if(!isset($_SESSION['user_id']) && isset($_COOKIE['remember'])){
    $query = $conn->prepare("SELECT `id` FROM `users` WHERE `remember_token` = ?");
    $query->execute([$_COOKIE['remember']]);
    $users = $query->get_result()->fetch_assoc();

    if($users){
        $_SESSION['user_id'] = $users['id'] ?? '';
        $update_last_login_query = $conn->prepare("UPDATE `users` SET `last_login` = NOW() WHERE `id` = ?");
        $update_last_login_query->execute([$users['id']]);
    }
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگاه اینترنتی</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/style_index.css">

    <style>
        @font-face {
        font-family: "Vazir";
        src: url(../fonts/Vazir.ttf);
        }
        *{
            font-family: "Vazir";
        }
        .description p{
            font-size: 19px;
        }
        .image_product img{
            width: 80%;
            height: 10%;
            border-radius: 5px;
            margin-right: 50px;
        }
        #search{
           font-size: 20px;
            padding: 5px;
            cursor: pointer;
        }
    </style>

</head>
<body>

<!-- header section starts  -->

<header>

    <div class="header-1"> 
        <a href="#" class="logo"><i class="fas fa-shopping-basket"></i>groco</a>
        <form action="search_items.php" class="search-box-container" method="get">
            <input type="search" id="search-box" placeholder="جستجو کنید" name="search">
            <button type="submit" id="search">🔒</button>
        </form>

    </div>

    <div class="header-2">
        <div id="menu-bar" class="fas fa-bars"></div>

        <nav class="navbar">
            <a href="index.php">خانه</a>
            <a href="#category">دسته بندی</a>
            <a href="#product">محصولات</a>
            <?php if(!isset($_SESSION['user_id']) && !isset($_COOKIE['remember'])){ ?>
            <a href="register.php">ثبت نام</a>
            <a href="login.php">ورود</a>
            <?php }else{ ?>
                <a href="loguot.php">خروج</a>
            <?php }if(isset($_SESSION['admin'])){ ?>
                <a href="panel.php">ورود به پنل</a>
            <?php } ?>
        </nav>

        <div class="icons">
            <a href="cart_list.php" class="fas fa-shopping-cart">سبد خرید</a>
            <a href="user_likes.php" class="fas fa-heart"> مورد علاقه ها </a>
            <a href="profile_user.php" class="fas fa-user-circle"> پروفایل </a>
        </div>

    </div>
</header>

<!-- header section ends -->

<!-- home section starts  -->

<section class="home" id="home">

    <div class="content">
        <?php
        if(isset($_SESSION['masage'])){
            $user_id = $_SESSION['masage'];
            echo "<h1 style='font-size:50px'>$user_id</h1>";   
        }
        unset($_SESSION['masage']);
        ?>
        <h3 style="text-align: center;">خوش اومدی</h3>
    </div>
</section>

<!-- home section ends -->

<!-- banner section starts  -->

<section class="banner-container">

    <!-- <div class="banner">
        <img src="images/banner-1.jpg" alt="">
        <div class="content">
            <h3>پیشنهاد ویژه</h3>
            <p>حداکثر 45٪ تخفیف</p>
            <a href="#" class="btn">خرید کنید</a>
        </div>
    </div> -->

    <!-- <div class="banner">
        <img src="images/banner-2.jpg" alt="">
        <div class="content">
            <h3>پیشنهاد محدود</h3>
            <p>حداکثر 70٪ تخفیف</p>
            <a href="#" class="btn">خرید کنید</a>
        </div>
    </div> -->

</section>

<!-- banner section ends -->

<!-- category section starts  -->

<?php
include("../controller/product.php");
$products = new products();
$items_category = $products->all_category();
?>

<section class="category" id="category">

    <h1 class="heading"><span>دسته بندی ها</span></h1>

    <div class="box-container">
        <?php foreach($items_category as $category){?>
        <div class="box">
            <h3> نام دسته بندی  :  <?= htmlspecialchars($category[1]) ?>  <?= htmlspecialchars($category[2]) ?> </h3>
            <a href="category_list.php?id=<?= htmlspecialchars($category[0]) ?>" class="btn">الان خرید کن</a>
        </div>
            <?php } ?>
    </div>

</section>

<!-- category section ends -->

<!-- product section starts  -->

<?php
$items_product = $products->product_item();
?>

<section class="product" id="product">

    <h1 class="heading">همه <span>محصولات</span></h1>

    <div class="box-container">
        <?php foreach($items_product as $item){?>
        <div class="box">
            <div class="icons">

                <?php if(isset($_SESSION['user_id'])){ ?>


                <?php if(!$products->likes_deslike($_SESSION['user_id'],$item[0])){ ?>
                <a href="../controller/like_controller.php?id=<?= htmlspecialchars($item[0]) ?>&form-name=like" class="fas fa-heart">لایک</a>
                <a href="../controller/like_controller.php?id=<?= htmlspecialchars($item[0]) ?>&form-name=deslike" class="fas fa-heart">دیسلایک</a>
                  <?php }else{ ?>
                    <button>قبلا نظر خود گفته اید</button>

                <?php }}?>

                <a href="single_product.php?id=<?= htmlspecialchars($item[0]) ?>" class="fas fa-eye"></a>
            </div>
            <a href="single_product.php?id=<?= htmlspecialchars($item[0]) ?>">
            <img src="images/product-1.png" alt="">
            <h1> نام محصول:  <?= htmlspecialchars($item[1]) ?></h1>
            <br>
            <div class="image_product">
            <img src="<?= htmlspecialchars($item[3]) ?>">
            </div>
            <div class="description">
                <p> توضیحات:  <?= htmlspecialchars($item[2]) ?> </p>
            </div>
            <div class="price"> <?= htmlspecialchars(number_format($item[5],0,'.','/')) ?> تومان  </div>
            </a>
            <div class="quantity">
                <span>تعداد : <?= htmlspecialchars($item[4]) ?></span>
            </div>
                <div>  
                    
                <?php if(!$products->cart($_SESSION['user_id'] ?? '',$item[0])){
                    if(isset($_SESSION['user_id'])){ ?>
                
                <form action="../controller/cart_controller.php" method="post">
                <input type="hidden" name="form-name" value="add_cart">
                <input type="hidden" name="id" value="<?= htmlspecialchars($item[0]) ?>">
                <input type="hidden" name="price" value="<?= htmlspecialchars($item[5]) ?>">
                <label style="font-size:22px;">تعداد محصول را انتخاب کن:</label>
                <input type="number" min="1"name="count_product" max="<?= htmlspecialchars($item[4]) ?>" value="1" style="font-size:20px;color:green">
                <button type="submit" class="btn" style="width:365px">افزودن به سبد خرید</button>
                </form>

                <?php }else echo "<a href='login.php'><button class='btn' style='width:100%;background-color:red'>برا ی خرید ورود کنید</button></a>";}else{ ?>

                <a href="cart_list.php" class="btn" style="color:green;background:yellow">به سبد خرید اضافه شد</a>

                <?php } ?>

            </div>
            <a href="../controller/download_image.php?id=<?= htmlspecialchars($item[0]) ?>&form-name=download" class="btn">مشاهده تصویر</a>     
        </div>
        <?php } ?>
</section>

<!-- product section ends -->

<!-- deal section starts  -->

<!-- deal section ends -->

<!-- contact section starts  -->


<!-- contact section ends -->

<!-- newsletter section starts  -->
<!-- 
<section class="newsletter">

    <h3>ما را برای آخرین به روزرسانی ها مشترک کنید</h3>

    <form action="">
        <input class="box" type="email" placeholder="ایمیل خود را وارد کنید">
        <input type="submit" value="مشترک شوید" class="btn">
    </form>

</section> -->

<!-- newsletter section ends -->

<!-- footer section starts  -->

<section class="footer">

    <div class="box-container">

        <div class="box">
            <a href="#" class="logo"><i class="fas fa-shopping-basket"></i>groco</a>
            <!-- <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز </p> -->
            <div class="share">
                <a href="#" class="btn fab fa-facebook-f"></a>
                <a href="#" class="btn fab fa-twitter"></a>
                <a href="#" class="btn fab fa-instagram"></a>
                <a href="#" class="btn fab fa-linkedin"></a>
            </div>
        </div>

    </div>

</section>

<!-- footer section ends -->

 
<!-- custom js file link  -->
<script src="../js/script.js"></script>
    
</body>
</html>