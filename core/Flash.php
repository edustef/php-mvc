<?php

namespace app\core;

class Flash
{
  protected const FLASH_KEY = 'flash_messages';

  public function __construct()
  {
    session_start();
    $flashMessages = $_SESSION['flash_messages'] ?? [];
    foreach ($flashMessages as &$flashMessage) {
      //mark to be removed
      $flashMessage['remove'] = true;
    }

    $_SESSION['flash_messages'] = $flashMessages;
  }
  public function getFlash($key)
  {
    return $_SESSION[self::FLASH_KEY][$key]['value'] ?? [];
  }

  public function setFlash($key, $message)
  {
    $_SESSION[self::FLASH_KEY][$key] = [
      'remove' => false,
      'value' => $message
    ];
  }


  public function __destruct()
  {
    $flashMessages = $_SESSION['flash_messages'] ?? [];
    foreach ($flashMessages as $key => &$flashMessage) {
      if ($flashMessage['remove'] === true) {
        unset($flashMessages[$key]);
      }
    }

    $_SESSION['flash_messages'] = $flashMessages;
  }
}
