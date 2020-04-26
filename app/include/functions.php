<?php

//Функция получения задачи
function get_inf($limit, $offset, $namesort, $sort) {
    global $link;
    $sql = sprintf("SELECT * FROM tasks ORDER BY `$namesort` $sort LIMIT $limit OFFSET %d;", $offset);
    $result = mysqli_query($link, $sql);
    $info = mysqli_fetch_all($result, 1);
    return $info;
};

//Функция получения данных задачи по id
function get_tsk($task_id) {
    global $link;
    $sql = "SELECT * FROM tasks WHERE id = ".$task_id;
    $result = mysqli_query($link, $sql);
    $task = mysqli_fetch_assoc($result);
    return $task;
};

// Добавление данных с формы в БД
function get_create($name, $email, $taskForm) {
    
    global $link;

    $taskOut = "INSERT INTO tasks (`name`, `email`, `task`) VALUES ('$name', '$email', '$taskForm')";
    $result = mysqli_query($link, $taskOut);

    if ($result) {
        header("Location: index.php");
    } else {
        echo "Произошла ошибка, пожалуйста повторите попытку.";
    };
};

//Сравнение пароля с паролем пользователя в БД
function get_user() {
    global $link;
    $sql = "SELECT * FROM users WHERE id = 1";
    $result = mysqli_query($link, $sql);
    $use = mysqli_fetch_assoc($result);
    return $use;
};

//Корректировка данных БД
function get_correct($correctName, $correctEmail, $correctTask, $correctStatus, $task_id) {
    global $link;

    $taskCorrect = "UPDATE tasks SET `name` = '$correctName', `email` = '$correctEmail', `task` = '$correctTask', `status` = '$correctStatus' WHERE id = '$task_id' ";
    $result = mysqli_query($link, $taskCorrect);

    if($result) {
        echo '<p class="container text">Данные сохранены</p>';
    } else {
        echo '<p class="container text">Произошла ошибка, проверьте текст, возможно в нем есть не допустимые символы такие как (\',",/,\,)</p>';
    };
};

//Количество записей в БД
function get_tbcount() {
    global $link;

    $countbd = "SELECT * FROM `tasks`";
    $result = mysqli_query($link, $countbd);
    $counts = mysqli_num_rows($result);

    return $counts;
};
?>