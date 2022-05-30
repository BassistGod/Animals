<?php
require_once 'template/header.php';
$data = getPostFromTag($mysql);
$tag = getAllTags($mysql);
close ($mysql);
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                <?php
                // выводим заголовок
                echo "<h1 class='text-center mb-5'>{$_GET['tag']}</h1>";
                ?>
                </div>
            </div>
            <div class="row">
            <?php
                // выводим таблицу записей в виде карточек 
                $out = '';
                for ($i=0; $i < count($data); $i++){
                    $out .= '<div class="col-lg-3 col-md-6 mb-4">';
                    $out .= '<div class="card">';
                    $out .= "<img src='/New_lessons/14_animal/images/{$data[$i]['image']}' class='card-img-top'>";
                    $out .= '<div class="card-body">';
                    $out .= "<h5 class='card-title'>{$data[$i]['title']}</h5>";
                    $out .= "<p class='card-text'>{$data[$i]['descr_min']}</p>";
                    $out .= "<p class='text-right'><a href='/New_lessons/14_animal/article.php?id={$data[$i]['id']}' class='btn btn-primary'>Read more...</a></p>";
                    $out .= '</div>';
                    $out .= '</div>';
                    $out .= '</div>';
                }
                echo $out;
            ?>
            </div>
        </div>
    </div>
</div>

<!-- вывод ссылок на теги -->
<div class="col-lg-12 text-center"> 
    <?php
        echo '<hr>';
        for ($i=0; $i < count($tag); $i++){
            echo "<span><a href='/New_lessons/14_animal/tag.php?tag={$tag[$i]}' class='badge badge-primary p-2 m-1' >{$tag[$i]}</a></span>";
        }
    ?>
</div>

<?php
// // выводим таблицу записей
// for ($i=0; $i < count($data); $i++){
//     // проверяем наличие записи об изображении в базе
//     if ($data[$i]['image'] != ''){
//         $image = "<img src='/New_lessons/14_animal/images/{$data[$i]['image']}' width='100'>";
//     } else {
//         $image = 'no image';
//     }
//     $out .= $image;
//     $out .= "<h2>{$data[$i]['title']}</h2>";
//     $out .= "<p>{$data[$i]['descr_min']}</p>";
//     $out .= "<p><a href='/New_lessons/14_animal/article.php?id={$data[$i]['id']}'>Read more...</a></p>";
//     $out .= '<hr>';
// }
// echo $out;

require_once 'template/footer.php';
?>





