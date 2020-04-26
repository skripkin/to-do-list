<?php
  session_start();
  require 'app/header.php';
  $task_id = $_GET['task_id'];
  $getTask = get_tsk($task_id);
  $statStart = '';

  if($getTask['status'] == true) {
    $statStart = 'checked';
  } else {
    $statStart = '';
  };

  $getUser = get_user();
  $password = $getUser['password'];  

  if($_POST['password']) {
    $correctName = $_POST['name'];
    $correctEmail = $_POST['email'];
    $correctTask = $_POST['task'];
    $correctStatus = '';

    if($_POST['status'] == on) {
      $correctStatus = 1;
    } else {
      $correctStatus = 0;
    }

    if($getTask['name'] != $_POST['name'] || $getTask['email'] != $_POST['email'] || $getTask['task'] != $_POST['task'] || $getTask['status'] != $_POST['status']) {
      if($password == $_POST['pass']) {
        get_correct($correctName, $correctEmail, $correctTask, $correctStatus, $task_id);
      } else {
        echo '<p class="container text">Пароль введён не верно</p>';
      };
    };
  };
?>

<?php if($_SESSION['admin'] == true): ?>
  <div class="container">
    <form class="row border" id="correctBd" method="post">
      <input type="text" class="col-md-2" name="name" value="<?=htmlentities($getTask['name'])?>">
      <input type="email" class="col-md-3" name="email" value="<?=htmlentities($getTask['email'])?>">
      <textarea type="text" class="col-md-5" name="task" rows="10"><?=htmlentities($getTask['task'])?></textarea>
      <input class="col-md-2 center" type="checkbox" name="status" <?=$statStart?>>
    </form>
    <button class="btn btn-success btn-position mt-4" id="show_popup" OnClick="popUp()">Сохранить</button>

    <div class="overlay_popup" id="overlay_popup"></div>
      <div class="popup" id="popup">
        <div class="object">
          <p>Подтвердите изменения</p>
          <input type="password" class="mbottom" name="pass" form="correctBd">
          <input class="btn btn-success" type="submit" form="correctBd" name="password" value="Подтвердить">
          <button class="btn btn-success" id="close_popup" OnClick="popUpOff()">Отмена</button>
        </div>
      </div>
  </div>
<?php else: ?>
  <div class="container">
    <div class="row border">
      <div class="col-md-2 name d-flex align-items-center">
        <p><?=htmlentities($getTask['name'])?></p>
      </div>
      <div class="col-md-3 email d-flex align-items-center">
        <p><?=htmlentities($getTask['email'])?></p>
      </div>
      <div class="col-md-5 email">
        <p><?=htmlentities($getTask['task'])?></p>
      </div>
      <div class="col-md-2 d-flex justify-content-center align-items-center">
        <?if($info["status"] == true):?>
          <p class="text-nowrap">Выполнено</p>
        <?else:?>
          <p class="text-nowrap">Не выполнено</p>
        <?endif?>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php
  require 'app/footer.php';
?>