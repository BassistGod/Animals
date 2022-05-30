<?php
require_once 'template/header.php';
$data = select($mysql);
$AllTags = getAllArticleTags($mysql);
close ($mysql);
// проверка успешной записи в базу
if (isset($_COOKIE['bd_create_success']) AND $_COOKIE['bd_create_success'] !=''){
    if ($_COOKIE['bd_create_success'] == 1){
        echo "New record created successfully" . '<br>';         
    } 
} 
// проверка успешного удаления записи из базы
if (isset($_COOKIE['delete_record']) AND $_COOKIE['delete_record'] !=''){
    if ($_COOKIE['delete_record'] == 1){
        echo "Record is deleted" . '<br>';         
    } 
} 
// проверка успешного редактирования записи
if (isset($_COOKIE['bd_edit_success']) AND $_COOKIE['bd_edit_success'] !=''){
    if ($_COOKIE['bd_edit_success'] == 1){
        echo "The record edited successfully" . '<br>';         
    } 
}
// проверка отмены редактирования записи
if (isset($_COOKIE['bd_edit_cancel']) AND $_COOKIE['bd_edit_cancel'] !=''){
    if ($_COOKIE['bd_edit_cancel'] == 1){
        echo "The record edit canceled" . '<br>';         
    } 
}

?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php
                echo '<h2>Admin-panel</h2>';
                // Кнопка создать запись
                echo '<div class="mt-2 mb-2 text-right">';
                echo '<a href="/New_lessons/14_animal/admin_create.php"><button class="btn btn-success">Add new record</button></a></div>';
                // border="2"
                // вывод данных из массива в таблице
                $out = '<table class="table table-striped">';
                $out .= '<tr><th scope="col">#</th><th>ID</th><th>Category</th><th>Title</th><th>Descr_min</th><th>Description</th><th>Tags</th><th>Image</th><th>Update</th><th>Delete</th></tr>';
                for ($i=0; $i < count($data); $i++){
                    // проверяем наличие записи об изображении в базе
                    if ($data[$i]['image'] != ''){
                        $image = "<img src='/New_lessons/14_animal/images/{$data[$i]['image']}' width='100'>";
                    } else {
                        $image = 'no image';
                    }
                    // получаем теги для каждой записи
                    $infoId = $data[$i]['id'];
                    $tagsName = 'Без тегов';
                    if (isset($infoId) AND $infoId !=''){
                        $tagsName = '';
                        for ($r=0; $r < count($AllTags); $r++){
                            if ($infoId == $AllTags[$r]['post']){
                                $tagsName .= "{$AllTags[$r]['tag']} <br>"; 
                            }
                        }
                    } 

                    // получаем категорию для каждой записи
                    $catId = $data[$i]['category'];
                    $catName = 'Без категории';
                    if (isset($catId) AND $catId !=''){
                        for ($j=0; $j < count($AllCat); $j++){
                            if ($catId == $AllCat[$j]['id']){
                                $catName = $AllCat[$j]['category'];
                            }
                        }
                    }  

                    // Кнопка редактирования    
                    $edit = "<div><a href='/New_lessons/14_animal/admin_edit.php?id={$data[$i]['id']}'><button class='btn btn-info'>Edit</button></a></div>";    

                    // Кнопка удаления  
                    $delete = "<div><a href='/New_lessons/14_animal/admin_delete.php?Delete_id={$data[$i]['id']}'><button class='btn btn-danger'>Delete</button></a></div>";

                    // добавляем все записи для вывода таблицы
                    $number = $i + 1;
                    $out .= "<tr><th scope='row'>{$number}</th><td>{$data[$i]['id']}</td><td>{$catName}</td><td>{$data[$i]['title']}</td><td>{$data[$i]['descr_min']}</td><td>{$data[$i]['description']}</td><td>$tagsName</td><td>{$image}</td><td>{$edit}</td><td>{$delete}</td></tr>";
                }
                $out .= '</table>';
                echo $out;
            ?>
        </div>
    </div>
</div>            


<?php
require_once 'template/footer.php';
?>



