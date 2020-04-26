<?php
  require 'app/include/database.php';
  require 'app/include/functions.php';

  session_start();

  if($_POST['name'] !== "") {
    $name = trim($_POST['name']);
  } else {
    $_SESSION['name-error'] = "Incorrect name";
  };

  if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $email = trim($_POST['email']);
  } else {
    $_SESSION['email-error'] = "Invalid email";
  };

  if($_POST['task'] !== "") {
    $taskForm = trim($_POST['task']);
  } else {
    $_SESSION['task-error'] = "Invalid task";
  };

  if($name && $email && $taskForm) {
    unset($_SESSION['name-error']);
    unset($_SESSION['email-error']);
    unset($_SESSION['task-error']);

    $_SESSION['add-task'] = "Задача создана успешно";

    get_create($name, $email, $taskForm);
  } else {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['task'] = $_POST['task'];

    header('Location: index.php');
  };
?>