<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Location extends Entity {

    protected $_accessible = [
        'nome' => true,
        'slug' => true,
        'descricao' => true,
        'imagem' => true,
        'region_id' => true,
        'ordem' => true,
        'region' => true,
        'posts' => true
    ];
    
}
