<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProveedorRepuestoFixture
 */
class ProveedorRepuestoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'proveedor_repuesto';
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'proveedor_repuesto_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'provider_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'provider_id' => ['type' => 'index', 'columns' => ['provider_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['proveedor_repuesto_id', 'provider_id'], 'length' => []],
            'proveedor_repuesto_ibfk_2' => ['type' => 'foreign', 'columns' => ['provider_id'], 'references' => ['provider', 'provider_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'proveedor_repuesto_ibfk_1' => ['type' => 'foreign', 'columns' => ['proveedor_repuesto_id'], 'references' => ['replacement', 'replacement_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'proveedor_repuesto_id' => 1,
                'provider_id' => 1,
                'created' => '2021-10-21 22:30:19',
                'modified' => '2021-10-21 22:30:19',
            ],
        ];
        parent::init();
    }
}
