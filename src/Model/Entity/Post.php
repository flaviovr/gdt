<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Post Entity
 *
 * @property int $id
 * @property int|null $region_id
 * @property int|null $location_id
 * @property int $category_id
 * @property int|null $discount_id
 * @property string $titulo
 * @property string $subtitulo
 * @property string $slug
 * @property string $texto
 * @property bool|null $ativo
 * @property bool|null $destaque
 * @property \Cake\I18n\FrozenTime $criado_em
 * @property \Cake\I18n\FrozenTime $alterado_em
 * @property \Cake\I18n\FrozenTime $publicado_em
 * @property string $imagem
 *
 * @property \App\Model\Entity\Region $region
 * @property \App\Model\Entity\Location $location
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Discount $discount
 */
class Post extends Entity
{
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
        'region' => true,
        'location' => true,
        'category' => true,
        'discount' => true
    ];
}
