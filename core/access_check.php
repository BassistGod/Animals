<?php

// проверка права доступа
if (isset($_COOKIE['id']) AND isset($_COOKIE['hash'])){
    $result = $mysql->query("SELECT * FROM users WHERE id=".$_COOKIE['id']." LIMIT 1");  
    if ($result->num_rows > 0) {
        $users = $result->fetch_assoc();        
        } else {
            echo 'Error: ' . $sql . '<br>' . $mysql->error . '<br>';
    }
    if ($users['hash'] !== $_COOKIE['hash']){
        close ($mysql);
        setcookie("id", $row['id'], time()-1*24*60*60);
        setcookie("hash", $hash, time()-1*24*60*60);  
        header('Location: /New_lessons/14_animal/login.php');
    }
} else {
    close ($mysql);
    header('Location: /New_lessons/14_animal/login.php');    
}
close ($mysql);