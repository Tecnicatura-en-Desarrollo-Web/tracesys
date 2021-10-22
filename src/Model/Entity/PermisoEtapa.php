<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Permisoetapa Entity
 *
 * @property int $permisoetapas_id
 * @property int $stage_id
 *
 * @property \App\Model\Entity\Permisoetapa $permisoetapa
 * @property \App\Model\Entity\Stage $stage
 */
class Permisoetapa extends Entity
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
        'permisoetapa' => true,
        'stage' => true,
    ];
}
