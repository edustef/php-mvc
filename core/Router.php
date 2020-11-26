<?php

namespace app\core;

class Router
{
  protected array $routes = [];
  protected Request $request;

  public function __construct($request)
  {
    $this->request = $request;
  }

  public function get($path, $callback)
  {
    $this->routes['get'][$path] = $callback;
  }

  public function resolve()
  {
    $path = $this->request->getPath();
    $method = $this->request->getMethod();

    echo '<pre>'.print_r($routes, true).'</pre>';

    $callback = $this->routes[$method][$path] ?? false;

    if ($callback === false) {
      // TODO - make it return a status of 404
      echo "404 not found";
      exit;
    }

    echo call_user_func($callback);
  }
}
