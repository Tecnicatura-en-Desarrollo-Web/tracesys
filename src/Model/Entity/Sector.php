<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sector Entity
 *
 * @property int $sector_id
 * @property string $nombre_sector
 * @property int $orden
 * @property int $stage_id
 *
 * @property \App\Model\Entity\Stage $stage
 */
class Sector extends Entity
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
        'sector_id' => true,
        'nombre_sector' => true,
        'orden' => true,
        'stage_id' => true,
        'stage' => true,
    ];
}