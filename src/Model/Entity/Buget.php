<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Buget Entity
 *
 * @property int $buget_id
 * @property int $monto
 * @property \Cake\I18n\FrozenTime $fecha
 * @property int $report_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Buget extends Entity
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
        'monto' => true,
        'fecha' => true,
        'report_id' => true,
        'created' => true,
        'modified' => true,
    ];
}
