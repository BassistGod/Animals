<?php
require_once 'template/header.php';
$data = select($mysql);
close ($mysql);
// проверка успешной записи в базу
if (isset($_COOKIE['bd_create_success']) AND $_COOKIE['bd_create_success'] !=''){
    if ($_COOKIE['bd_create_success'] == 1){
        setcookie("bd_create_success", '1', time()-10);
        echo "New record created successfully" . '<br>';         
    } 
} 
// проверка успешного удаления записи из базы
if (isset($_COOKIE['delete_record']) AND $_COOKIE['delete_record'] !=''){
    if ($_COOKIE['delete_record'] == 1){
        setcookie("delete_record", '1', time()-10);
        echo "Record is deleted" . '<br>';         
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
                $out .= '<tr><th scope="col">#</th><th>ID</th><th>Title</th><th>Descr_min</th><th>Description</th><th>Image</th><th>Delete</th></tr>';
                for ($i=0; $i < count($data); $i++){
                    // проверяем наличие записи об изображении в базе
                    if ($data[$i]['image'] != ''){
                        $image = "<img src='/New_lessons/14_animal/images/{$data[$i]['image']}' width='100'>";
                    } else {
                        $image = 'no image';
                    }
                    // добавляем для каждой строки таблицы кнопку удаления  
                    $delete = "<div><a href='/New_lessons/14_animal/delete_record.php?Delete_id={$data[$i]['id']}'><button class='btn btn-danger'>Delete</button></a></div>";

                    // добавляем все записи для вывода таблицы
                    $number = $i + 1;
                    $out .= "<tr><th scope='row'>{$number}</th><td>{$data[$i]['id']}</td><td>{$data[$i]['title']}</td><td>{$data[$i]['descr_min']}</td><td>{$data[$i]['description']}</td><td>{$image}</td><td>{$delete}</td></tr>";
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



