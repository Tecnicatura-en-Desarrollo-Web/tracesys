<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProveedorrepuestosFixture
 */
class ProveedorrepuestosFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'proveedorrepuesto_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'provider_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'provider_id' => ['type' => 'index', 'columns' => ['provider_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['proveedorrepuesto_id', 'provider_id'], 'length' => []],
            'proveedorrepuestos_ibfk_2' => ['type' => 'foreign', 'columns' => ['provider_id'], 'references' => ['providers', 'provider_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'proveedorrepuestos_ibfk_1' => ['type' => 'foreign', 'columns' => ['proveedorrepuesto_id'], 'references' => ['replacements', 'replacement_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'proveedorrepuesto_id' => 1,
                'provider_id' => 1,
                'created' => '2021-10-22 00:31:47',
                'modified' => '2021-10-22 00:31:47',
            ],
        ];
        parent::init();
    }
}
