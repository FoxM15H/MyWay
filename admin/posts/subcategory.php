<?php
// Подключаемся к базе данных
require '../../app/database/connect.php';

// Получаем данные из формы


$action = isset($_GET['action']) ? $_GET['action'] : $_POST['action'];


switch ($action) {
    case 'getSubcategoryByCategoryID':

        $category_id = mysqli_real_escape_string($db_connection, $_POST['category_id']);

        $sql = 'SELECT * FROM subcategory WHERE category_id = ' . $category_id;

        $q = mysqli_query($db_connection, $sql);

        $data = array();
        while ($row = mysqli_fetch_assoc($q)) {
            $data[] = $row;
        }

        header("Content-Type: text json; charset=utf-8");
        print(json_encode($data));
        exit();

    case 'addSubcategoryNew':
        $subcat_caption = mysqli_real_escape_string($db_connection, $_POST['subcat_caption']);
        $category_id = mysqli_real_escape_string($db_connection, $_POST['category_id']);
        $sizing = mysqli_real_escape_string($db_connection, $_POST['sizing']);

        // Готовим запрос на добавление новой подкатегории
        $query = "INSERT INTO subcategory (caption, category_id, sizing) VALUES ('" . $subcat_caption . "','" . $category_id . "','" . $sizing . "')";

        // Выполняем запрос
        if (mysqli_query($db_connection, $query)) {
            echo "Новая подкатегория успешно добавлена";
        } else {
            echo "Ошибка выполнения запроса: " . $query;
        }

        // Готовим запрос на выборку всех категорий
        $query = "SELECT * FROM category";

        // Выполняем запрос
        $result = mysqli_query($db_connection, $query);
        exit();

    case 'getSubcategoryList':
        $sql = "SELECT * FROM category";
        $q = mysqli_query($db_connection, $sql);
        $data = array();
        while ($row = mysqli_fetch_assoc($q)) {
            $data[] = $row;
        }
        header("Content-Type: text json; charset=utf-8");
        print(json_encode($data));
        exit();

    case 'deleteSubcategory':
        if (!isset($_POST['subcategories1']) || empty($_POST['subcategories1'])) {
            echo 'Ошибка: поле dish_caption не заполнено';
            exit();
        }
        $subcategoryId = $_POST['subcategories1'];
        // Удаление всех блюд, связанных с удаляемой подкатегорией
        $delete_dishes_query = "DELETE FROM menu WHERE subcategory_id = ?";
        $stmt = mysqli_prepare($db_connection, $delete_dishes_query);
        mysqli_stmt_bind_param($stmt, "i", $subcategoryId);
        if (!mysqli_stmt_execute($stmt)) {
            echo "Ошибка удаления блюд: (" . mysqli_stmt_errno($stmt) . ") " . mysqli_stmt_error($stmt);
            exit();
        }
        // Удаление подкатегории
        $delete_subcategory_query = "DELETE FROM subcategory WHERE id = ?";
        $stmt = mysqli_prepare($db_connection, $delete_subcategory_query);
        mysqli_stmt_bind_param($stmt, "i", $subcategoryId);
        if (!mysqli_stmt_execute($stmt)) {
            echo "Ошибка удаления подкатегории: (" . mysqli_stmt_errno($stmt) . ") " . mysqli_stmt_error($stmt);
            exit();
        }
        echo "Подкатегория и все блюда, связанные с этой подкатегорией, успешно удалены";
        exit();
}




// Закрываем соединение с базой данных
mysqli_close($db_connection);