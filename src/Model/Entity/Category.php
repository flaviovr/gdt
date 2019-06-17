<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Category extends Entity {

    protected $_accessible = [
        'nome' => true,
        'slug' => true,
        'ordem' => true,
        'menu_id' => true,
        'posts' => true,
        'menu' => true
    ];
}
