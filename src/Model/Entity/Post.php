<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Post extends Entity{
 
    protected $_accessible = [
        'menu_id' => true,
        'region_id' => true,
        'location_id' => true,
        'category_id' => true,
        'discount_id' => true,
        'titulo' => true,
        'subtitulo' => true,
        'slug' => true,
        'texto' => true,
        'ativo' => true,
        'destaque' => true,
        'criado_em' => true,
        'alterado_em' => true,
        'publicado_em' => true,
        'imagem' => true,
        'menu' => true,
        'region' => true,
        'location' => true,
        'category' => true,
        'discount' => true
    ];
}
