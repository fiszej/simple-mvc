<?php
declare(strict_types=1);

namespace app\src\controllers;

use app\src\core\Controller;
use app\src\core\Session;
use app\src\core\QueryBuilder;
use app\src\models\User;


class UserController extends Controller
{
    public function update()
    {
        $user = new User();
        $user->loadToProperty($_POST, 1);
        $user->validate();

        $firstname = $user->firstname;
        $lastname = $user->lastname;
        $email = $_SESSION['user'];
        $passwd = password_hash($user->passwd, PASSWORD_BCRYPT);

        $qb = new QueryBuilder();
        $qb->update($user::TABLE)
            ->set("firstname='$firstname', 
                lastname='$lastname', 
                passwd='$passwd'")
            ->where("email='$email'")
            ->executeUpdateQuery();
            
        Session::setFlashMessage('success', 'Successfully updated');
        Session::set('user', $email);
        
        return $this->redirect("/profile");
    }
}