<?php

namespace app\core\form;

use app\core\Model;

class FormField
{
  public const TYPE_TEXT = 'text';
  public const TYPE_PASSWORD = 'password';
  public const TYPE_EMAIL = 'email';
  public const TYPE_COLOR = 'color';
  public const TYPE_DATE = 'date';

  public static function render(Model $model, $name, $labelName, $type = 'text')
  {
    $isInvalidClass = $model->hasErrors($name) ? 'is-invalid' : '';
    return '
      <div class="form-group">
        <label for="' . $name . '">' . $labelName . '</label>
        <input name="' . $name . '" value="' . $model->{$name} . '" class="form-control ' . $isInvalidClass . '" type="' . $type . '">
        <small style="display:inline-block;height:1rem" class="text-danger">' . $model->getFirstError($name) . '</small>
      </div>
    ';
  }
}
