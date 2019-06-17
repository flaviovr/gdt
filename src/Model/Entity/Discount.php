<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Discount extends Entity {

    protected $_accessible = [
        'nome' => true,
        'link' => true,
        'slug' => true,
        'validade' => true,
        'imagem' => true,
        'ativo' => true
    ];
    
}
