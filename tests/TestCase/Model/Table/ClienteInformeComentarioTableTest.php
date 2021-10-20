<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ClienteInformeComentarioTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ClienteInformeComentarioTable Test Case
 */
class ClienteInformeComentarioTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ClienteInformeComentarioTable
     */
    protected $ClienteInformeComentario;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ClienteInformeComentario',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ClienteInformeComentario') ? [] : ['className' => ClienteInformeComentarioTable::class];
        $this->ClienteInformeComentario = $this->getTableLocator()->get('ClienteInformeComentario', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ClienteInformeComentario);

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
