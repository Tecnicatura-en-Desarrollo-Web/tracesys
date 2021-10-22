<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClienteinformecomentariosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClienteinformecomentariosTable Test Case
 */
class ClienteinformecomentariosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClienteinformecomentariosTable
     */
    protected $Clienteinformecomentarios;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Clienteinformecomentarios',
        'app.Commentsclients',
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
        $config = $this->getTableLocator()->exists('Clienteinformecomentarios') ? [] : ['className' => ClienteinformecomentariosTable::class];
        $this->Clienteinformecomentarios = $this->getTableLocator()->get('Clienteinformecomentarios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Clienteinformecomentarios);

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
