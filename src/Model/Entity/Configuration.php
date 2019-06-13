<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Configuration Entity
 *
 * @property string $nome
 * @property string $data
 */
class Configuration extends Entity
{
    protected $_accessible = [
        '*' => true
    ];

    // protected $folder = [
    //     'imagem'=>'img/banners/'
    // ];
    // protected $_virtual = [
    //     'imagem_path',
    // ];

    // protected function _setData($data)
    // {
    //     return json_encode($data);
    // }

    // protected function _getData($data)
    // {
    //     return json_decode($data,true);
    // }


}
