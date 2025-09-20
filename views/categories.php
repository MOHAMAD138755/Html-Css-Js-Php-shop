<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
<title>دسته بندی ها</title>    <link rel="stylesheet" href="../css/style.css">
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
        <li class="item-li i-comments"><a href="comments.php"> نظرات</a></li>
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
            <li><a href="categories.html.html" class="is-active">دسته بندی ها</a></li>
        </ul>
    </div>
    <div class="main-content padding-0 categories">
                <div class="t-header-search">
                <form action="search_category.php" method="get">
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی دسته بندی">
                        <div class="t-header-search-content ">
                            <input type="text"  class="text"  placeholder="نام دسته بندی به فارسی" name="title">
                            <input type="text"  class="text" placeholder="نام دسته بندی به انگلیسی" name="title_english">
                            <button type="submit" class="btn btn-netcopy_net">جستجو</button>
                        </div>
                    </div>
                </form>
            </div>
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">دسته بندی ها</p>
                <div class="table__box">
                    <?php 
                    include("../partial/db.php");
                    $query = $conn->prepare("SELECT * FROM `category`");
                    $query->execute();
                    $items = $query->get_result()->fetch_all();
                    ?>
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>نام دسته بندی</th>
                            <th>نام انگلیسی دسته بندی</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach($items as $item){ ?>
                        <tr role="row" class="">
                            <td><a href=""><?= htmlspecialchars($item[0]) ?></a></td>
                            <td><a href=""><?= htmlspecialchars($item[1]) ?></a></td>
                            <td><?= $item[2] ?></td>
                            <td>
                                <a href="../controller/category_controller.php?id=<?= htmlspecialchars($item[0]) ?>&form-name=deny_category" class="item-delete mlg-15" title="حذف"></a>
                                <a href="edit-category.php?id=<?= htmlspecialchars($item[0]) ?>" class="item-edit " title="ویرایش"></a>
                            </td>
                            <tr>
                                <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4 bg-white">
                  <p class="box__title">ایجاد دسته بندی جدید</p>
                  <form action="../controller/product_controller.php" method="post" class="padding-30">
                    <input type="hidden" name="form-name" value="add_category">
                      <input type="text" placeholder="نام دسته بندی" class="text" name="title" id="title" required>
                      <input type="text" placeholder="نام انگلیسی دسته بندی" class="text" name="title_english" id="title_english" required>
                      <button class="btn btn-netcopy_net" type="submit">اضافه کردن</button>
                  </form>
            </div>
        </div>
    </div>
</div>
</body>
<script src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/js.js"></script>
<script src="../js/tagsInput.js"></script>
</html>