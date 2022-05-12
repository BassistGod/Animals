<?php
require_once 'core/config.php';
require_once 'core/function.php';

$mysql = connect();
$data = selectMain($mysql);
$countPage = paginationCount($mysql);
$tag = getAllTags($mysql);
$AllCat = getAllCatInfo($mysql);
$AmountCatInfo = getAmountCatInfo($mysql); //сумма записей по каждой категории
close ($mysql);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
<body>


    <!-- Navtabs -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: #666666;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<!-- Jumbotron -->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Fluid jumbotron</h1>
        <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
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
            <?php
            // выводим категории
            $out = '';
            $out .= '<div class="list-group">';
            for ($i=0; $i < count($AllCat); $i++){
                // $out .= "<a href='/New_lessons/14_animal/category.php?id={$AllCat[$i]['id']}' class='list-group-item list-group-item-action'>{$AllCat[$i]['description']}</a>";
                $out .= '<li class="list-group-item d-flex justify-content-between align-items-center">';   
                $out .= "<a href='/New_lessons/14_animal/category.php?id={$AllCat[$i]['id']}' >{$AllCat[$i]['description']}</a>";
                $out .= "<span class='badge badge-primary badge-pill'>{$AmountCatInfo[$i]}</span>";
                // $out .= "<span class='badge bg-primary rounded-pill'>{$AmountCatInfo[$i]}</span>"; //bootstrap 5.1 
                $out .= '</li>';                  
            }
            $out .= '</div>';
            echo $out;
            ?>
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
<footer class="footer navbar-dark bg-dark mt-5">
    <div class="container pt-3 pb-3">
         <span class="text-muted">footer</span>   
    </div>
</footer>

 <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
  </body>
</html>


