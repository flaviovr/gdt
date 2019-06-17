<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Region extends Entity {

    protected $_accessible = [
        'nome' => true,
        'slug' => true,
        'descricao' => true,
        'imagem' => true,
        'menu_id' => true,
        'ordem' => true,
        'menu' => true,
        'locations' => true,
        'posts' => true
    ];
    
}
