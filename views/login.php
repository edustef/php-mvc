<?php

/**
 * @var $model \app\models\User
 */

use app\core\form\FormField;
?>

<h1>Login page</h1>
<form action="" method="POST">
  <?= FormField::render($model, 'email', 'Email', FormField::TYPE_EMAIL) ?>
  <?= FormField::render($model, 'password', 'Password', FormField::TYPE_PASSWORD) ?>
  <button type="submit" class="btn btn-primary">Submit</button>
</form