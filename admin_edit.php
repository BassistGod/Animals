<?php
require_once 'template/header.php';
// создаем список для выбора тегов 
$tag = getAllTags($mysql);
// выбираем теги редактируемой статьи
$postTags = getArticleTags($mysql);
// получаем данные по нужной статье из info
$data = selectArticle($mysql);
close ($mysql);

// изменяем запись в базе данных
if($_POST['check'] == 'Cancel'){
    header('Location: /New_lessons/14_animal/admin.php');
    setcookie("bd_edit_cancel", '1', time()+10);
} elseif ($_POST['check'] == 'Confirm') {    
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
        
        if(isset($_FILES['image']['name']) AND $_FILES['image']['name'] !=''){
            move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$_FILES['image']['name']);
            $newImage = $_FILES['image']['name'];
        } else {
            $newImage = $data['image'];    
        }

        $mysql = connect();
        $sql = "UPDATE info SET title='$title', category='$catId', descr_min='$descr_min', description='$description', image='$newImage'  WHERE id=".$_GET['id'];

        if ($mysql->query($sql) === TRUE) {
            $sql = "DELETE FROM tag WHERE post=".$_GET['id'];
            $mysql->query($sql);
            if (isset($newTags) AND $newTags !=''){
                for ($i=0; $i < count($newTags); $i++){
                    $sql = "INSERT INTO tag (tag, post) VALUES ('$newTags[$i]', '".$_GET['id']."')";
                    if ($mysql->query($sql) === TRUE) {
                    } else {
                        echo "Error: " . $sql . "<br>" . $mysql->error . '<br>';
                    }
                }    
            }
            header('Location: /New_lessons/14_animal/admin.php');
            setcookie("bd_edit_success", '1', time()+10);
        } else {
            echo "Error: " . $sql . "<br>" . $mysql->error . '<br>';
        }
        close ($mysql);
    }
}    

?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Edit post</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" class="form-control" value="<?php echo $data['title']; ?>" id="title">
                    <small id="title" class="form-text text-muted">Введите название животного</small>
                </div>
                <div class="form-group">
                    <label for="descr_min">Min description:</label>
                    <input type="text" name="descr_min" class="form-control" value="<?php echo $data['descr_min']; ?>" id="descr_min">
                    <small id="descr_min" class="form-text text-muted">Введите краткое описание</small>
                </div>     
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea type="text" name="description" class="form-control" id="description" rows="5"><?php echo $data['description']; ?></textarea>
                    <small id="description" class="form-text text-muted">Введите полное описание</small>
                </div> 
                <!-- Выбираем категорию -->
                <div class="form-group">
                    <label for="category">Category select:</label>
                    <select name ="category" class="form-control" id="category">
                        <?php
                            if (isset($data['category']) AND $data['category'] !=''){
                                $out = '';
                                $out .= "<option>Без категории</option>";
                                for ($i=0; $i < count($AllCat); $i++){
                                    if ($AllCat[$i]['id'] == $data['category']){
                                        $out .= "<option selected>{$AllCat[$i]['category']}</option>";
                                    } else {
                                        $out .= "<option>{$AllCat[$i]['category']}</option>"; 
                                    }   
                                }
                                echo $out;
                            } else {
                                $out = '';
                                $out .= "<option selected>Без категории</option>";
                                for ($i=0; $i < count($AllCat); $i++){
                                    $out .= "<option>{$AllCat[$i]['category']}</option>";
                                }
                                echo $out;
                            }         
                        ?>
                    </select>
                    <small id="tag" class="form-text text-muted">Выберите подходящую категорию</small> 
                </div>
                <!-- Выбираем теги -->
                <div class="form-group">
                    <label for="tag">Tag input:</label>
                    <!-- <select name="tag[]" multiple class="form-control" id="tag" size="4"> -->
                        <?php
                        $out = '';
                        $countTag = count($tag);
                        $out = "<select name='tag[]' multiple class='form-control' id='tag' size='$countTag'>";
                        for ($i=0; $i < count($tag); $i++){
                            $checkTag = 0;
                            for ($j=0; $j < count($postTags); $j++){
                                if ($postTags[$j]['tag'] == $tag[$i]){
                                    $checkTag = 1;
                                } 
                            }
                            if ($checkTag == 0){
                                $out .= "<option>{$tag[$i]}</option>";
                            } else {
                                $out .= "<option selected>{$tag[$i]}</option>";
                            }
                        }
                        echo $out;
                        ?>
                    </select>
                    <small id="tag" class="form-text text-muted">Выберите подходящие теги</small> 
                </div> 
                <!-- Загрузка фото -->
                <label>Photo:</label>
                    <?php
                    echo '<br>';
                    $image = "<img src='/New_lessons/14_animal/images/{$data['image']}' class='img-thumbnail mb-3' width='20%' >";
                    echo $image;
                    ?>
                <div class="form-group">
                    <!-- <label for="image"></label> -->
                    <input type="file" name="image" class="form-control-file" id="image">
                    <small id="image" class="form-text text-muted">Загрузите изображение животного</small>
                </div> 
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <input type="submit" name='check' value="Confirm" class="btn btn-success">
                            <!-- <button type="submit" class="btn btn-primary mb-2">Add new article</button> -->
                        </div> 
                    </div>
                    <div class="col-lg-9 text-right">
                        <input type="submit" name='check' value="Cancel" class="btn btn-danger">
                    </div>    
                </div>
            </form>            
        </div>
    </div>
</div>
