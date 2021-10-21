<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ClienteInformeComentarioFixture
 */
class ClienteInformeComentarioFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'cliente_informe_comentario';
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'cliente_informe_comentario_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'cuit' => ['type' => 'string', 'length' => 11, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'comment_client_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'report_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'comment_client_id' => ['type' => 'index', 'columns' => ['comment_client_id'], 'length' => []],
            'report_id' => ['type' => 'index', 'columns' => ['report_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['cliente_informe_comentario_id', 'comment_client_id', 'report_id'], 'length' => []],
            'cliente_informe_comentario_ibfk_3' => ['type' => 'foreign', 'columns' => ['report_id'], 'references' => ['reports', 'report_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'cliente_informe_comentario_ibfk_2' => ['type' => 'foreign', 'columns' => ['comment_client_id'], 'references' => ['comments_clients', 'comment_client_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'cliente_informe_comentario_ibfk_1' => ['type' => 'foreign', 'columns' => ['cliente_informe_comentario_id'], 'references' => ['employee', 'employee_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'cliente_informe_comentario_id' => 1,
                'cuit' => 'Lorem ips',
                'comment_client_id' => 1,
                'report_id' => 1,
                'created' => '2021-10-21 22:29:42',
                'modified' => '2021-10-21 22:29:42',
            ],
        ];
        parent::init();
    }
}
