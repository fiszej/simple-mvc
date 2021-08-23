<?php
declare(strict_types=1);

namespace app\src\controllers;

use app\src\core\Controller;
use app\src\models\User;
use app\src\core\Request;

class SiteController extends Controller 
{
    public function index()
    {

    }

    public function create()
    {
        $user = new User();
        $user->loadToProperty($_GET, 1);
        $user->validate();
        
        if ($user->validate() && $user->save()) {
            echo 'Success';
        }
    
       
    }

    public function register()
    {
        return $this->view('register');
    }

    public function show()
    {
        $user = new User();
        $user->loadToProperty($user->findOne(1), 2);

        var_dump($user);
    }
}