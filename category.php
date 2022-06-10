<?php
require_once 'template/header.php';
$data = getPostFromCategory($mysql);
$cat = getCatInfo($mysql);
$tag = getAllTags($mysql);
close ($mysql);
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    // выводим заголовок
                    echo "<h1 class='text-center'>{$cat['category']}</h1>";
                    ?>
                </div>
                <div class="col-lg-12">
                    <?php
                    echo "<div class='text-center mb-4 mt-2'>{$cat['description']}</div>";
                    ?>
                </div>
            </div>
            <div class="row">
            <?php
                // выводим таблицу записей в виде карточек 
                $out = '';
                for ($i=0; $i < count($data); $i++){
                    $out .= '<div class="col-lg-4 col-md-6 mb-4">';
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
        <div class="col-lg-3">  
            <!-- выводим категории -->
            <?php require_once 'template/nav.php'; ?>   
        </div>
    </div>
</div>

<?php
require_once 'template/footer_down.php';
?>






