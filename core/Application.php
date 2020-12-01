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
  public Session $session;
  public Controller $controller;
  public ?DatabaseModel $user;
  public string $userClass;

  public function __construct(string $rootPath, array $config)
  {
    self::$ROOT_DIR = $rootPath;
    self::$app = $this;
    $this->request = new Request();
    $this->response = new Response();
    $this->router = new Router($this->request, $this->response);
    $this->session = new Session();
    $this->controller = new Controller();

    $this->userClass = $config['userClass'];
    $this->database = new Database($config['db']);

    $primaryValue = $this->session->get('user');

    if ($primaryValue) {
      $primaryKey = $this->userClass::primaryKey();
      $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
    } else {
      $this->user = null;
    }
  }

  public function run()
  {
    echo $this->router->resolve();
  }

  public function login(DatabaseModel $user): bool
  {
    $this->user = $user;
    $primaryKey = $user->primaryKey();
    $primaryValue = $user->{$primaryKey};
    $this->session->set('user', $primaryValue);

    return true;
  }

  public function logout()
  {
    $this->user = null;
    $this->session->remove('user');
  }

  public static function isGuest(): bool
  {
    return !self::$app->user;
  }
}
