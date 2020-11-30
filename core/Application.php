<?php

namespace app\core;

class Application
{
  public static Application $app;
  public static string $ROOT_DIR;
  public Database $database;
  public Router $router;
  public Request $request;
  public Response $response;
  public Flash $flash;
  public Controller $controller;

  public function __construct(string $rootPath, array $config)
  {
    self::$ROOT_DIR = $rootPath;
    self::$app = $this;
    $this->request = new Request();
    $this->response = new Response();
    $this->router = new Router($this->request, $this->response);
    $this->flash = new Flash();
    $this->controller = new Controller();

    $this->database = new Database($config['db']);
  }

  public function run()
  {
    echo $this->router->resolve();
  }
}
