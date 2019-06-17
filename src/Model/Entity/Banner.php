<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Banner extends Entity {

    protected $_accessible = [
        'nome' => true,
        'externo' => true,
        'link' => true,
        'tempo' => true,
        'imagem' => true,
        'ativo' => true
    ];
    
}
