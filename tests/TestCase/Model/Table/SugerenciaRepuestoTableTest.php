<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SugerenciaRepuestoTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SugerenciaRepuestoTable Test Case
 */
class SugerenciaRepuestoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SugerenciaRepuestoTable
     */
    protected $SugerenciaRepuesto;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.SugerenciaRepuesto',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('SugerenciaRepuesto') ? [] : ['className' => SugerenciaRepuestoTable::class];
        $this->SugerenciaRepuesto = $this->getTableLocator()->get('SugerenciaRepuesto', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->SugerenciaRepuesto);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
