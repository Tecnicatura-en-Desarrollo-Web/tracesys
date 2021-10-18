<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Report Entity
 *
 * @property int $id
 * @property string $fecha
 * @property string $hora
 * @property string $motivo
 * @property string $estado
 * @property \Cake\I18n\FrozenTime $created
 * @property string $midified
 */
class Report extends Entity
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
        'motivo' => true,
        'estado' => true,
        'created' => true,
        'midified' => true,
    ];
}
