<?php

function connect(){
    $mysql = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    $mysql->query("SET NAMES 'utf8'"); // установка кодировки для русских символов

    if (!$mysql) {
     die("Connection failed: " . mysqli_connect_error());
    } 
    return $mysql;
}

function select($mysql){
    $result = $mysql->query(" SELECT * FROM info ");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){
        $a[] = $row; 
        }
    } 
    return $a;
}

function selectMain($mysql){
    $offset = 0;
    if (isset($_GET['page']) AND trim($_GET['page']) != ''){
        $offset = trim($_GET['page']) * ARTNUM; 
    }
    $const = ARTNUM;
    $result = $mysql->query(" SELECT * FROM info ORDER BY id DESC LIMIT $const OFFSET ".$offset); // выборка в обратном порядке
    $a = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){
        $a[] = $row; 
        }
    } 
    return $a;
}

function selectArticle($mysql){
    $result = $mysql->query(" SELECT * FROM info WHERE id=".$_GET['id']);
    if ($result->num_rows > 0) {
        $a = $result->fetch_assoc();        
    } 
    return $a;
}

//выбираем уникальные варианты тегов
function getAllTags($mysql){
    $result = $mysql->query(" SELECT DISTINCT tag FROM tag"); // DISTINCT выберает уникальные варианты
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){
        $a[] = $row['tag']; 
        }
    } 
    return $a;
}

function getPostFromTag($mysql){
    $result = $mysql->query("SELECT post FROM tag WHERE tag='".$_GET['tag']."'"); // кавычки для строки
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){
        $a[] = $row['post']; 
        }
    } 
    $join = join("," , $a); // join делает из массива строку
    $result = $mysql->query(" SELECT * FROM info WHERE id in ($join) "); 
    $a = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){
        $a[] = $row; 
        }
    } 
    return $a;
}

// сумма записей в каждой категории
function getAmountCatInfo($mysql){
    $result = $mysql->query("SELECT id FROM category");
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $result2 = $mysql->query("SELECT count(*) as total FROM info WHERE category=".$row['id']);
            if ($result2->num_rows > 0) {
                while ($data = $result2->fetch_assoc()){
                    $a[] = $data['total'];
                }     
            } 
        }   
    }
    return $a;
}

// выбираем записи животных, где категория =id
function getPostFromCategory($mysql){
    $result = $mysql->query("SELECT * FROM info WHERE category=".$_GET['id']);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){
            $a[] = $row; 
        }
    } 
    return $a;
}

// выбираем запись категории по id
function getCatInfo($mysql){
    $result = $mysql->query("SELECT * FROM category WHERE id=".$_GET['id']);
    if ($result->num_rows > 0) {
        $a = $result->fetch_assoc();
    } 
    return $a;
}

// выбираем все записи таблицы категории
function getAllCatInfo($mysql){
    $result = $mysql->query("SELECT * FROM category");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){
            $a[] = $row; 
        }
    }
    return $a;
}

// выбирем теги, которые указывают на определенную статью методом GET
function getArticleTags($mysql){
    $result = $mysql->query(" SELECT  id, tag FROM tag WHERE post=".$_GET['id']); 
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){
        $a[] = $row; 
        }
    } 
    return $a;
}

// выбирем все записи таблицы tag
function getAllArticleTags($mysql){
    $result = $mysql->query(" SELECT  * FROM tag "); 
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){
        $a[] = $row; 
        }
    } 
    return $a;
}

function paginationCount($mysql){
    $sql = "SELECT * FROM info"; 
    $result = $mysql->query($sql);
    $result = $result->num_rows;
    return ceil($result/ARTNUM); // округляет всегда в большее целое число
}

function generateHash ($length) {
    $symbol = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
    $code = "";
    for ($i = 0; $i < $length; $i++) {
        $code .= $symbol[rand(0, strlen($symbol)-1)];
    }
    return $code;
} 

function close($mysql){
    $mysql->close();
}
