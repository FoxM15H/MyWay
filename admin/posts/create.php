<?php ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="msapplication-TileColor" content="#da532c" />
    <meta name="theme-color" content="#ffffff" />
    <link rel="stylesheet" href="../../assets/css/admin.css" />
    <link rel="apple-touch-icon" sizes="152x152" href="../../assets/favicon/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../../assets/favicon/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/favicon/favicon-16x16.png" />
    <link rel="manifest" href="../../assets/favicon/site.webmanifest" />
    <link rel="mask-icon" href="../../assets/favicon/safari-pinned-tab.svg" color="#5bbad5" />

    <title>Кафе "MyWay"</title>
</head>

<body class="menu-closed">
    <nav class="nav">
        <div class="container">
            <div class="nav-row">
                <!-- <div class="logo">
          </div> -->
                <button class="nav__burger-btn" id="burger"><span></span><span></span><span></span></button>
                <a href=""><img class="logo_img" src="../../assets/img/logo.png" alt="" /></a>
                <div class="list">
                    <ul class="nav-list">
                        <li class="nav-list__item">
                            <a href="./index.html" class="nav-list__link underline-one">Главная</a>
                        </li>
                        <li class="nav-list__item">
                            <a href="" class="nav-list__link underline-one">Редактирование меню</a>
                        </li>
                        <li class="nav-list__item">
                            <a href="" class="nav-list__link underline-one">Редактирование постов</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <header class="header">
        <div class="header__wrapper">
            <h1 class="header__title">
                <strong>Хочешь съесть суши. Хочешь съесть пиццу. Кафе "MyWay"</strong>
            </h1>
            <div class="header__text">
                <h2>Доставка с 10-00 до 00-00</h2>
                <h2>(8-937-087-30-90, 8-906-406-06-07)</h2>
            </div>
            <a href="#!" class="btn">Позвонить</a>
        </div>
    </header>
    <main>
        <section class="menu">
            <div class="title">
                <strong class="title__underline">Редактирование меню</strong>
            </div>

            <div class="container menu__cat-subcat-dish">
                <div class="add-category-div">
                    <h3 style="font-size: 20px;">Добавление категории</h3>
                    <form id="add-category-form" class="form-menu-category">

                        <label for="category">Название категории:</label>
                        <input type="text" id="category_nigger" name="category">
                        <button type="submit" class="c-button">Добавить категорию</button>
                    </form>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                        function getSubcategoryByCategoryID() {
                            var category_id = $('#category').val();
                            if (category_id == '') {
                                // $('#subcategory').children()
                            }
                            // получение списка подкатегорий из базы данных
                            $.ajax({
                                url: 'subcategory.php?action=getSubcategoryByCategoryID',
                                type: 'POST',
                                data: {
                                    category_id: category_id
                                },
                                success: function (data) {
                                    var options = '';
                                    options +=
                                        '<option value="0" disabled selected>Выберите Подкатегорию</option>';
                                    for (var i = 0; i < data.length; i++) {
                                        options += '<option value="' + data[i].id + '">' + data[i].caption +
                                            '</option>';
                                    }
                                    getDishListBySubcategoryID()
                                    $('#subcategory').html(options);
                                }
                            });
                        }

                        function getSubcategoryByCategoryID2() {
                            var category_id = $('#categories').val();
                            if (category_id == '') {
                                // $('#subcategory').children()
                            }

                            // получение списка подкатегорий из базы данных
                            $.ajax({
                                url: 'subcategory.php?action=getSubcategoryByCategoryID',
                                type: 'POST',
                                data: {
                                    category_id: category_id
                                },
                                success: function (data) {
                                    var options = '';
                                    options +=
                                        '<option value="0" disabled selected>Выберите Подкатегорию</option>';
                                    for (var i = 0; i < data.length; i++) {

                                        options += '<option value="' + data[i].id + '">' + data[i].caption +
                                            '</option>';

                                    }
                                    $('#subcategories').html(options);
                                    $('#dish_caption').empty();
                                }
                            });
                        }

                        function getSubcategoryByCategoryID3() {
                            var category_id = $('#categories1').val();
                            if (category_id == '') {
                                // $('#subcategory').children()
                            }

                            // получение списка подкатегорий из базы данных
                            $.ajax({
                                url: 'subcategory.php?action=getSubcategoryByCategoryID',
                                type: 'POST',
                                data: {
                                    category_id: category_id
                                },
                                success: function (data) {
                                    var options = '';
                                    options +=
                                        '<option value="0" disabled selected>Выберите Подкатегорию</option>';
                                    for (var i = 0; i < data.length; i++) {

                                        options += '<option value="' + data[i].id + '">' + data[i].caption +
                                            '</option>';

                                    }
                                    $('#subcategories1').html(options);
                                }
                            });
                        }

                        function getDishListBySubcategoryID() {

                            var subcategory_id = $('#subcategories').val();
                            if (subcategory_id == '') {
                                return;
                            }

                            $.ajax({
                                url: 'dish.php?action=get_dish_list_by_subcategory_id',
                                type: 'POST',
                                data: {
                                    subcategory_id: subcategory_id

                                },
                                success: function (data) {
                                    var html = '';

                                    for (var i = 0; i < data.length; i++) {
                                        html += '<option value="' + data[i].id + '">' +
                                            data[i].caption +
                                            '</option>';
                                    }
                                    $('#dish_caption').html(html);
                                },
                                error: function () {
                                    alert('Ошибка выполнения запроса');
                                }
                            });
                        }

                        function loadCategories(category_block) {
                            // Отправляем AJAX-запрос на сервер
                            $.ajax({
                                url: '../../admin/posts/category.php?action=get_category_list',
                                type: 'GET',
                                success: function (data) {
                                    var options = '';
                                    options +=
                                        '<option value="0" disabled selected>Выберите категорию</option>';
                                    for (var i = 0; i < data.length; i++) {

                                        options += '<option value="' + data[i].id + '">' + data[i]
                                            .caption +
                                            '</option>';


                                    }
                                    category_block.html(options);
                                    // getSubcategoryByCategoryID();
                                    // getSubcategoryByCategoryID2();
                                },
                                error: function () {
                                    // Если запрос не выполнен
                                    alert('Ошибка выполнения запроса');
                                }
                            });
                        }

                        $('#add-category-form').submit(function (event) {
                            event.preventDefault(); // Отменяем стандартное поведение формы
                            // Отправляем ajax запрос на сервер
                            $.ajax({
                                url: 'category.php?action=add_category',
                                type: 'POST',
                                data: $(this).serialize(),
                                success: function (response) {
                                    loadCategories($('#category_id'));
                                    loadCategories($('#category'));
                                    alert(
                                        response); // Выводим сообщение об успешном добавлении категории
                                },
                                error: function (xhr, status, error) {
                                    alert('Ошибка: ' + xhr.responseText); // Выводим сообщение об ошибке
                                }
                            });
                        });
                    </script>
                </div>
                <div class="add-subcategory-div">
                    <div>
                        <h3 style="font-size: 20px">Добавление подкатегории</h3>
                        <form id="add-subcategory-form" class="form-menu-subcategory">

                            <label for="subcat_caption">Название подкатегории:</label>
                            <input type="text" id="subcat_caption" name="subcat_caption">

                            <label for="category_id">Категория:</label>
                            <select id="category_id" name="category_id">
                                <option value="">Выберите категорию</option>
                                <!-- Категории будут загружены с помощью AJAX -->
                            </select>
                            <label for="sizing">Описание подкатегории</label>
                            <input type="text" id="sizing" name="subcat_caption">
                            <button type="submit" class="c-button">Добавить подкатегорию</button>

                        </form>
                        <script>
                            // Добавляем обработчик события отправки формы
                            $('#add-subcategory-form').submit(function (event) {

                                // Отменяем стандартное поведение формы
                                event.preventDefault();

                                // Получаем значения полей формы
                                var subcatCaption = $('#subcat_caption').val();
                                var categoryId = $('#category_id').val();
                                var sizing = $('#sizing').val();

                                // Отправляем AJAX-запрос на сервер
                                console.log(sizing);
                                $.ajax({
                                    url: '../../admin/posts/subcategory.php?action=addSubcategoryNew',
                                    type: 'POST',
                                    data: {
                                        subcat_caption: subcatCaption,
                                        category_id: categoryId,
                                        sizing: sizing
                                    },
                                    success: function (response) {
                                        // Обработка ответа от сервера
                                        if (response.indexOf('Ошибка выполнения запроса') !== -1) {
                                            // Если произошла ошибка
                                            alert(response);
                                        } else {
                                            // Если подкатегория добавлена успешно
                                            alert(response);
                                            // Очищаем поля формы
                                            $('#subcat_caption').val('');
                                            $('#category_id').val('');
                                            $('#sizing').val('');
                                            // Загружаем категории
                                            loadCategories($('#category_id'));
                                            getSubcategoryByCategoryID();
                                        }
                                    },
                                    error: function () {
                                        // Если запрос не выполнен
                                        alert('Ошибка выполнения запроса');
                                    }
                                });
                            });

                            // Функция для загрузки категорий


                            // Загружаем категории при загрузке страницы
                            loadCategories($('#category_id'));
                            loadCategories($('#category'));
                        </script>
                    </div>
                    <div>
                        <form id="del-subcat" class="form-menu-dish">
                            <div class="div-form-dish">
                                <label for="categories1">Категория:</label>
                                <select id="categories1" name="categories1">
                                    <option value="">Выберите категорию</option>
                                </select>

                                <label for="subcategories1">Подкатегория:</label>
                                <select id="subcategories1" name="subcategories1">
                                    <option value="">Выберите подкатегорию</option>
                                </select>
                                <button type="submit" class="c-button">Удалить подкатегорию</button>
                            </div>
                        </form>
                        <script>
                            $(document).ready(function () {
                                // получение списка категорий из базы данных
                                loadCategories($('#categories1'));
                                // обработка выбора подкатегории
                                $('#categories1').on('change', getSubcategoryByCategoryID3)
                                // отправка формы на сервер

                                $('#del-subcat').submit(function (event) {
                                    // Отменяем стандартное поведение формы
                                    event.preventDefault();

                                    // Получаем данные формы
                                    var formData = $(this).serialize();

                                    // Отправляем AJAX-запрос
                                    $.ajax({
                                        type: 'POST',
                                        url: 'subcategory.php?action=deleteSubcategory',
                                        data: formData,
                                        success: function (response) {
                                            // Выводим сообщение об успешном удалении
                                            alert(response);
                                        },
                                        error: function (xhr, status, error) {
                                            // Выводим сообщение об ошибке
                                            alert('Ошибка: ' + error);
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
                <div class="add-dish-div">
                    <h3 style="font-size: 20px;">Добавление блюда</h3>
                    <form id="add-dish-form" class="form-menu-dish">
                        <div class="div-form-dish">
                            <label for="caption">Название блюда:</label>
                            <input type="text" id="caption" name="caption">



                            <label for="price">Цена, вес, колличество:</label>
                            <input type="text" id="price" name="price">
                        </div>
                        <div style="display: none">
                            <label for="quantity">Количество:</label>
                            <input type="text" id="quantity" name="quantity">
                        </div>
                        <div style="display: none">
                            <label for="weight">Вес:</label>
                            <input type="text" id="weight" name="weight">
                        </div>
                        <label for="description">Описание блюда:</label>
                        <textarea id="description" name="description"></textarea>
                        <div class="div-form-dish">
                            <label for="category">Категория:</label>
                            <select id="category" name="category">
                                <option value=""></option>
                            </select>

                            <label for="subcategory">Подкатегория:</label>
                            <select id="subcategory" name="subcategory">
                                <option value="">Выберите подкатегорию</option>
                            </select>
                            <button type="submit" class="c-button">Добавить блюдо</button>
                        </div>
                    </form>
                    <script>
                        $(document).ready(function () {
                            // получение списка категорий из базы данных
                            loadCategories($('#category'));

                            // обработка выбора подкатегории
                            $('#category').on('change', getSubcategoryByCategoryID)

                            // отправка формы на сервер
                            $('#add-dish-form').on('submit', function (e) {
                                e.preventDefault();

                                var caption = $('#caption').val();
                                var description = $('#description').val();
                                var price = $('#price').val();
                                var quantity = $('#quantity').val();
                                var weight = $('#weight').val();
                                var subcategory_id = $('#subcategory').val();
                                var category_id = $('#category').val();

                                $.ajax({
                                    url: 'dish.php?action=add_dish',
                                    type: 'POST',
                                    data: {
                                        caption: caption,
                                        description: description,
                                        price: price,
                                        quantity: quantity,
                                        weight: weight,
                                        subcategory_id: subcategory_id,
                                        category_id: category_id
                                    },
                                    dataType: 'html',
                                    success: function (data) {
                                        alert(data);
                                        // Очищаем поля формы
                                        $('#caption').val('');
                                        $('#description').val('');
                                        $('#price').val('');
                                        $('#quantity').val('');
                                        $('#weight').val('');
                                        $('#subcategory').html(
                                            '<option value="">Выберите подкатегорию</option>'
                                        );
                                    },
                                    error: function () {
                                        alert('Ошибка выполнения запроса');
                                    }
                                });
                            });
                        });
                    </script>

                </div>
                <div>
                    <form id="del-dish-form" class="form-menu-dish">
                        <div class="div-form-dish">
                            <label for="categories">Категория:</label>
                            <select id="categories" name="categories">
                                <option value="">Выберите категорию</option>
                            </select>

                            <label for="subcategories">Подкатегория:</label>
                            <select id="subcategories" name="subcategory">
                                <option value="">Выберите подкатегорию</option>
                            </select>
                            <label for="dish_caption">Блюдо:</label>
                            <select id="dish_caption" name="dish_caption">
                                <option value="">Выберите блюдо</option>
                            </select>
                            <button type="submit" class="c-button">Удалить блюдо</button>
                        </div>
                    </form>
                    <script>
                        $(document).ready(function () {
                            // получение списка категорий из базы данных
                            loadCategories($('#category'));
                            loadCategories($('#categories'));
                            // обработка выбора подкатегории
                            $('#categories').on('change', getSubcategoryByCategoryID2)

                            $('#subcategories').on('change', getDishListBySubcategoryID);
                            // отправка формы на сервер

                            $('#del-dish-form').submit(function (event) {
                                // Отменяем стандартное поведение формы
                                event.preventDefault();

                                // Получаем данные формы
                                var formData = $(this).serialize();

                                // Отправляем AJAX-запрос
                                $.ajax({
                                    type: 'POST',
                                    url: 'dish.php?action=delete_dish',
                                    data: formData,
                                    success: function (response) {
                                        // Выводим сообщение об успешном удалении
                                        alert(response);
                                    },
                                    error: function (xhr, status, error) {
                                        // Выводим сообщение об ошибке
                                        alert('Ошибка: ' + error);
                                    }
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </section>
        <section>
            <div class="title">
                <strong class="title__underline">Редактирование постов</strong>
            </div>
            <div class="container posts">

                <div class="add-posts">
                    <h3 style="font-size: 20px;">Добавление поста</h3>
                    <!-- Форма для добавления новой записи -->
                    <form id="add-entry-form" class="add-entry-form" enctype="multipart/form-data">
                        <div style="display:flex; column-gap:10px;">
                            <label for="caption">Заголовок:</label>
                            <input type="text" id="caption" name="caption">
                        </div>

                        <label for="text">Текст:</label>
                        <textarea id="text" name="text"></textarea>

                        <div style="display:flex; column-gap:10px;">
                            <label for="img">Изображение:</label>
                            <input type="file" id="img" name="img">
                            <button type="submit" class="c-button">Добавить пост</button>
                        </div>

                    </form>

                    <!-- AJAX-запрос для добавления новой записи -->
                    <script>
                        $(document).ready(function () {
                            $('#add-entry-form').submit(function (event) {
                                // Отменяем стандартное поведение формы
                                event.preventDefault();

                                // Получаем данные формы
                                var formData = new FormData(this);

                                // Отправляем AJAX-запрос
                                $.ajax({
                                    type: 'POST',
                                    url: 'blog.php?action=add_entry',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function (response) {
                                        // Выводим сообщение об успешном добавлении
                                        alert(response);
                                        getBlog()
                                    },
                                    error: function (xhr, status, error) {
                                        // Выводим сообщение об ошибке
                                        alert('Ошибка: ' + error);
                                    }
                                });
                            });
                        });
                    </script>
                </div>

                <div class="del-posts">
                    <h3 style="font-size: 20px;">Удаление поста</h3>
                    <form id="delete-entry-form" class="delete-entry-form">

                        <label for="entry">Выберите пост:</label>
                        <select id="entry" name="entry">
                            <option value="">Выберите категорию</option>
                        </select>
                        <button type="submit" class="c-button">Удалить пост</button>
                    </form>
                    <script>
                        function getBlog() {
                            $.ajax({
                                url: 'blog.php?action=get_posts',
                                type: 'GET',
                                success: function (data) {
                                    var options = '';
                                    for (var i = 0; i < data.length; i++) {
                                        options += '<option value="' + data[i].id + '">' + data[i]
                                            .caption + '</option>';
                                    }
                                    $('#entry').html(options);
                                    console.log(data);
                                },
                                error: function (jqXHR, textStatus, data) {
                                    console.log(jqXHR);
                                }
                            });
                        }
                        $(document).ready(function () {
                            $.ajax({
                                url: 'blog.php?action=get_posts',
                                type: 'GET',
                                success: function (data) {
                                    var options = '';
                                    for (var i = 0; i < data.length; i++) {
                                        options += '<option value="' + data[i].id + '">' + data[i]
                                            .caption + '</option>';
                                    }
                                    $('#entry').html(options);
                                    console.log(data);
                                },
                                error: function (jqXHR, textStatus, data) {
                                    console.log(jqXHR);
                                }
                            });

                            $('#delete-entry-form').submit(function (event) {
                                // Отменяем стандартное поведение формы
                                event.preventDefault();

                                // Получаем данные формы
                                var formData = $(this).serialize();

                                // Отправляем AJAX-запрос
                                $.ajax({
                                    type: 'POST',
                                    url: 'blog.php?action=delete_entry',
                                    data: formData,
                                    success: function (response) {
                                        // Выводим сообщение об успешном удалении
                                        alert(response);
                                        getBlog()
                                    },
                                    error: function (xhr, status, error) {
                                        // Выводим сообщение об ошибке
                                        alert('Ошибка: ' + error);
                                    }
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </section>

    </main>
    <script defer src="../../assets/js/form.js"></script>
</body>

</html>