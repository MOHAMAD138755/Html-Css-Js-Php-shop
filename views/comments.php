<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
<title>نظرات</title>    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/responsive_991.css" media="(max-width:991px)">
    <link rel="stylesheet" href="../css/responsive_768.css" media="(max-width:768px)">
    <link rel="stylesheet" href="../css/font.css">
</head>
<body>
<div class="sidebar__nav border-top border-left  ">
    <span class="bars d-none padding-0-18"></span>
    <a class="header__logo  d-none" href="https://netcopy.ir"></a>
    <div class="profile__info border cursor-pointer text-center">
        <div class="avatar__img"><img src="img/pro.jpg" class="avatar___img">
            <input type="file" accept="image/*" class="hidden avatar-img__input">
            <div class="v-dialog__container" style="display: block;"></div>
            <div class="box__camera default__avatar"></div>
        </div>
        <span class="profile__name">پنل ادمین</span>
    </div>

    <ul>
<li class="item-li i-users"><a href="users.php"> کاربران</a></li>
        <li class="item-li i-categories"><a href="categories.php">دسته بندی ها</a></li>
        <li class="item-li i-my__purchases"><a href="mypurchases.html">خرید ها</a></li>
        <li class="item-li i-my__purchases"><a href="panel.php">محصولات شما</a></li>
        <li class="item-li i-my__purchases"><a href="users_likes.php">لایک ها و دیسلایک ها</a></li>
        <li class="item-li i-users"><a href="index.php">صفحه اصلی سایت</a></li>
        <li class="item-li i-users"><a href="loguot.php">خروج</a></li>
    </ul>

</div>
<div class="content">
    <div class="header d-flex item-center bg-white width-100 border-bottom padding-12-30">
        <div class="header__right d-flex flex-grow-1 item-center">
            <span class="bars"></span>
            <a class="header__logo" href="https://netcopy.ir"></a>
        </div>
        <div class="header__left d-flex flex-end item-center margin-top-2">
            <span class="account-balance font-size-12">موجودی : 2500,000 تومان</span>
            <div class="notification margin-15">
                <a class="notification__icon"></a>
                <div class="dropdown__notification">
                    <div class="content__notification">
                        <span class="font-size-13">موردی برای نمایش وجود ندارد</span>
                    </div>
                </div>
            </div>
            <a href="" class="logout" title="خروج"></a>
        </div>
    </div>
    <div class="breadcrumb">
        <ul>
            <li><a href="index.html">پیشخوان</a></li>
            <li><a href="comments.html" class="is-active"> نظرات</a></li>
        </ul>
    </div>
    <div class="main-content">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="comments.php"> همه نظرات</a>
            </div>
        </div>



        <?php
        include("../controller/product.php");
        $product = new products();
        $comments = $product->comment_list_user_panel();
        ?>



        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>ارسال کننده</th>
                    <th>برای</th>
                    <th>دیدگاه</th>
                    <th>نوع کاربر</th>
                    <th>تعداد پاسخ ها برای این محصول</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($comments as $comment){ 
                    $count_product = $product->count_comment($comment[3]);
                    ?>
                <tr role="row" >    
                    <td><a href=""> <?= htmlspecialchars($comment[0]) ?> </a></td>
                    <td><a href=""> <?= htmlspecialchars($comment[6]) ?> </a></td>
                    <td><a href=""> <?= htmlspecialchars($comment[16]) ?> </a></td>
                    <td> <?= htmlspecialchars($comment[1]) ?> </td>
                    <td><a href=""> <?= htmlspecialchars($comment[11]) ?> </a></td>
                    <td class="text-success"> <?= htmlspecialchars($count_product[0][0]) ?> </td>
                    <td>
                        <a href="../controller/comment_controller.php?id=<?= htmlspecialchars($comment[0]) ?>&form-name=delete_comment" class="item-delete mlg-15" title="حذف"></a>
                    </td>
                </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
<script src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/js.js"></script>
</html>