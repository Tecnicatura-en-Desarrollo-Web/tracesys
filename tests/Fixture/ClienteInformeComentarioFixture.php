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
        'cuit' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_comentario' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_informe' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['cuit', 'id_comentario', 'id_informe'], 'length' => []],
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
                'cuit' => 1,
                'id_comentario' => 1,
                'id_informe' => 1,
                'created' => '2021-10-20 22:29:35',
                'modified' => '2021-10-20 22:29:35',
            ],
        ];
        parent::init();
    }
}
