<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\User;
use app\models\LoginForm;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    $loginForm = new LoginForm();
    if ($request->isPost()) {
      $loginForm->loadData($request->getBody());

      if ($loginForm->validate() && $loginForm->login()) {
        Application::$app->session->setSession('success', 'Welcome back!');
        Application::$app->response->redirect('/');
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
        Application::$app->session->setSession('success', 'Thanks for registering!');
        Application::$app->response->redirect('/');
      }

      return $this->render('register', [
        'model' => $user
      ]);
    }

    return $this->render('register', [
      'model' => $user
    ]);
  }

  public function logout()
  {
    Application::$app->logout();
    Application::$app->response->redirect('/');
  }
}
