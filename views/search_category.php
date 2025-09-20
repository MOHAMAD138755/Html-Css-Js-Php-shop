<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
<title>قالب پنل مدیریت</title>    <link rel="stylesheet" href="../css/style.css">
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
    <li class="item-li i-users"><a href="users.html"> کاربران</a></li>
        <li class="item-li i-categories"><a href="categories.php">دسته بندی ها</a></li>
        <li class="item-li i-comments"><a href="comments.html"> نظرات</a></li>
        <li class="item-li i-my__purchases"><a href="mypurchases.html">خرید ها</a></li>
    </ul>
</div>
<div class="content">
    <div class="header d-flex item-center bg-white width-100 border-bottom padding-12-30">
        <div class="header__right d-flex flex-grow-1 item-center">
            <span class="bars"></span>
            <a class="header__logo" href="https://netcopy.ir"></a>
        </div>
        <div class="header__left d-flex flex-end item-center margin-top-2">
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
        </div>
        <div class="row bg-white no-gutters font-size-13">
            <div class="table__box">
                <table width="100%" class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row"> 
                            <th>شناسه</th>
                            <th>نام دسته بندی</th>
                            <th>نام انگلیسی دسته بندی</th>
                            <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("../controller/product.php");
                        $title = $_GET['title'];
                        $title_english = $_GET['title_english'];
                        $item = new products(); $categoryies = $item->search_category($title,$title_english);
                        foreach($categoryies as $category){    
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($category[0]) ?></td>
                            <td><?= htmlspecialchars($category[1]) ?></td>
                            <td><?= htmlspecialchars($category[2]) ?></td>
                             <td>
                                <a href="../controller/product_controller.php?id=<?= htmlspecialchars($category[0]) ?>&form-name=delete_product" class="item-delete mlg-15" title="حذف"></a>
                                <a href="edit_products.php?id=<?= htmlspecialchars($category[0]) ?>" class="item-edit " title="ویرایش"></a>
                            </td>
                        </tr> 
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
<script src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/js.js"></script>
</html>