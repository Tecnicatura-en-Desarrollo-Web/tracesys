<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProblemaSugerenciaFixture
 */
class ProblemaSugerenciaFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'problema_sugerencia';
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'problema_sugerencia_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'suggestion_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'suggestion_id' => ['type' => 'index', 'columns' => ['suggestion_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['problema_sugerencia_id', 'suggestion_id'], 'length' => []],
            'problema_sugerencia_ibfk_2' => ['type' => 'foreign', 'columns' => ['suggestion_id'], 'references' => ['suggestions', 'suggestion_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'problema_sugerencia_ibfk_1' => ['type' => 'foreign', 'columns' => ['problema_sugerencia_id'], 'references' => ['issue', 'issue_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'problema_sugerencia_id' => 1,
                'suggestion_id' => 1,
                'created' => '2021-10-21 22:30:10',
                'modified' => '2021-10-21 22:30:10',
            ],
        ];
        parent::init();
    }
}
