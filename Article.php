<?php
require_once 'template/header.php';
$data = selectArticle($mysql);
$tag = getArticleTags($mysql);
close ($mysql);
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    // выводим одиночную запись статьи
                    $out = '';
                    $out .= "<h1 class='text-center'>{$data['title']}</h1>";
                    if ($data['image'] != ''){
                        $image = "<img src='/New_lessons/14_animal/images/{$data['image']}' class='rounded mx-auto d-block mt-5 mb-5' width='60%' >";
                    } else {
                        $image = 'no image';
                    }
                    $out .= $image;
                    $out .= '<hr>';
                    $out .= "<div>{$data['description']}</div>";
                    echo $out;
                    ?>
                </div>
            </div>
        </div>
        <!-- выводим категории -->
        <div class="col-lg-3">       
            <?php require_once 'template/nav.php'; ?>   
        </div>

        <div class="col-lg-12 text-center">
            <?php
            // вывод ссылок на теги
            if (isset($tag) AND $tag !='bad select'){  
                echo '<hr>';
                for ($i=0; $i < count($tag); $i++){
                    echo "<span><a href='/New_lessons/14_animal/tag.php?tag={$tag[$i]['tag']}' class='badge badge-primary p-2 m-1'>{$tag[$i]['tag']}</a></span>";
                }
            }
            ?>
        </div>
    </div>
    
</div>

<?php
require_once 'template/footer_down.php';
?>




