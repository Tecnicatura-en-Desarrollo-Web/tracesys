<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SugerenciarepuestosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SugerenciarepuestosTable Test Case
 */
class SugerenciarepuestosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SugerenciarepuestosTable
     */
    protected $Sugerenciarepuestos;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Sugerenciarepuestos',
        'app.Suggestions',
        'app.Replacements',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Sugerenciarepuestos') ? [] : ['className' => SugerenciarepuestosTable::class];
        $this->Sugerenciarepuestos = $this->getTableLocator()->get('Sugerenciarepuestos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Sugerenciarepuestos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SugerenciarepuestosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
