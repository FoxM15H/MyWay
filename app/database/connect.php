<?php

$driver = 'mysql';
$host = 'localhost';
$dbname='MyWay';
$db_user = 'admin';
$db_pass = '1234';
$charset = 'utf8';

$db_connection = mysqli_connect($host,$db_user,$db_pass );
if (mysqli_select_db($db_connection, $dbname)) {
    mysqli_query ($db_connection,"SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
    mysqli_query ($db_connection,"SET CHARACTER SET utf8mb4");
    mysqli_query ($db_connection,"SET character_set_client='utf8mb4'");
    mysqli_query ($db_connection,"SET character_set_connection='utf8mb4'");
    mysqli_query ($db_connection,"SET character_set_results='utf8mb4'");
    mysqli_query ($db_connection,"SET collation_connection='utf8mb4_unicode_ci'");
//mysql_query ("SET TIME_ZONE = '".$g_defaultTimeZone."'");
} else {
    print('ошибка: базы данных не существует!');
}


