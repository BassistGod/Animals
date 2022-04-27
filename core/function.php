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
