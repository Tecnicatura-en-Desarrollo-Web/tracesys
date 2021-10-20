<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InformeEmpleadoEstadoTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InformeEmpleadoEstadoTable Test Case
 */
class InformeEmpleadoEstadoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\InformeEmpleadoEstadoTable
     */
    protected $InformeEmpleadoEstado;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.InformeEmpleadoEstado',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('InformeEmpleadoEstado') ? [] : ['className' => InformeEmpleadoEstadoTable::class];
        $this->InformeEmpleadoEstado = $this->getTableLocator()->get('InformeEmpleadoEstado', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->InformeEmpleadoEstado);

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
