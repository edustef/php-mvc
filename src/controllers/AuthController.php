<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\core\middleware\AuthMiddleware;
use app\models\User;
use app\models\LoginForm;

class AuthController extends Controller
{
  public function __construct()
  {
    $this->registerMiddleware(new AuthMiddleware(['profile']));
  }

  public function login(Request $request, Response $response)
  {
    $loginForm = new LoginForm();
    if ($request->isPost()) {
      $loginForm->loadData($request->getBody());

      if ($loginForm->validate() && $loginForm->login()) {
        Application::$app->session->setFlashSession('success', 'Welcome back!');
        $response->redirect('/');
      }
      return $this->render('login', [
        'model' => $loginForm
      ]);
    }

    return $this->render('login', [
      'model' => $loginForm
    ]);
  }

  public function register(Request $request, Response $response)
  {
    $user = new User();
    if ($request->isPost()) {
      $user->loadData($request->getBody());

      if ($user->validate() && $user->save()) {
        Application::$app->session->setFlashSession('success', 'Thanks for registering!');
        $response->redirect('/');
      }

      return $this->render('register', [
        'model' => $user
      ]);
    }

    return $this->render('register', [
      'model' => $user
    ]);
  }

  public function logout(Request $request, Response $response)
  {
    Application::$app->logout();
    $response->redirect('/');
  }

  public function profile()
  {
    return $this->render('profile');
  }
}