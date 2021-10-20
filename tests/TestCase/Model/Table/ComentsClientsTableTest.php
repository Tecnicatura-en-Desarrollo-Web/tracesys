<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ComentsClientsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ComentsClientsTable Test Case
 */
class ComentsClientsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ComentsClientsTable
     */
    protected $ComentsClients;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ComentsClients',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ComentsClients') ? [] : ['className' => ComentsClientsTable::class];
        $this->ComentsClients = $this->getTableLocator()->get('ComentsClients', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ComentsClients);

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
