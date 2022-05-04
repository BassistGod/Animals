<?php
require_once 'core/config.php';
require_once 'core/function.php';

$mysql = connect();
$data = selectArticle($mysql);
$tag = getArticleTags($mysql);
close ($mysql);

// вывод ссылок на теги
for ($i=0; $i < count($tag); $i++){
    echo "<a href='/New_lessons/14_animal/tag.php?tag={$tag[$i]['tag']}' style ='padding: 5px;'>{$tag[$i]['tag']}</a>";
}
echo '<hr>';

// выводим одиночную запись статьи
$out = '';
$out .= "<h1>{$data['title']}</h1>";
if ($data['image'] != ''){
    $image = "<img src='/New_lessons/14_animal/images/{$data['image']}' width='500'>";
} else {
    $image = 'no image';
}
$out .= $image;
$out .= '<hr>';
$out .= "<div>{$data['description']}</div>";
$out .= '<hr>';
echo $out;



