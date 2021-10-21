<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommentsClientsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommentsClientsTable Test Case
 */
class CommentsClientsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CommentsClientsTable
     */
    protected $CommentsClients;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.CommentsClients',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CommentsClients') ? [] : ['className' => CommentsClientsTable::class];
        $this->CommentsClients = $this->getTableLocator()->get('CommentsClients', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->CommentsClients);

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
