<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Informeempleadocomentario Entity
 *
 * @property int $informeempleadocomentario_id
 * @property string $cuit
 * @property int $comment_employee_id
 * @property int $report_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Informeempleadocomentario $informeempleadocomentario
 * @property \App\Model\Entity\Commentsemployee $commentsemployee
 * @property \App\Model\Entity\Report $report
 */
class Informeempleadocomentario extends Entity
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
        'cuit' => true,
        'created' => true,
        'modified' => true,
        'informeempleadocomentario_id' => true,
        'comment_employee_id' => true,
        'report_id' => true,
    ];
}
