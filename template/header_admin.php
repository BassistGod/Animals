<?php
require_once 'core/config.php';
require_once 'core/function.php';
$mysql = connect();
$AllCat = getAllCatInfo($mysql);
$AmountCatInfo = getAmountCatInfo($mysql);
?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel='stylesheet' href='css/style.css' />
    
</head>
<body>
<!-- <div class="wrap"> -->
<div class="content">
<div class="wrapper">

<!-- Navtabs -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: #666666;">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item mr-4">
                    <a class="nav-link" aria-current="page" href="/New_lessons/14_animal/index.php">Main page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/New_lessons/14_animal/admin.php">Admin panel</a>
                </li>
            </ul>    
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">    
                <li class="nav-item mr-4">
                    <a class="nav-link" href="/New_lessons/14_animal/login.php">Sign in</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/New_lessons/14_animal/logout.php">Logout</a>
                </li>                   
            </ul>
        </div>
    </div>
</nav>
