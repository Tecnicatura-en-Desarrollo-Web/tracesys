<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InformeempleadoestadosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InformeempleadoestadosTable Test Case
 */
class InformeempleadoestadosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\InformeempleadoestadosTable
     */
    protected $Informeempleadoestados;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Informeempleadoestados',
        'app.Employees',
        'app.States',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Informeempleadoestados') ? [] : ['className' => InformeempleadoestadosTable::class];
        $this->Informeempleadoestados = $this->getTableLocator()->get('Informeempleadoestados', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Informeempleadoestados);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
