<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InformeempleadocomentariosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InformeempleadocomentariosTable Test Case
 */
class InformeempleadocomentariosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\InformeempleadocomentariosTable
     */
    protected $Informeempleadocomentarios;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Informeempleadocomentarios',
        'app.Commentsemployees',
        'app.Reports',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Informeempleadocomentarios') ? [] : ['className' => InformeempleadocomentariosTable::class];
        $this->Informeempleadocomentarios = $this->getTableLocator()->get('Informeempleadocomentarios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Informeempleadocomentarios);

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
