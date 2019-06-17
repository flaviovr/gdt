<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher; 

class User extends Entity {

    protected $_accessible = [
        'superuser' => true,
        'nome' => true,
        'email' => true,
        'username' => true,
        'password' => true,
        'r_password' => true
    ];

    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($value)
    {
        if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();
            return $hasher->hash($value);
        }
    }
}
