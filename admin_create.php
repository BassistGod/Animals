<?php
require_once 'template/header.php';

// создаем список для выбора тегов 
$tag = getAllTags($mysql);
close ($mysql);

// добавляем записи в базу данных
if (isset($_POST['title']) AND $_POST['title'] !=''){
    $title = $_POST['title'];
    $descr_min = $_POST['descr_min'];
    $description = $_POST['description'];
    $newTags = $_POST['tag'];
    $category =  $_POST['category'];

    if (isset($category) AND $category !=''){
        if ($category != 'Без категории'){
            for ($i=0; $i < count($AllCat); $i++){
                if ($category == $AllCat[$i]['category']){
                $catId = $AllCat[$i]['id'];
                }
            }
        } 
    }

    move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$_FILES['image']['name']);

    $mysql = connect();
    $sql = "INSERT INTO info (title, category, descr_min, description, image) 
    VALUES ('$title', '$catId', '$descr_min', '$description', '".$_FILES['image']['name']."')";
   
    if ($mysql->query($sql) === TRUE) {
        if (isset($newTags) AND $newTags !=''){
            $lastId = $mysql->insert_id;
            for ($i=0; $i < count($newTags); $i++){
                $sql = "INSERT INTO tag (tag, post) VALUES ('$newTags[$i]', '$lastId')";
                $mysql->query($sql);
            }
        }
        header('Location: /New_lessons/14_animal/admin.php');
        setcookie("bd_create_success", '1', time()+10);
    } else {
        echo "Error: " . $sql . "<br>" . $mysql->error . '<br>';
    }
    close ($mysql);
} 

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Create post</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Введите название животного">
                    <!-- <small id="title" class="form-text text-muted">Введите название животного</small> -->
                </div>    
                <div class="form-group">
                    <label for="descr_min">Min description:</label>
                    <input type="text" name="descr_min" class="form-control" id="descr_min" placeholder="Введите краткое описание">
                    <!-- <small id="descr_min" class="form-text text-muted">Введите краткое описание</small> -->
                </div> 
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control" id="description" placeholder="Введите полное описание" rows="3"></textarea>
                    <!-- <small id="description" class="form-text text-muted">Введите полное описание</small> -->
                </div> 
                <!-- Выбираем категорию -->
                <div class="form-group">
                    <label for="category">Category select:</label>
                    <select name ="category" class="form-control" id="category">
                        <?php
                        $out = '';
                        $out .= "<option>Без категории</option>";
                        for ($i=0; $i < count($AllCat); $i++){
                            $out .= "<option>{$AllCat[$i]['category']}</option>";
                        }
                        echo $out;
                        ?>
                    </select>
                    <small id="tag" class="form-text text-muted">Выберите подходящую категорию</small> 
                </div>
                <!-- Выбираем теги -->
                <div class="form-group">
                    <label for="tag">Tag input:</label>
                    <select name="tag[]" multiple class="form-control" id="tag">
                        <?php
                        $out = '';
                        for ($i=0; $i < count($tag); $i++){
                            $out .= "<option>{$tag[$i]}</option>";
                        }
                        echo $out;
                        ?>
                    </select>
                    <small id="tag" class="form-text text-muted">Выберите подходящие теги</small> 
                </div> 
                <div class="form-group">
                    <label for="image">Photo:</label>
                    <input type="file" name="image" class="form-control-file" id="image">
                    <small id="image" class="form-text text-muted">Загрузите изображение животного</small>
                </div> 
                <div class="form-group">
                    <input type="submit" value="Add new article" class="btn btn-success">
                    <!-- <button type="submit" class="btn btn-primary mb-2">Add new article</button> -->
                </div> 
            </form>
        </div>
    </div>
</div>

<?php
require_once 'template/footer.php';
?>
