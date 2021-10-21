<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $product_id
 * @property string $tipo
 * @property string $modelo
 * @property string $marca
 * @property string $motivo
 * @property string $prioridad
 * @property string $descripcion
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $client_id
 *
 * @property \App\Model\Entity\Client $client
 */
class Product extends Entity
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
        'tipo' => true,
        'modelo' => true,
        'marca' => true,
        'motivo' => true,
        'prioridad' => true,
        'descripcion' => true,
        'created' => true,
        'modified' => true,
        'client_id' => true,
        'client' => true,
    ];
}
