<?php
// Подключаемся к базе данных
require '../../app/database/connect.php';

// проверка соединения
if (!$db_connection) {
    die('Ошибка подключения: ' . mysqli_connect_error());
}
$action = isset($_GET['action']) ? $_GET['action'] : $_POST['action'];

switch ($action) {
    case 'get_posts':
        // Подготовка запроса
        $sql = "SELECT * FROM blog";
        $q = mysqli_query($db_connection, $sql);
        $data = array();
        while ($row = mysqli_fetch_assoc($q)) {
            $data[] = $row;
        }
        header("Content-Type: application/json; charset=utf-8");
        print(json_encode($data));
        exit();

    case 'add_entry':
        // Подготовка запроса
        $query = "INSERT INTO blog (caption, text, img) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($db_connection, $query);

        // Привязка параметров
        mysqli_stmt_bind_param($stmt, "sss", $caption, $text, $img);

        // Установка параметров
        $caption = $_POST['caption'];
        $text = $_POST['text'];
        $img = '../../uploads/' . $_FILES['img']['name'];

        // Загрузка файла на сервер
        if (!move_uploaded_file($_FILES['img']['tmp_name'], $img)) {
            echo 'Ошибка загрузки файла';
            exit();
        }

        // Выполнение запроса
        if (mysqli_stmt_execute($stmt)) {
            echo 'Пост успешно добавлен';
        } else {
            echo 'Ошибка выполнения запроса: ' . mysqli_stmt_error($stmt);
        }

        // Закрытие запроса
        mysqli_stmt_close($stmt);
        exit();

    case 'delete_entry':
        // Проверка наличия значения поля entry
        if (!isset($_POST['entry']) || empty($_POST['entry'])) {
            echo 'Ошибка: поле entry не заполнено';
            exit();
        }

        // Подготовка запроса
        $query = "DELETE FROM blog WHERE id = ?";
        $stmt = mysqli_prepare($db_connection, $query);

        // Привязка параметров
        mysqli_stmt_bind_param($stmt, "i", $entry_id);

        // Установка параметров
        $entry_id = $_POST['entry'];

        // Выполнение запроса
        if (mysqli_stmt_execute($stmt)) {
            echo 'Пост успешно удален';
        } else {
            echo 'Ошибка выполнения запроса: ' . mysqli_stmt_error($stmt);
        }

        // Закрытие запроса
        mysqli_stmt_close($stmt);
        exit();
}

mysqli_close($db_connection);