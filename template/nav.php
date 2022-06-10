<?php
    // выводим категории
    $out = '';
    $out .= '<div class="list-group">';
    for ($i=0; $i < count($AllCat); $i++){
        $out .= '<li class="list-group-item d-flex justify-content-between align-items-center">';   
        $out .= "<a href='/New_lessons/14_animal/category.php?id={$AllCat[$i]['id']}' >{$AllCat[$i]['category']}";
        $out .= "</a>";
        $out .= "<span class='badge badge-primary badge-pill'>{$AmountCatInfo[$i]}</span>";
        $out .= '</li>';                  
    }
    $out .= '</div>';
    echo $out;
?>