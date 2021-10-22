<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * IncorporatesFixture
 */
class IncorporatesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'incorporate_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'replacement_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'replacement_id' => ['type' => 'index', 'columns' => ['replacement_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['incorporate_id', 'replacement_id'], 'length' => []],
            'incorporates_ibfk_2' => ['type' => 'foreign', 'columns' => ['replacement_id'], 'references' => ['replacements', 'replacement_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'incorporates_ibfk_1' => ['type' => 'foreign', 'columns' => ['incorporate_id'], 'references' => ['budgets', 'budget_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'incorporate_id' => 1,
                'replacement_id' => 1,
                'created' => '2021-10-22 00:05:50',
                'modified' => '2021-10-22 00:05:50',
            ],
        ];
        parent::init();
    }
}
