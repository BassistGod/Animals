<?php
require_once 'template/header.php';
$data = selectMain($mysql);
$countPage = paginationCount($mysql);
$tag = getAllTags($mysql);
close ($mysql);
?>

<!-- Jumbotron -->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Большой сайт с животными</h1>
        <p class="lead">Вы узнаете много нового и интересного о мире животных</p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="row">
                <?php
                // выводим таблицу записей в виде карточек 
                $out = '';
                for ($i=0; $i < count($data); $i++){
                    $out .= '<div class="col-lg-4 col-md-6">';
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
        
    
    <div class="row">
        <!-- Pagination - вывод ссылок на страницы     -->
        <div class="col-lg-12 text-center">
            <nav class="mt-4">
                <nav aria-label="...">
                    <ul class="pagination">
                        <?php
                            $out = '';
                            // previous button
                            if ($_GET['page'] == 0){
                                $out .= "<li class='page-item disabled'><a class='page-link'>&laquo;</a></li>";
                            } else {
                                $next = $_GET['page'] - 1;
                                $out .= "<li class='page-item'><a class='page-link' href='/New_lessons/14_animal/index.php?page={$next}'>&laquo;</a></li>";
                            }   
                            // main buttons      
                            for ($i=0; $i < $countPage; $i++){
                                $j = $i + 1;
                                if ($_GET['page'] == $i){
                                    $out .= "<li class='page-item active' aria-current='page'><a class='page-link' href='/New_lessons/14_animal/index.php?page={$i}'>{$j}</a></li>";
                                } else {
                                    $out .= "<li class='page-item'><a class='page-link' href='/New_lessons/14_animal/index.php?page={$i}'>{$j}</a></li>";
                                }
                                
                            }
                            // next button
                            if ($_GET['page'] == ($countPage-1)){
                                $out .= "<li class='page-item disabled'><a class='page-link'>&raquo;</a></li>";
                            } else {
                                $next = $_GET['page'] + 1;
                                $out .= "<li class='page-item'><a class='page-link' href='/New_lessons/14_animal/index.php?page={$next}'>&raquo;</a></li>";
                            }                            
                            echo $out;
                        ?>
                    </ul>
                </nav>
            </nav>
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
    </div> 
</div>

<?php
require_once 'template/footer.php';
?>


