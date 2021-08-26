<?php
declare(strict_types=1);

namespace app\src\controllers;

use app\src\core\Controller;
use app\src\core\Session;
use app\src\models\User;
use app\src\core\QueryBuilder;

class SiteController extends Controller 
{
    public function index()
    {
       return $this->view('index');
    }
   
    public function register()
    {
        return $this->view('register');
    }

    public function login()
    {
        return $this->view('login');
    }

    public function profile()
    {
       
        if (!isset($_SESSION['user'])) {
            http_response_code(403);
            Session::setFlashMessage('403', 'You don\'t have permission to access profil page');
        }

        $email = $_SESSION['user'];
        $user = new User();
        $qb = new QueryBuilder();
        $results = $qb->select('firstname, lastname, email, passwd')
           ->from($user::TABLE)
           ->where("email = '$email'")
           ->executeSelectQuery();

        foreach ($results as $result) {
            $user->loadToProperty($result, 2);
        }
        
        return $this->view('profile', [
            'user' => $user
        ]);
    }
}