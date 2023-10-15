<?php
// Подключаемся к базе данных
require '../../app/database/connect.php';

// Проверяем соединение
if (!$db_connection) {
    die("Ошибка подключения: " . mysqli_connect_error());
}

// Получаем данные из формы

$action = isset($_GET['action']) ? $_GET['action'] : $_POST['action'];

switch ($action){
    case 'get_category_list':
        
        $sql = 'SELECT * FROM category';
        $q = mysqli_query($db_connection, $sql);

        $data = array();
        while($row = mysqli_fetch_assoc($q)){
            $data[] = $row;
        }
        
        header("Content-Type: text json; charset=utf-8");
        print(json_encode($data));
        exit();

    case 'add_category':
        if (isset($_POST['category'])) {
            $category = $_POST['category'];
        } else {
            die("Ошибка: название категории не указано");
        }
        
        // Готовим запрос
        $stmt = mysqli_prepare($db_connection, "INSERT INTO `category`(`caption`) VALUES(?)");
        
        // Привязываем параметры
        mysqli_stmt_bind_param($stmt, "s", $category);
        
        // Выполняем запрос
        if (mysqli_stmt_execute($stmt)) {
            echo "Категория успешно добавлена";
        } else {
            echo "Ошибка выполнения запроса: " . mysqli_error($db_connection);
        }
        
        // Закрываем соединение
        mysqli_stmt_close($stmt);
        mysqli_close($db_connection);
        
        exit();

}


