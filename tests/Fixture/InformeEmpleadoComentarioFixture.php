<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InformeEmpleadoComentarioFixture
 */
class InformeEmpleadoComentarioFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'informe_empleado_comentario';
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'informe_empleado_comentario_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'cuit' => ['type' => 'string', 'length' => 11, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'comment_employee_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'report_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'comment_employee_id' => ['type' => 'index', 'columns' => ['comment_employee_id'], 'length' => []],
            'report_id' => ['type' => 'index', 'columns' => ['report_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['informe_empleado_comentario_id', 'comment_employee_id', 'report_id'], 'length' => []],
            'informe_empleado_comentario_ibfk_3' => ['type' => 'foreign', 'columns' => ['report_id'], 'references' => ['reports', 'report_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'informe_empleado_comentario_ibfk_2' => ['type' => 'foreign', 'columns' => ['comment_employee_id'], 'references' => ['comments_employee', 'comment_employee_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'informe_empleado_comentario_ibfk_1' => ['type' => 'foreign', 'columns' => ['informe_empleado_comentario_id'], 'references' => ['employee', 'employee_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'informe_empleado_comentario_id' => 1,
                'cuit' => 'Lorem ips',
                'comment_employee_id' => 1,
                'report_id' => 1,
                'created' => '2021-10-21 22:29:56',
                'modified' => '2021-10-21 22:29:56',
            ],
        ];
        parent::init();
    }
}
