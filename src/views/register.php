<?php

/**
 * @var $model \app\models\User
 */

use edustef\mvcFrame\forms\FormField;

?>

<h1>Register page</h1>
<form action="" method="POST">
  <?= FormField::render($model, 'email', 'Email', FormField::TYPE_EMAIL) ?>
  <?= FormField::render($model, 'password', 'Password', FormField::TYPE_PASSWORD) ?>
  <?= FormField::render($model, 'passwordConfirm', 'Confirm Password', FormField::TYPE_PASSWORD) ?>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>