<?php
require_once 'template/header_admin.php';


if ($_POST['login'] !='' AND $_POST['password'] ==''){
    echo 'You need to enter the password';
    echo '<br>';
}
if ($_POST['password'] !='' AND $_POST['login'] ==''){
    echo 'You need to enter the username';
    echo '<br>';
}
if ($_POST['login'] !='' AND $_POST['password'] !=''){
    $login = $_POST['login'];
    $password = $_POST['password'];
    $result = $mysql->query("SELECT id, password FROM users WHERE login='".$login."' LIMIT 1");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();        
        } else {
            echo 'Password is wrong'. '<br>';
    }
    if ($row['password'] == md5($password)){
        $hash = generateHash(20);
        $sql = "UPDATE users SET hash='$hash' WHERE id=".$row['id'];
        if ($mysql->query($sql) === TRUE) {
            setcookie("id", $row['id'], time()+1*24*60*60);
            setcookie("hash", $hash, time()+1*24*60*60, null, null, null, true); // для передачи куки только через http 
            header('Location: /New_lessons/14_animal/admin.php');
        } else {
            echo "Error: " . $sql . "<br>" . $mysql->error . '<br>';
        }
    } else {
        echo 'The username is wrong or the password is wrong'. '<br>';
    }   
}


// проверка успешной записи в базу
if (isset($_COOKIE['reg_success']) AND $_COOKIE['reg_success'] !=''){
    if ($_COOKIE['reg_success'] == 1){
        $status = '<p class="text-success text-center"><em>New account created successfully</em></p>';        
    } 
} 


close ($mysql);
?>

<div class="container mt-5">
    <div class="row justify-content-md-center ">
        <div class="col-lg-4 ">
            <!-- Pills navs -->
            <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="" role="tab"
                aria-controls="pills-login" aria-selected="true">Login</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="/New_lessons/14_animal/register.php" role="tab"
                aria-controls="pills-register" aria-selected="false">Register</a>
            </li>
            </ul>
            <!-- Pills navs -->

            <!-- Pills content -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <form method="POST">
                    <!-- Email input -->
                    <div class="form-outline mt-5 mb-4">
                        <input type="text" name ="login" id="loginName" class="form-control" />
                        <label class="form-label" for="loginName">Username</label>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" name ="password" id="loginPassword" class="form-control" />
                        <label class="form-label" for="loginPassword">Password</label>
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                    </form>
                </div>  
                <?php echo $status; ?>   
            </div>
            <!-- Pills content -->
        </div>
    </div>
</div>


<?php
require_once 'template/footer_down.php';
?>
