<?php
  session_start();

  if($_SESSION['admin']) {
    header("Location: adminpage.php");
    exit;
  };

  include 'app/include/database.php';
  include 'app/include/functions.php';

  $getUser = get_user();

  $admin = $getUser['name'];
  $password = $getUser['password'];

  if($_POST['submit']) {
    if($admin == $_POST['username'] AND $password == $_POST['password']) {
      $_SESSION['admin'] = $admin;
      header("Location: adminpage.php");
      exit;
    } else {
      echo 'Логин или пароль не верны';
    };
  };

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="public/css/style.css" rel="stylesheet">    
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Document</title>
</head>
<body>
  <div class="container col-md-6">
    <h1 class="center" style="margin: 0 auto;text-align: center;">Страница авторизации</h1>
    <div class="form-group col-md-4"  style="margin: 0 auto;">
      <form method="post">
        Введите логин <input type="text" class="form-control" name="username">
        Введите пароль <input type="password" class="form-control" name="password"> <br>
        <input class="btn btn-success" type="submit" name="submit" value="Войти"  style="margin-left: 8%;">
        <a href="/index.php" class="btn btn-success lhref">На главную</a>
      </form>
    </div>
  </div> 
</body>
</html>