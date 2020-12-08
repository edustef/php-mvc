<?php

/**
 * @var edustef\mvcFrame\Model $model
 */

use app\views\components\FormField;

?>

<h1>Login page</h1>
<form action="" method="POST">
  <?= new FormField($model, 'email', FormField::TYPE_EMAIL) ?>
  <?= new FormField($model, 'password', FormField::TYPE_PASSWORD) ?>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
  document.querySelector('input[name=email]').addEventListener('keyup', async (e) => {
    let fd = new FormData();
    fd.append('email', e.target.value);
    fd.append('isAjax', true);

    let res = await fetch('/login', {
      method: "POST",
      body: fd
    });

    let data = await res.text();

    console.log(data);
  });
</script>