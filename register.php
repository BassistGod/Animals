<?php
require_once 'template/header_admin.php';

// проверяем, должны быть заполнены все поля 
if (isset($_POST['login']) AND ($_POST['login'] =='' OR $_POST['email'] =='' OR $_POST['password'] =='' OR $_POST['repeatPassword'] =='')){
    $status = '<p class="text-danger text-center"><em>You need to enter all the fields</em></p>';
} elseif (isset($_POST['login'])) {
    // сравниваем пароль и повторный пароль
    if ($_POST['password'] != $_POST['repeatPassword']){
        $status = '<p class="text-danger text-center"><em>The password repeat is wrong</em></p>';
    } else {
        // проверяем, занят ли логин
        $login = $_POST['login'];
        $result = $mysql->query("SELECT * FROM users WHERE login='".$login."'");
        if ($result->num_rows > 0) {
            $status = '<p class="text-danger text-center"><em>This login already exists</em></p>';
        } else {
            // проверяем, занят ли email
            $email = $_POST['email'];
            $result = $mysql->query("SELECT * FROM users WHERE email='".$email."'");
            if ($result->num_rows > 0) {
                $status = '<p class="text-danger text-center"><em>This email already exists</em></p>';
            } else {
                $password = md5($_POST['password']);
                $sql = "INSERT INTO users (login, email, password) 
                VALUES ('$login', '$email', '$password')";   
                if ($mysql->query($sql) === TRUE) {
                    setcookie("reg_success", '1' , time()+10);
                    header('Location: /New_lessons/14_animal/login.php');
                } else {
                    $status = '<p class="text-danger text-center"><em>Registration problem</em></p>';
                }
            } 
        }       
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
                <a class="nav-link" id="tab-login" data-mdb-toggle="pill" href="/New_lessons/14_animal/login.php" role="tab"
                aria-controls="pills-login" aria-selected="false">Login</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="tab-register" data-mdb-toggle="pill" href="" role="tab"
                aria-controls="pills-register" aria-selected="true">Register</a>
            </li>
            </ul>
            <!-- Pills navs -->
            
            <div class="tab-pane active" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                <form method="POST">
                <!-- Username input -->
                <div class="form-outline mt-5 mb-4">
                    <input type="text" name ="login" id="registerUsername" class="form-control" />
                    <label class="form-label" for="registerUsername">Username</label>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" name ="email" id="registerEmail" class="form-control" />
                    <label class="form-label" for="registerEmail">Email</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" name ="password" id="registerPassword" class="form-control" />
                    <label class="form-label" for="registerPassword">Password</label>
                </div>

                <!-- Repeat Password input -->
                <div class="form-outline mb-4">
                    <input type="password" name ="repeatPassword" id="registerRepeatPassword" class="form-control" />
                    <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                </div>               

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-3">Sign in</button>
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
