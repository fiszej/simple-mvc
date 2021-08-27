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
            header("Location: /profile");

        // if (!isset($_SESSION['user'])) {
        //     http_response_code(403);
        //     Session::setFlashMessage('403', 'You don\'t have permission to access profil page');
        // }

        // $email = $_SESSION['user'];
        // $user = new User();
        // $qb = new QueryBuilder();
        // $results = $qb->select('firstname, lastname, email, passwd')
        //    ->from($user::TABLE)
        //    ->where("email = '$email'")
        //    ->executeSelectQuery();

        // $result = $results[0];
        // $user->loadToProperty($result, 2);
        
        // return $this->view('update', [
        //     'user' => $user
        // ]);
    }
}