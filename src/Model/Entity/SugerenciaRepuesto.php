<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SugerenciaRepuesto Entity
 *
 * @property int $id_sugerencia
 * @property int $id_repuesto
 * @property \Cake\I18n\FrozenTime $fecha
 * @property \Cake\I18n\FrozenTime $hora
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class SugerenciaRepuesto extends Entity
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
        'fecha' => true,
        'hora' => true,
        'created' => true,
        'modified' => true,
    ];
}