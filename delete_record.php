<?php
require_once 'core/config.php';
require_once 'core/function.php';

// проверка передачи значения методом GET, если да, создаем подключение, запрос, если запрос выполняется, переходим на главную и создаем куки с информацией об успехе
if (isset($_GET['Delete_id']) AND $_GET['Delete_id'] !=''){
    $mysql = connect();
    $sql = "DELETE FROM info WHERE id = '".$_GET['Delete_id']."'";
    if ($mysql->query($sql) === TRUE) {
        header('Location: /New_lessons/14_animal/admin.php');
        setcookie("delete_record", '1', time()+10);
    } else {
        echo "Error: " . $sql . "<br>" . $mysql->error . '<br>';
    }
    close ($mysql);
}



