<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Model\Entity\FuncoesTrait;

/**
 * Discount Entity
 *
 * @property int $id
 * @property string $nome
 * @property string $link
 * @property \Cake\I18n\FrozenDate|null $validade
 * @property string $imagem
 * @property bool|null $ativo
 */
class Discount extends Entity
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
        'link' => true,
        'slug' => true,
        'validade' => true,
        'imagem' => true,
        'ativo' => true
    ];
    protected $folder = [
        'imagem'=>'img/descontos/'
    ];
    
    protected $_virtual = [
        'imagem_path',
    ];

  

    protected function _getImagemPath($data)
    {
        return $this->getPath('imagem',$this->folder['imagem']);
    }


}
