<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $user_id
 * @property string $cuit
 * @property string $nombre
 * @property string $apellido
 * @property string $email
 * @property string $password
 * @property string $usuario
 * @property int $telefono
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $sector_id
 * @property bool $activo
 *
 * @property \App\Model\Entity\Sector $sector
 */
class User extends Entity
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
        'nombre' => true,
        'apellido' => true,
        'email' => true,
        'password' => true,
        'usuario' => true,
        'telefono' => true,
        'created' => true,
        'modified' => true,
        'sector_id' => true,
        'activo' => true,
        'sector' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];
}