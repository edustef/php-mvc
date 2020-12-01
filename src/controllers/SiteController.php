<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{

  public function home()
  {
    $params = [
      'name' => 'bla bla bla'
    ];

    return $this->render('home', $params);
  }

  public function contact(Request $request)
  {
    if ($request->isPost()) {
      $body = $request->getBody();
      return  'handle contact';
    }
    $params = [
      'name' => 'bla bla bla'
    ];

    return $this->render('contact', $params);
  }
}
