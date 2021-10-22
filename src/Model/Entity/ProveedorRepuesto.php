<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Proveedorrepuesto Entity
 *
 * @property int $proveedorrepuesto_id
 * @property int $provider_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Proveedorrepuesto $proveedorrepuesto
 * @property \App\Model\Entity\Provider $provider
 */
class Proveedorrepuesto extends Entity
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
        'proveedorrepuesto' => true,
        'provider' => true,
    ];
}
