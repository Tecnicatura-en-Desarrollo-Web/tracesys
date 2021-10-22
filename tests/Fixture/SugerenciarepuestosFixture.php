<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SugerenciarepuestosFixture
 */
class SugerenciarepuestosFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'sugerenciarepuestos_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'replacement_id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'fecha' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'hora' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        'modified' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => false, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'replacement_id' => ['type' => 'index', 'columns' => ['replacement_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['sugerenciarepuestos_id', 'replacement_id'], 'length' => []],
            'sugerenciarepuestos_ibfk_2' => ['type' => 'foreign', 'columns' => ['replacement_id'], 'references' => ['replacements', 'replacement_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'sugerenciarepuestos_ibfk_1' => ['type' => 'foreign', 'columns' => ['sugerenciarepuestos_id'], 'references' => ['suggestions', 'suggestion_id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'sugerenciarepuestos_id' => 1,
                'replacement_id' => 1,
                'fecha' => '2021-10-22 00:06:01',
                'hora' => '2021-10-22 00:06:01',
                'created' => '2021-10-22 00:06:01',
                'modified' => '2021-10-22 00:06:01',
            ],
        ];
        parent::init();
    }
}
