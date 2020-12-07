<?php

namespace edustef\mvcFrame;

class Response
{
  public function setStatusCode(int $code)
  {
    http_response_code($code);
  }

  public function redirect(string $path)
  {
    header('Location: ' . $path);
  }
}
