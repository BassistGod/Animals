<?php
require_once 'core/config.php';
require_once 'core/function.php';

$mysql = connect();
$data = selectMain($mysql);
$countPage = paginationCount($mysql);
close ($mysql);




for ($i=0; $i < count($data); $i++){
    // проверяем наличие записи об изображении в базе
    if ($data[$i]['image'] != ''){
        $image = "<img src='/New_lessons/14_animal/images/{$data[$i]['image']}' width='100'>";
    } else {
        $image = 'no image';
    }
    $out .= $image;
    $out .= "<h2>{$data[$i]['title']}</h2>";
    $out .= "<p>{$data[$i]['descr_min']}</p>";
    $out .= "<p><a href='/New_lessons/14_animal/article.php?id={$data[$i]['id']}'>Read more...</a></p>";
    $out .= '<hr>';
}

echo $out;

for ($i=0; $i < $countPage; $i++){
    $j = $i + 1;
    echo "<a href='/New_lessons/14_animal/index.php?page={$i}' style ='padding: 5px;'>{$j}</a>";
}
