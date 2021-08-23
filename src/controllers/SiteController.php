<?php
declare(strict_types=1);

namespace app\src\controllers;

use app\src\Controller;
use app\src\models\User;
use app\src\Request;

class SiteController extends Controller 
{
    public function index()
    {

    }

    public function registerj()
    {
       $user = new User();
       $user->loadToProperty($_GET);
       $user->validate();

    
       return $this->view('about', [
           'errors' => $user->errors
       ]);
    }

    public function register()
    {
        return $this->view('register');
    }
}