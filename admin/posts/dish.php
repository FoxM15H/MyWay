<?php
// Подключаемся к базе данных
require '../../app/database/connect.php';

// проверка соединения
if (!$db_connection) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}
$action = isset($_GET['action']) ? $_GET['action'] : $_POST['action'];

switch ($action) {
    case 'add_dish':
        // подготовка запроса
        $query = "INSERT INTO menu (caption, description, price, quantity, weight, subcategory_id, category_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($db_connection, $query);

        // привязка параметров
        mysqli_stmt_bind_param($stmt, 'sssiiii', $caption, $description, $price, $quantity, $weight, $subcategory_id, $category_id);

        // установка параметров
        $caption = $_POST['caption'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $weight = $_POST['weight'];
        $subcategory_id = $_POST['subcategory_id'];
        $category_id = $_POST['category_id'];

        //выполнение запроса
        if (mysqli_stmt_execute($stmt)) {
            echo 'Блюдо успешно добавлено в меню';
        } else {
            echo 'Ошибка выполнения запроса: ' . mysqli_stmt_error($stmt);
        }
        exit();

    case 'get_dish_list_by_subcategory_id':
        $subcategory_id = mysqli_real_escape_string($db_connection, $_POST['subcategory_id']);
        $sql = 'SELECT * FROM menu WHERE subcategory_id = ' . $subcategory_id;
        $q = mysqli_query($db_connection, $sql);
        $data = array();
        while ($row = mysqli_fetch_assoc($q)) {
            $data[] = $row;
        }
        header("Content-Type: text json; charset=utf-8");
        print(json_encode($data));
        exit();

    case 'delete_dish':
        if (!isset($_POST['dish_caption']) || empty($_POST['dish_caption'])) {
            echo 'Ошибка: поле dish_caption не заполнено';
            exit();
        }
        // подготовка запроса
        $query = "DELETE FROM menu WHERE id = ?";
        $stmt = mysqli_prepare($db_connection, $query);

        // привязка параметров
        mysqli_stmt_bind_param($stmt, 'i', $dish_id);

        // установка параметров
        $dish_id = $_POST['dish_caption'];

        // выполнение запроса
        if (mysqli_stmt_execute($stmt)) {
            echo 'Блюдо успешно удалено из меню';
        } else {
            echo 'Ошибка выполнения запроса: ' . mysqli_stmt_error($stmt);
        }
        exit();
}
mysqli_close($db_connection);