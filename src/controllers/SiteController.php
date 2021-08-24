<?php
declare(strict_types=1);

namespace app\src\controllers;

use app\src\core\Controller;
use app\src\core\QueryBuilder;
use app\src\models\User;
use app\src\core\Request;
use app\src\core\Response;

class SiteController extends Controller 
{
    public function index()
    {

    }

    public function create()
    {     
        $user = new User();
        $user->loadToProperty($_POST, 1);
        $user->validate();

        $firstname = $user->firstname;
        $lastname = $user->lastname;
        $email = $user->email;
        $passwd = password_hash($user->passwd, PASSWORD_BCRYPT);

        if (!$user->errors) {
           $qb = new QueryBuilder();
           $qb->insert($user::TABLE, "firstname, lastname, email, passwd")
              ->values([$firstname, $lastname, $email, $passwd])
              ->executeInsertQuery();
            return true;
        }
        return Response::setStatusCode(404);
    }

    public function register()
    {
        return $this->view('register');
    }

    public function show()
    {
        
        $user = new User();
        $qb = new QueryBuilder();

        $firstname = 'Radek';
        $lastname = 'Kowalski';
        $email = 'example@dot.com';
        $passwd = password_hash('123123dasd', PASSWORD_BCRYPT);

        $result = $qb
            ->insert($user::TABLE, "firstname, lastname, email, passwd")
            ->values([$firstname, $lastname, $email, $passwd])
            ->executeInsertQuery();  
    }
}