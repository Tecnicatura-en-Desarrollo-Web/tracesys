<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InformeempleadoestadosFixture
 */
class InformeempleadoestadosFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'informeempleadoestados_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'employee_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'state_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'employee_id' => ['type' => 'index', 'columns' => ['employee_id'], 'length' => []],
            'state_id' => ['type' => 'index', 'columns' => ['state_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['informeempleadoestados_id', 'employee_id', 'state_id'], 'length' => []],
            'informeempleadoestados_ibfk_3' => ['type' => 'foreign', 'columns' => ['state_id'], 'references' => ['states', 'state_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'informeempleadoestados_ibfk_2' => ['type' => 'foreign', 'columns' => ['employee_id'], 'references' => ['employees', 'employee_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'informeempleadoestados_ibfk_1' => ['type' => 'foreign', 'columns' => ['informeempleadoestados_id'], 'references' => ['reports', 'report_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'informeempleadoestados_id' => 1,
                'employee_id' => 1,
                'state_id' => 1,
                'created' => '2021-10-22 00:31:38',
                'modified' => '2021-10-22 00:31:38',
            ],
        ];
        parent::init();
    }
}
