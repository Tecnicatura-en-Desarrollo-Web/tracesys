<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bill Entity
 *
 * @property int $id_factura
 * @property string $descripcion
 * @property \Cake\I18n\FrozenTime $fecha
 * @property int $monto
 * @property string $url_factura
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Bill extends Entity
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
        'descripcion' => true,
        'fecha' => true,
        'monto' => true,
        'url_factura' => true,
        'created' => true,
        'modified' => true,
    ];
}
