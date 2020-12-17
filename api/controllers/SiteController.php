<?php

namespace app\controllers;

use edustef\mvcFrame\Controller;
use edustef\mvcFrame\Request;
use edustef\mvcFrame\Response;

class SiteController extends Controller
{

  public function home(Request $request, Response $response)
  {
    return $response->json(['message' => 'Try to acces another page'], 405);
  }
}