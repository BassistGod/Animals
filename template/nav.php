<?php
    // выводим категории
    $out = '';
    $out .= '<div class="list-group">';
    for ($i=0; $i < count($AllCat); $i++){
        // $out .= "<a href='/New_lessons/14_animal/category.php?id={$AllCat[$i]['id']}' class='list-group-item list-group-item-action'>{$AllCat[$i]['description']}</a>";
        $out .= '<li class="list-group-item d-flex justify-content-between align-items-center">';   
        $out .= "<a href='/New_lessons/14_animal/category.php?id={$AllCat[$i]['id']}' >{$AllCat[$i]['category']}";
        // $out .= "<br> <small class='form-text text-muted'>({$AllCat[$i]['description']})</small>";
        $out .= "</a>";
        $out .= "<span class='badge badge-primary badge-pill'>{$AmountCatInfo[$i]}</span>";
        // $out .= "<span class='badge bg-primary rounded-pill'>{$AmountCatInfo[$i]}</span>"; //bootstrap 5.1 
        $out .= '</li>';                  
    }
    $out .= '</div>';
    echo $out;
?>