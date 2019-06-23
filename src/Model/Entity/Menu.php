<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Menu extends Entity {
    
    protected $_accessible = [
        'nome' => true,
        'slug' => true,
        'ordem' => true,
        'imagem' => true,
        'categories' => true,
        'posts' => true,
        'regions' => true
    ];
}
