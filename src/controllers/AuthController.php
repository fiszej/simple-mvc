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
        try { 
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
        } catch (\Exception $e) {
            die('Cannot register account. Try again later ('.$e->getMessage().')');
        }
    }

    public function login()
    {
        try {
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

                if ($results[0]['email'] != $email) {
                    $user->errors['email'] = 'Account does not exist!';
                    
                } 
                if (password_verify($user->passwd, $results[0]['passwd'])) {
                    Session::setFlashMessage('success', 'Welcome to mvc');
                    Session::set('user', $user->email);
                    return $this->view('index');
                }
            }
            
            return $this->view('/login', [
                'errors' => $user->errors
            ]);  
        } catch (\Exception $e) {
            die('Cannot login to account. Try again later ('.$e->getMessage().')');
        }
    }



    public function logout()
    {
        Session::delete('user');
        Session::delete('flash');
        return header("Location: /");
    }


}