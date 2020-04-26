<?php 
  require 'app/header.php';
?>

<div class="container">
  <?php foreach ($getInfo as $info):?>
    <div class="row border">
      <div class="col-md-2 name">
        <p><?= htmlentities($info["name"])?></p>
      </div>
      <div class="col-md-3 email">
        <p><?= htmlentities($info["email"])?></p>
      </div>
      <div class="col-md-5 email">
        <p><?=mb_substr($info["task"], 0, 140, 'UTF-8').'. . .'?></p>
        <a class="btn-sm mleft" href="/task.php?task_id=<?= htmlentities($info['id'])?>">Читать полностью</a>
      </div>
      <div class="col-md-2 d-flex justify-content-center">
        <?if($info["status"] == true):?>
          <p class="text-nowrap">Выполнено</p>
        <?else:?>
          <p class="text-nowrap">Не выполнено</p>
        <?endif?>
      </div>
    </div>
  <?php endforeach;?>
</div>

<div class="container text">
  <?php 
  if($getcount > $limit){
    // Проверяем нужны ли стрелки назад 
    if ($page != 1) $pervpage = '<a href= ./'.$pagesort.'page=1><<</a> 
                                  <a href= ./'.$pagesort.'page='. ($page - 1) .'><</a> '; 
    // Проверяем нужны ли стрелки вперед 
    if ($page != $total) $nextpage = ' <a href= ./'.$pagesort.'page='. ($page + 1) .'>></a> 
                                        <a href= ./'.$pagesort.'page=' .$total. '>>></a>'; 
    // Находим ближайшие станицы с обоих краев, если они есть 
    if($page - 1 > 0) $page1left = '<a href= ./'.$pagesort.'page='. ($page - 1) .'>'. ($page - 1) .'</a> | '; 
    if($page + 1 <= $total) $page1right = ' | <a href= ./'.$pagesort.'page='. ($page + 1) .'>'. ($page + 1) .'</a>'; 

    echo $pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage;
  };
  ?>
</div>
<!-- <?if($_SESSION['add-task']):?><span class="center"><?=$_SESSION['add-task']?></span><?endif?> -->
<div class="container col-md-6">
  <div class="form-group"><br>
    <form action="/taskform.php" method="post">
      <?if(isset($_SESSION["name-error"]) || isset($_SESSION['email-error']) || isset($_SESSION['task-error'])):?>
        <?if(isset($_SESSION['name-error'])):?><span class="error-text"><?=$_SESSION['name-error']?></span><?endif?>
        <input type="text" name="name" value="<?echo($_SESSION['name'])?>" class="form-control" placeholder="Введите имя"><br>

        <?if(isset($_SESSION['email-error'])):?><span class="error-text"><?=$_SESSION['email-error']?></span><?endif?>
        <input type="email" name="email" value="<?echo($_SESSION['email'])?>" class="form-control" placeholder="Введите почтовый адрес"><br>

        <?if(isset($_SESSION['task-error'])):?><span class="error-text"><?=$_SESSION['task-error']?></span><?endif?>
        <textarea type="text" class="form-control" name="task" rows="4" placeholder="Введите описание задачи"><?=$_SESSION['task']?></textarea>
      <?else:?>
        <input type="text" name="name" value="" class="form-control" placeholder="Введите имя"><br>
        <input type="email" name="email" value="" class="form-control" placeholder="Введите почтовый адрес"><br>
        <textarea type="text" class="form-control" name="task" rows="4" placeholder="Введите описание задачи"></textarea>
      <?endif?>
      <button class="btn btn-success cbottom" type="submit">Отправить</button>
    </form>
  </div>
</div>
<?php
  require 'app/footer.php';
?>