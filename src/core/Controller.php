<?php

namespace app\core;

use app\core\middleware\Middleware;

class Controller
{
  public array $middlewares = [];
  public string $layout = 'main';
  public string $action = '';

  public function render($view, $params = [])
  {
    return Application::$app->view->renderView($view, $params);
  }

  public function setLayout($layout)
  {
    $this->layout = $layout;
  }

  public function registerMiddleware(Middleware $middleware) {
    $this->middlewares[] = $middleware;
  }
}
