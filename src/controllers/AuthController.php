<?php
declare(strict_types=1);

namespace app\src\controllers;

use app\src\core\Controller;
use app\src\models\User;
use app\src\core\QueryBuilder;
use app\src\core\Session;

class AuthController extends Controller
{
    public function register()
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

           Session::setFlashMessage('success', 'Register complete');
            
           return $this->view('index');
        }

        return $this->view('/register', [
            'errors' => $user->errors,
            'user' => $user
        ]);
    }

    public function login()
    {
        $user = new User();
        $user->loadToProperty($_POST, 1);
        if (!$user->isEmail()) {
            $user->errors['email'] = 'Email is incorrect';
        }
        if (!$user->passwd) {
            $user->errors['passwd'] = 'Enter password';
        }
        if (empty($user->errors)) {
            $email = $user->email;
            $qb = new QueryBuilder();

            $results = $qb
            ->select('*')
            ->from($user::TABLE)
            ->where("email = '$email'")
            ->executeSelectQuery();
          
            foreach ($results as $result) {
                if (password_verify($user->passwd, $result['passwd'])) {
                    Session::setFlashMessage('success', 'Welcome to mvc');
                    Session::set('user', $user->email);
                    return $this->view('index');
                }
            }    
        }
        
        return $this->view('/login', [
            'errors' => $user->errors
        ]);     
    }

    public function update()
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
        
        return $this->view('update', [
            'user' => $user
        ]);
    }

    public function logout()
    {

        Session::delete('user');
        Session::delete('flash');
        return header("Location: /");
    }


}