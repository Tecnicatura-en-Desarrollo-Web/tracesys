<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CommentsEmployeeFixture
 */
class CommentsEmployeeFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'comments_employee';
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'comment_employee_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'descripcion' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['comment_employee_id'], 'length' => []],
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
                'comment_employee_id' => 1,
                'descripcion' => 'Lorem ipsum dolor sit amet',
                'created' => '2021-10-21 22:29:49',
                'modified' => '2021-10-21 22:29:49',
            ],
        ];
        parent::init();
    }
}
