<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Model\Entity\FuncoesTrait;

/**
 * Menu Entity
 *
 * @property int $id
 * @property string $nome
 * @property string $slug
 *
 * @property \App\Model\Entity\Region[] $regions
 */
class Menu extends Entity
{
    use FuncoesTrait;
    /**use App\Model\Entity\FuncoesTrait;
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
        'slug' => true,
        'ordem' => true,
        'imagem'=>true,
        'regions' => true
    ];

    protected $folder = [
        'imagem'=>'img/headers/'
    ];
    
    protected $_virtual = [
        'imagem_path',
    ];

    protected function _getImagemPath($data)
    {
        return $this->getPath('imagem',$this->folder['imagem']);
    }
}
