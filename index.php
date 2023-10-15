<?
include './app/database/connect.php';
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="msapplication-TileColor" content="#da532c" />
    <meta name="theme-color" content="#ffffff" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png" />
    <link rel="manifest" href="assets/favicon/site.webmanifest" />
    <link rel="mask-icon" href="assets/favicon/safari-pinned-tab.svg" color="#5bbad5" />

    <title>Кафе "MyWay"</title>
</head>

<body class="menu-closed">

    <header class="header">
        <nav class="nav">
            <div class="nav-bg">
                <div class="container">
                    <div class="nav-row">
                        <div>
                            <button class="nav__burger-btn" id="burger"><span></span><span></span><span></span></button>
                        </div>
                        <div class="logo">
                            <a href=""><img class="logo_img" src="assets/img/logo.png" alt="" /></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="list">
                <div class="container">

                    <ul class="nav-list">
                        <li class="nav-list__item">
                            <a href="./index.php" class="nav-list__link underline-one">Главная</a>
                        </li>
                        <li class="nav-list__item">
                            <a href="" class="nav-list__link underline-one">Меню</a>
                        </li>
                        <li class="nav-list__item">
                            <a href="" class="nav-list__link underline-one">Новости и статьи</a>
                        </li>
                        <li class="nav-list__item">
                            <a href="" class="nav-list__link underline-one">Контакты</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="header__wrapper">
            <ul class="header-list">
                <li>
                    <h1 class="header__title">
                        <strong>Суши или пицца?</br> Найди свой путь в кафе MyWay!</strong>
                    </h1>
                </li>
                <li class="header__text">
                    <h2>Доставка с 10-00 до 00-00.</h2>
                    <h2>(8-937-087-30-90, 8-906-406-06-07)</h2>
                </li>
                <li>
                    <a href="" class="btn">Позвонить</a>
                </li>
            </ul>
        </div>
    </header>
    <section class="menu">
        <div class="title">
            <strong class="title__underline">Меню</strong>
        </div>
        <div class="container">
            <?
            $sql = 'SELECT * FROM category';
            $q = mysqli_query($db_connection, $sql);
            $category = array();
            while ($row = mysqli_fetch_assoc($q)) {
                $category[] = $row;
            }
            ?>
            <ul class="menu-list scrolling-wrapper">
                <? foreach ($category as $cat) { ?>
                    <li class="list__item list__item-active">
                        <button id="category_<?= $cat['id'] ?>"
                            class="category_id_selector button menu__color underline-one"
                            data-target="#div<?= $cat['id'] ?>"><?= $cat['caption'] ?></button>
                    </li>
                <? } ?>
            </ul>
            <div class="menu-price">
                <? $sql = 'SELECT * FROM subcategory';
                $q = mysqli_query($db_connection, $sql);
                $subcategory = array();
                while ($row = mysqli_fetch_assoc($q)) {
                    $subcategory[] = $row;
                }
                foreach ($subcategory as $sub_cat) {
                    ?>

                    <div class="div subcategory_<?= $sub_cat['category_id'] ?>" data-id="<?= $sub_cat['category_id'] ?>"
                        id="div<?= $sub_cat['category_id'] ?>">

                        <div class="menu-title">
                            <h2>
                                <?= $sub_cat['caption'] ?>
                            </h2>
                            <h2>
                                <?= $sub_cat['sizing'] ?>
                            </h2>
                        </div>
                        <div class="pizza__list">
                            <? $sql = 'SELECT * FROM menu where subcategory_id =' . mysqli_real_escape_string($db_connection, $sub_cat['id']);
                            $q = mysqli_query($db_connection, $sql);
                            while ($row = mysqli_fetch_assoc($q)) {
                                ?>
                                <ul class="products__list-items">
                                    <li>
                                        <div class="product-list__item">
                                            <h3 class="product-list__item-name">
                                                <?= $row['caption'] ?>
                                            </h3>
                                            <h3 class="product-list__item-price">
                                                <?= $row['price'] ?>
                                            </h3>
                                        </div>
                                        <p class="product__description">(
                                            <?= $row['description'] ?>)
                                        </p>
                                    </li>
                                </ul>
                            <? } ?>
                        </div>
                    </div>
                <? } ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.price__pizza').each(function (i, obj) {
                    // console.log(i);
                    console.log(obj);
                    obj.style.display = 'none';
                })
                $('.category_id_selector').on('click', function (e) {
                    console.log(e.target);
                })
            })
        </script>
    </section>
    <section class="news">
        <div class="title">
            <strong class="title__underline">Новости</strong>
        </div>
        <div class="container">
            <? $sql = 'SELECT * FROM blog';
            $q = mysqli_query($db_connection, $sql);
            $subcategory = array();
            while ($row = mysqli_fetch_assoc($q)) {
                $subcategory[] = $row;
            }
            foreach ($subcategory as $blog) {
                ?>
                <div class="news-block">
                    <div class="news-block-title">
                        <h3>
                            <?= $blog['caption'] ?>
                        </h3>
                    </div>
                    <div class="news-block-description" style="flex: 70%">
                        <div class="block-description-text">
                            <p>
                                <?= $blog['text'] ?>
                            </p>
                        </div>
                        <div class="block-description-img" style="flex: 30%">
                            <img src="<?= $blog['img'] ?>" alt="<?= $blog['img'] ?>">
                        </div>

                    </div>
                </div>
            <? } ?>
        </div>
    </section>
    </main>
    <footer>
        <section class="contacts">
            <div class="title">
                <strong class="title__underline">Контакты</strong>
            </div>
            <div class="contacts__map">
                <iframe
                    src="https://yandex.ru/map-widget/v1/?um=constructor%3Ac3de0bd0d30cd631c5d6433b52ef1c366f0486520a1491409b120997a66f32d8&amp;source=constructor"
                    width="900" height="400" frameborder="0"></iframe>
            </div>
        </section>
    </footer>
    <script defer src="assets/js/main.js"></script>

</body>

</html>