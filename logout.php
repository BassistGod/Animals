<?php
setcookie('id', 0, time()-1*24*60*60);
setcookie('hash', 0, time()-1*24*60*60); 
header('Location: /New_lessons/14_animal/login.php');

