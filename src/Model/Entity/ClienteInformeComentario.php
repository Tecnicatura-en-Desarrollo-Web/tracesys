<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Clienteinformecomentario Entity
 *
 * @property int $clienteinformecomentario_id
 * @property string $cuit
 * @property int $comment_client_id
 * @property int $report_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Clienteinformecomentario $clienteinformecomentario
 * @property \App\Model\Entity\Commentsclient $commentsclient
 * @property \App\Model\Entity\Report $report
 */
class Clienteinformecomentario extends Entity
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
        'clienteinformecomentario' => true,
        'commentsclient' => true,
        'report' => true,
    ];
}
