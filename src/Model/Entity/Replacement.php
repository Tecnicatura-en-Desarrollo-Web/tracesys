<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Replacement Entity
 *
 * @property int $replacement_id
 * @property string $marca
 * @property string $modelo
 * @property string $descripcion
 * @property \Cake\I18n\FrozenTime $fecha_ingreso
 * @property int $cantidad
 * @property int $valor
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Replacement extends Entity
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
        'marca' => true,
        'modelo' => true,
        'descripcion' => true,
        'cantidad' => true,
        'valor' => true,
        'created' => true,
        'modified' => true,
    ];
}