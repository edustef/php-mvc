<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    if ($request->isPost()) {
      return 'handle login data';
    }
    return $this->render('login');
  }

  public function register(Request $request)
  {
    $registerModel = new RegisterModel();
    if ($request->isPost()) {
      $registerModel->loadData($request->getBody());

      if ($registerModel->validate() && $registerModel->register()) {
        return 'success handle register data';
      }

      echo '<pre>' . print_r($registerModel->errors, true) . '</pre>';
      return $this->render('register', [
        'model' => $registerModel
      ]);
    }

    return $this->render('register', [
      'model' => $registerModel
    ]);
  }
}
