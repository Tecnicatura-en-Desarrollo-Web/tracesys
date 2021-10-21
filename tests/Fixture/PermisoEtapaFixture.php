<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PermisoEtapaFixture
 */
class PermisoEtapaFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'permiso_etapa';
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'permiso_etapa_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'stage_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'stage_id' => ['type' => 'index', 'columns' => ['stage_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['permiso_etapa_id', 'stage_id'], 'length' => []],
            'permiso_etapa_ibfk_2' => ['type' => 'foreign', 'columns' => ['stage_id'], 'references' => ['stages', 'stage_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'permiso_etapa_ibfk_1' => ['type' => 'foreign', 'columns' => ['permiso_etapa_id'], 'references' => ['permissions', 'permission_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'permiso_etapa_id' => 1,
                'stage_id' => 1,
            ],
        ];
        parent::init();
    }
}
