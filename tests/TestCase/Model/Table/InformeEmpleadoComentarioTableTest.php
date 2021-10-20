<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InformeEmpleadoComentarioTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InformeEmpleadoComentarioTable Test Case
 */
class InformeEmpleadoComentarioTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\InformeEmpleadoComentarioTable
     */
    protected $InformeEmpleadoComentario;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.InformeEmpleadoComentario',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('InformeEmpleadoComentario') ? [] : ['className' => InformeEmpleadoComentarioTable::class];
        $this->InformeEmpleadoComentario = $this->getTableLocator()->get('InformeEmpleadoComentario', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->InformeEmpleadoComentario);

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
