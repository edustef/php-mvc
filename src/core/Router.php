<?php

namespace app\core;

class Router
{
  protected array $routes = [];
  protected Request $request;
  protected Response $response;

  public function __construct(Request $request, Response $response)
  {
    $this->response = $response;
    $this->request = $request;
  }

  /**
   * Adds the path and callback to the GET router
   * The callback is called when resolving the path 
   */
  public function get($path, $callback)
  {
    $this->routes['get'][$path] = $callback;
  }

  /**
   * Adds the path and callback to the POST router. 
   * The callback is called when resolving the path 
   */
  public function post($path, $callback)
  {
    $this->routes['post'][$path] = $callback;
  }

  /**
   * Will resolve the method and path of the REQUEST
   * and will run the proper controller and the callback
   * 
   */
  public function resolve()
  {
    $path = $this->request->getPath();
    $method = $this->request->method();

    $callback = $this->routes[$method][$path] ?? false;

    if ($callback === false) {
      $this->response->setStatusCode(404);
      return $this->renderView('_404');
      exit;
    }

    if (is_string($callback)) {
      return $this->renderView($callback);
    }

    //create instance of controller
    if (is_array($callback)) {
      Application::$app->controller = new $callback[0]();
      $callback[0] = Application::$app->controller;
    }

    return call_user_func($callback, $this->request, $this->response);
  }

  public function renderView($view, $params = [])
  {
    $layoutContent = $this->layoutContent();
    $viewContent = $this->viewContent($view, $params);
    return str_replace('{{content}}', $viewContent, $layoutContent);
  }

  protected function layoutContent()
  {
    $layout = Application::$app->controller->layout;
    ob_start();
    include_once Application::$ROOT_DIR . '/views/layouts/' . $layout . '.php';
    return ob_get_clean();
  }

  protected function viewContent($view, $params)
  {
    // creates variables based on the key name and value
    foreach ($params as $key => $value) {
      $$key = $value;
    }
    ob_start();
    include_once Application::$ROOT_DIR . '/views/' . $view . '.php';
    return ob_get_clean();
  }
}
