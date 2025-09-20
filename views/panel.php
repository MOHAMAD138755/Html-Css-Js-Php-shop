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
        <li class="item-li i-comments"><a href="comments.php"> نظرات</a></li>
        <li class="item-li i-my__purchases"><a href="mypurchases.html">خرید ها</a></li>
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
        <div class="t-header-search">
                <form action="search_product.php" method="get">
                    <div class="t-header-searchbox font-size-13">
                        <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی کالا">
                        <div class="t-header-search-content ">
                            <input type="text"  class="text"  placeholder="نام کالا" name="name_product">
                            <input type="text"  class="text" placeholder="قیمت کالا" name="price_product">
                            <button type="submit" class="btn btn-netcopy_net">جستجو</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row bg-white no-gutters font-size-13">
            <div class="table__box">
                <table width="100%" class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row"> 
                        <th>نام کالا</th>
                        <th>توضیحات</th>
                        <th>عکس کالا</th>
                        <th>تعداد</th>
                        <th>قیمت کالا</th>
                        <th>دسته بندی</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("../controller/product.php");
                        include("../partial/db.php");
                        $item = new products(); $products = $item->all_product();
                        foreach($products as $product){ 
                                $stmt = $conn->prepare("SELECT * FROM `category` WHERE `id` = ?");
                                $stmt->bind_param("i", $product[6]);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $category_item = $result->fetch_assoc();    
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($product[1]) ?></td>
                            <td><?= htmlspecialchars($product[2]) ?></td>
                            <td><img src="<?= htmlspecialchars($product[3])?>" style="width: 100px; height: 100px" ></td>
                            <td><?= htmlspecialchars($product[4]) ?></td>
                            <td><?= htmlspecialchars(number_format($product[5],0,'.','/')) ?>-تومان</td>
                            <td><?= htmlspecialchars($category_item['title']) ?></td>
                             <td>
                                <a href="../controller/product_controller.php?id=<?= htmlspecialchars($product[0]) ?>&form-name=delete_product" class="item-delete mlg-15" title="حذف"></a>
                                <a href="edit_products.php?id=<?= htmlspecialchars($product[0]) ?>" class="item-edit " title="ویرایش"></a>
                            </td>
                        </tr> 
                        <?php } ?>
                    </tbody>
                </table>
                <div class="add_product">
                    <a href="add_product.php">
                        <button type="button">افزودن کالا</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="../js/jquery-3.4.1.min.js"></script>
<script src="../js/js.js"></script>
</html>