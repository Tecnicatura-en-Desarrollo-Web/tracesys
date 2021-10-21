<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AdministradorFixture
 */
class AdministradorFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'administrador';
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'administrador_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'cuit_admin' => ['type' => 'string', 'length' => 11, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['administrador_id'], 'length' => []],
            'administrador_ibfk_1' => ['type' => 'foreign', 'columns' => ['administrador_id'], 'references' => ['users', 'user_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'administrador_id' => 1,
                'cuit_admin' => 'Lorem ips',
            ],
        ];
        parent::init();
    }
}
