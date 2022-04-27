<?php
require_once 'core/config.php';
require_once 'core/function.php';

if (isset($_COOKIE['bd_create_success']) AND $_COOKIE['bd_create_success'] !=''){
    if ($_COOKIE['bd_create_success'] == 1){
        setcookie("bd_create_success", '1', time()-10);
        echo "New record created successfully" . '<br>';         
    } 
}

if (isset($_POST['title']) AND $_POST['title'] !=''){
    $title = $_POST['title'];
    $descr_min = $_POST['descr_min'];
    $description = $_POST['description'];

    move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$_FILES['image']['name']);

    $mysql = connect();
    $sql = "INSERT INTO info (title, descr_min, description, image)
    VALUES ('$title', '$descr_min', '$description', '".$_FILES['image']['name']."')";

    if ($mysql->query($sql) === TRUE) {
        header('Location: /New_lessons/14_animal/admin.php');
        setcookie("bd_create_success", '1', time()+10);
    } else {
        echo "Error: " . $sql . "<br>" . $mysql->error . '<br>';
    }
    close ($mysql);
} 

?>
<h2>Create post</h2>
<form action="" method="POST" enctype="multipart/form-data">
  <p>Title:  <input type="text" name="title">  </p>
  <p>Min description:</p>
  <textarea name="descr_min" id="" cols="30" rows="10"></textarea>
  <p>Description:</p>
  <textarea name="description" id="" cols="30" rows="10"></textarea>
  <p>Photo: <input type="file" name="image"></p>
  <p><input type="submit" value="add"></p>

</form>
