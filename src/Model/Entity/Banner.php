<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Model\Entity\FuncoesTrait;
/**
 * Banner Entity
 *
 * @property int $id
 * @property string $nome
 * @property bool $externo
 * @property string $link
 * @property int|null $tempo
 * @property string $imagem
 * @property bool|null $ativo
 */
class Banner extends Entity
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
        'externo' => true,
        'link' => true,
        'tempo' => true,
        'imagem' => true,
        'ativo' => true
    ];

    protected $folder = [
        'imagem'=>'img/banners/'
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
