<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Model\Entity\FuncoesTrait;

/**
 * Region Entity
 *
 * @property int $id
 * @property string $nome
 * @property string|null $desc
 * @property string $imagem
 *
 * @property \App\Model\Entity\Location[] $locations
 */
class Region extends Entity
{
    use FuncoesTrait; 
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'nome' => true,
        'descricao' => true,
        'menu_id'=> true,
        'imagem' => true,
        'slug' => true,
        'ordem'=> true,
        'locations' => true,
        'menus'=>true,
    ];

    protected $folder = [
        'imagem'=>'img/headers/'
    ];
    
    protected $_virtual = [
        'imagem_path',
    ];

    // protected function _setImagem($data)
    // {
    //     return $this->saveImage($data, 'imagem',  $this->folder['imagem']);
    // }

    protected function _getImagemPath($data)
    {
        return $this->getPath('imagem',$this->folder['imagem']);
    }

}
