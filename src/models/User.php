<?php
declare(strict_types=1);

namespace app\src\models;

use app\src\core\Model;
use app\src\core\App;

class User extends Model
{
    public const TABLE = 'users';

    public array $errors = [];

    public string $id = '';
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
            $this->loadDataFromDatabase($data);
            return;
        }
    }

    // Validate send data with definied rules.
    public function validate()
    {
       $this->required()
            ->isEmail()
            ->betwen()
            ->passwordMatch()
            ->userExists();
    }

    public function isEmail()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email is incorrect';
        }
        return $this;
    }

    public function required() 
    {
        if (empty($this->firstname)) {
            $this->errors['req'] = 'This Field is required<br>';
        }
        if (empty($this->lastname)) {
            $this->errors['req'] = 'This Field is required<br>';
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

    public function userExists()
    {
        $sql = "SELECT * FROM ".self::TABLE." WHERE email = :email";
        $stmt = App::$db->pdo->prepare($sql);
        $stmt->bindParam(':email', $this->email);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (count($result) != 0) {
            $this->errors['is_exists'] = 'User is already exists.';
        }
        return $this;
    }


    
}