<?php
  session_start();

  if(!$_SESSION['admin']){
    header("Location: auto.php");
    exit();
  };

  require 'app/header.php';
?>

<div class="container">
  <?php foreach ($getInfo as $info):?>
    <div class="row border">
      <div class="col-md-2 name">
        <p><?=htmlentities($info["name"])?></p>
      </div>
      <div class="col-md-3 email">
        <p><?=htmlentities($info["email"])?></p>
      </div>
      <div class="col-md-5 email">
        <p><?=mb_substr($info["task"], 0, 140, 'UTF-8').'. . .'?></p>
        <a class="btn-sm mleft" href="/task.php?task_id=<?=htmlentities($info['id'])?>">Читать полностью</a>
      </div>
      <div class="col-md-2 d-flex flex-column justify-content-center align-items-center">
        <?if($info["status"] == true):?>
            <p class="text-nowrap">Выполнено</p>
        <?else:?>
            <p class="text-nowrap">Не выполнено</p>
        <?endif?>
        <a class="btn-sm" href="/task.php?task_id=<?=htmlentities($info['id'])?>">Редактировать задачу</a>
      </div>
    </div>
  <?php endforeach;?>

  <div class="container text">
    <?php 
      if($getcount > $limit) {
        // Проверяем нужны ли стрелки назад 
        if ($page != 1) $pervpage = '<a href= ./adminpage.php'.$pagesort.'page=1><<</a> 
                                        <a href= ./adminpage.php'.$pagesort.'page='. ($page - 1) .'><</a> '; 
        // Проверяем нужны ли стрелки вперед 
        if ($page != $total) $nextpage = ' <a href= ./adminpage.php'.$pagesort.'page='. ($page + 1) .'>></a> 
                                            <a href= ./adminpage.php'.$pagesort.'page=' .$total. '>>></a>'; 
        // Находим ближайшие станицы с обоих краев, если они есть 
        if($page - 1 > 0) $page1left = '<a href= ./adminpage.php'.$pagesort.'page='. ($page - 1) .'>'. ($page - 1) .'</a> | '; 
        if($page + 1 <= $total) $page1right = ' | <a href= ./adminpage.php'.$pagesort.'page='. ($page + 1) .'>'. ($page + 1) .'</a>'; 

        echo $pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage; 
      };
    ?>
  </div>
</div>