<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Problemasugerencia Entity
 *
 * @property int $problemasugerencia_id
 * @property int $suggestion_id
 * @property bool $activo
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Problemasugerencia $problemasugerencia
 * @property \App\Model\Entity\Suggestion $suggestion
 * @property \App\Model\Entity\Issue $issue
 */
class Problemasugerencia extends Entity
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
        'activo' => true,
        'created' => true,
        'modified' => true,
        'problemasugerencia_id' => true,
        'suggestion_id' => true,
        'issue_id' => true,
    ];
}
