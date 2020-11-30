<?php

namespace app\core;

abstract class DatabaseModel extends Model
{
  abstract public function tableName(): string;


  public function save()
  {
    $tableName = $this->tableName();
    $attributes = array_keys($this->attributes());
    $params = array_map(fn ($attr) => ':' . $attr,  $attributes);

    $stmnt = self::prepare('INSERT INTO ' . $tableName . ' (' . implode(',', $attributes) . ') VALUES (' . implode(',', $params) . ')');
    foreach ($attributes as $attribute) {
      $stmnt->bindValue(':' . $attribute, $this->{$attribute});
    }

    $stmnt->execute();
    return true;
  }

  public static function prepare(string $mysql)
  {
    return Application::$app->database->pdo->prepare($mysql);
  }
}
