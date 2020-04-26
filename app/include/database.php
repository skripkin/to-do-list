<?php

$link = mysqli_connect(localhost,'root', 'root', skripkin_eugene);

if(mysqli_connect_errno()) 
{
    echo('Ошибка подключения к базе данных');
    exit();
}

?>