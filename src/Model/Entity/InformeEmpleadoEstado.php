<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Informeempleadoestado Entity
 *
 * @property int $informeempleadoestados_id
 * @property int $employee_id
 * @property int $state_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Informeempleadoestado $informeempleadoestado
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\State $state
 */
class Informeempleadoestado extends Entity
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
        'created' => true,
        'modified' => true,
        'informeempleadoestado' => true,
        'employee' => true,
        'state' => true,
    ];
}
