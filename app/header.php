<?php
  include 'include/database.php';
  include 'include/functions.php';

  session_start();

  $sort = '';

  //Сортировка по GET
  if($_GET['by-name?page'] || $_GET['by-name-sort?page']) {
    $namesort = 'name';
    if($_GET['by-name-sort?page']) {
      $page = $_GET['by-name-sort?page'];
      $sort = 'DESC';
      $pagesort = '?by-name-sort?';
    } else {
      $page = $_GET['by-name?page'];
      $pagesort = '?by-name?';
    }
  } elseif ($_GET['by-email?page'] || $_GET['by-email-sort?page']) {
    $namesort = 'email';
    if($_GET['by-email-sort?page']) {
      $page = $_GET['by-email-sort?page'];
      $sort = 'DESC';
      $pagesort = '?by-email-sort?';
    } else {
      $page = $_GET['by-email?page'];
      $pagesort = '?by-email?';
    }
  } elseif ($_GET['by-status?page'] || $_GET['by-status-sort?page']) {
    $namesort = 'status';
    if($_GET['by-status-sort?page']) {
      $page = $_GET['by-status-sort?page'];
      $sort = 'DESC';
      $pagesort = '?by-status-sort?';
    } else {
      $page = $_GET['by-status?page'];
      $pagesort = '?by-status?';
    }
  } else {
    $page = isset($_GET['page']) ? $_GET['page']: 1;
    $namesort = 'id';
    $pagesort = '?';
  };
  
  if($_GET['do'] == 'logout') {
    unset($_SESSION['admin']);
    session_destroy;
    header('Location: index.php');
  }

  $limit = 3;
  $offset = $limit * ($page - 1);

  $getcount = intval(get_tbcount());
  $total = ceil($getcount / $limit);

  $getInfo = get_inf($limit, $offset, $namesort, $sort);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="public/css/style.css" rel="stylesheet">
    <title>Сайт задачник</title>
  </head>
  <body>
    <div class="container" style="padding:0;">
      <div class="navbar-header d-flex justify-content-between align-items-center">
        <a href="/index.php" class="navbar-brand">Главная</a>
        <div class="d-flex align-items-center">
          <a href="/adminpage.php" class="navbar-brand">Панель администратора</a>
          <?if($_SESSION['admin']):?><a href="adminpage.php?do=logout" class="btn btn-success">Выход</a><?endif?>
        </div>
      </div>
          
      <nav class="navbar-default border mt-3">
        <ul class="nav nav-color">
          <?php if($_SESSION['admin'] == false): ?>
            <li class="col-md-2 name d-flex justify-content-between"><a href="./?by-name?page=<?=$page?>">Имя</a><a class="mleft" href="./?by-name-sort?page=<?=$page?>">&#9660</a></li>
            <li class="col-md-3 email d-flex justify-content-between"><a href="./?by-email?page=<?=$page?>">Почта</a><a class="mleft" href="./?by-email-sort?page=<?=$page?>">&#9660</a></li>
            <li class="col-md-5 email"><p>Описание задачи</p></li>
            <li class="col-md-2 tasks d-flex justify-content-between"><a href="./?by-status?page=<?=$page?>">Статус</a><a class="mleft" href="./?by-status-sort?page=<?=$page?>">&#9660</a></li>
          <?php else: ?>
            <li class="col-md-2 name d-flex justify-content-between"><a href="./adminpage.php?by-name?page=<?=$page?>">Имя</a><a class="mleft" href="./adminpage.php?by-name-sort?page=<?=$page?>">&#9660</a></li>
            <li class="col-md-3 email d-flex justify-content-between"><a href="./adminpage.php?by-email?page=<?=$page?>">Почта</a><a class="mleft" href="./adminpage.php?by-email-sort?page=<?=$page?>">&#9660</a></li>
            <li class="col-md-5 email"><p>Описание задачи</p></li>
            <li class="col-md-2 tasks d-flex justify-content-between"><a href="./adminpage.php?by-status?page=<?=$page?>">Статус</a><a class="mleft" href="./adminpage.php?by-status-sort?page=<?=$page?>">&#9660</a></li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
