<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
<title>لیست کاربران</title>    <link rel="stylesheet" href="../css/style.css">
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
        <li class="item-li i-categories"><a href="categories.php">دسته بندی ها</a></li>
        <li class="item-li i-comments"><a href="comments.html"> نظرات</a></li>
        <li class="item-li i-my__purchases"><a href="mypurchases.html">خرید ها</a></li>
        <li class="item-li i-my__purchases"><a href="panel.php">محصولات شما</a></li>
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
            <li><a href="index.html" >پیشخوان</a></li>
            <li><a href="courses.html" class="is-active">کاربران</a></li>
        </ul>
    </div>
    <br>
            <?php
            include("../partial/db.php");
            $username = $_GET['username'];
            $email = $_GET['email'];
            $ip = $_GET['ip'];
            $query = $conn->prepare("SELECT * FROM `users` WHERE (`status` =  'admin') AND (`username` LIKE '%$username%' OR `email` LIKE '%$email%' OR `ip` LIKE '%$ip%') ");
            $query->execute();
            $result = $query->get_result();
            $users = $result->fetch_all();
            ?>
        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه</th>
                    <th>نام کاربری </th>
                    <th>ایمیل</th>
                    <th>سطح کاربری</th>
                    <th>ای پی</th>
                    <th>آخرین بازدید</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user){?>
                <tr role="row" class="">
                    <td><a href=""><?= htmlspecialchars($user[0]) ?></a></td>
                    <td><a href=""><?= htmlspecialchars($user[1]) ?></a></td>
                    <td><?= htmlspecialchars($user[3]) ?></td>
                    <td><?= htmlspecialchars($user[6]) ?></td>
                    <td><?= htmlspecialchars($user[5]) ?></td>
                    <td><?= htmlspecialchars($user[4]) ?></td>
                    <td>
                        <a href="../controller/user_controller.php?id=<?=  htmlspecialchars($user[0]) ?>&form-name=delete_admin" class="item-delete mlg-15" title="حذف"></a>
                        <a href="edit_admin.php?id=<?= htmlspecialchars($user[0]) ?>" class="item-edit " title="ویرایش"></a>
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