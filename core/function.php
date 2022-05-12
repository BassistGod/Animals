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
    } else {
        $a = 'bad select';
    }
    return $a;
}

function selectMain($mysql){
    $offset = 0;
    if (isset($_GET['page']) AND trim($_GET['page']) != ''){
        $offset = trim($_GET['page']); 
    }
    $result = $mysql->query(" SELECT * FROM info ORDER BY id DESC LIMIT 3 OFFSET ".$offset*3); // выборка в обратном порядке
    
    $a = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){
        $a[] = $row; 
        }
    } else {
        $a = 'bad select';
    }
    return $a;
}

function selectArticle($mysql){
    $result = $mysql->query(" SELECT * FROM info WHERE id=".$_GET['id']);
    if ($result->num_rows > 0) {
        $a = $result->fetch_assoc();        
        } else {
        $a = 'bad select';
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
    } else {
        $a = 'bad select';
    }
    return $a;
}

function getPostFromTag($mysql){
    $result = $mysql->query("SELECT post FROM tag WHERE tag='".$_GET['tag']."'"); // кавычки для строки
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){
        $a[] = $row['post']; 
        }
    } else {
        $a = 'bad select from tag getPostFromTag';
        return $a;
    } 
    $join = join("," , $a); // join делает из массива строку
    $result = $mysql->query(" SELECT * FROM info WHERE id in ($join) "); 
    $a = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){
        $a[] = $row; 
        }
    } else {
        $a = 'bad select from info getPostFromTag';
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
            } else {
                $a = 'bad select from getAmountCatInfo';
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
    } else {
        $a = 'bad select from info';
    }
    return $a;
}

// выбираем запись категории по id
function getCatInfo($mysql){
    $result = $mysql->query("SELECT * FROM category WHERE id=".$_GET['id']);
    if ($result->num_rows > 0) {
        $a = $result->fetch_assoc();
    } else {
        $a = 'bad select from category';
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
    } else {
        $a = 'bad select from category';
    }
    return $a;
}



// выбирем теги, которые указывают на определенную статью
function getArticleTags($mysql){
    $result = $mysql->query(" SELECT  id, tag FROM tag WHERE post=".$_GET['id']); 
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()){
        $a[] = $row; 
        }
    } else {
        $a = 'bad select';
    }
    return $a;
}



function paginationCount($mysql){
    $sql = "SELECT * FROM info"; 
    $result = $mysql->query($sql);
    $result = $result->num_rows;
    return ceil($result/3); // округляет всегда в ольшее целое число
}


function output($result){
    ?>
    <table border="1">
        <?php while ($row = $result->fetch_assoc()){ ?>
        <tr>
        <?php
            foreach ($row as $value){
                ?><th width="200" height="50"> <?php 
                echo $value; ?></th>  
        <?php } ?>
        </tr>
        <?php } ?>
    </table>
    <?php
}

function close($mysql){
    $mysql->close();
}
