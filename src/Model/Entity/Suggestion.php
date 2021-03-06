<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Suggestion Entity
 *
 * @property int $suggestion_id
 * @property string $nombre_sugerencia
 * @property string $descripcion_sugerencia
 * @property int $puntaje
 * @property int $valorPrecio
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $sector_id
 *
 * @property \App\Model\Entity\Sector $sector
 * @property \App\Model\Entity\Issue[] $issues
 */
class Suggestion extends Entity
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
        'nombre_sugerencia' => true,
        'descripcion_sugerencia' => true,
        'puntaje' => true,
        'valorPrecio' => true,
        'created' => true,
        'modified' => true,
        'sector_id' => true,
        'sector' => true,
        'issues' => true,
    ];
}
