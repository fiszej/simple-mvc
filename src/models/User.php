<?php
declare(strict_types=1);

namespace app\src\models;

use app\src\core\Model;
use app\src\core\App;
use app\src\core\DB;

class User extends Model
{
    public array $errors = [];

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $passwd = '';
    public string $passwdC = '';

    // Load data from request to class property.
    public function loadToProperty(array $data, int $mode)
    {
        if ($mode == 1) {
            $this->getDataFromRequest($data);
            return;
        }
        if ($mode == 2) {
            $this->loadFromDatabase($data);
            return;
        }
    }

    // Validate send data with definied rules.
    public function validate()
    {
       $this->required()->isEmail()->betwen()->passwordMatch();
    }

    public function isEmail()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email is incorrect.';
        }
        return $this;
    }

    public function required() 
    {
        if (empty($this->firstname)) {
            $this->errors['req'] = 'This Field is required';
        }
        if (empty($this->lastname)) {
            $this->errors['req'] = 'This Field is required';
        }
        return $this;
    }

    public function betwen() 
    {
        if (strlen($this->passwd) < 5) {
            $this->errors['min'] = 'This Field must be min 5 chars';
        }
        if (strlen($this->passwd) > 15) {
            $this->errors['max'] = 'This Field must be max 15 chars';
        }
        return $this;
    }

    public function passwordMatch()
    {
        if ($this->passwd !== $this->passwdC) {
            $this->errors['password'] = 'This Field must be match with confirm password';
        }
        return $this;
    }


    // add user to DB.
    public function save()
    {

    }

    public function findOne($id)
    {
        return App::$db->findOneById($id);
    }

    
}