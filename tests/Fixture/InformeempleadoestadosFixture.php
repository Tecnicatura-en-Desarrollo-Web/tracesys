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
        'informeempleadoestado_id_propio' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'informeempleadoestado_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'employee_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'state_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'ultimoEstado' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'informeempleadoestado_id' => ['type' => 'index', 'columns' => ['informeempleadoestado_id'], 'length' => []],
            'employee_id' => ['type' => 'index', 'columns' => ['employee_id'], 'length' => []],
            'state_id' => ['type' => 'index', 'columns' => ['state_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['informeempleadoestado_id_propio', 'informeempleadoestado_id', 'employee_id', 'state_id'], 'length' => []],
            'informeempleadoestados_ibfk_3' => ['type' => 'foreign', 'columns' => ['state_id'], 'references' => ['states', 'state_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'informeempleadoestados_ibfk_2' => ['type' => 'foreign', 'columns' => ['employee_id'], 'references' => ['employees', 'employee_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'informeempleadoestados_ibfk_1' => ['type' => 'foreign', 'columns' => ['informeempleadoestado_id'], 'references' => ['reports', 'report_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'informeempleadoestado_id_propio' => 1,
                'informeempleadoestado_id' => 1,
                'employee_id' => 1,
                'state_id' => 1,
                'created' => '2021-10-29 16:14:56',
                'modified' => '2021-10-29 16:14:56',
                'ultimoEstado' => 1,
            ],
        ];
        parent::init();
    }
}
