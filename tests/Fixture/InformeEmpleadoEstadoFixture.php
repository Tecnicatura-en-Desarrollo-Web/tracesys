<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InformeEmpleadoEstadoFixture
 */
class InformeEmpleadoEstadoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'informe_empleado_estado';
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'informe_empleado_estado_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'employee_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'state_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'employee_id' => ['type' => 'index', 'columns' => ['employee_id'], 'length' => []],
            'state_id' => ['type' => 'index', 'columns' => ['state_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['informe_empleado_estado_id', 'employee_id', 'state_id'], 'length' => []],
            'informe_empleado_estado_ibfk_3' => ['type' => 'foreign', 'columns' => ['state_id'], 'references' => ['state', 'state_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'informe_empleado_estado_ibfk_2' => ['type' => 'foreign', 'columns' => ['employee_id'], 'references' => ['employee', 'employee_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'informe_empleado_estado_ibfk_1' => ['type' => 'foreign', 'columns' => ['informe_empleado_estado_id'], 'references' => ['reports', 'report_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'informe_empleado_estado_id' => 1,
                'employee_id' => 1,
                'state_id' => 1,
                'created' => '2021-10-21 22:29:59',
                'modified' => '2021-10-21 22:29:59',
            ],
        ];
        parent::init();
    }
}
