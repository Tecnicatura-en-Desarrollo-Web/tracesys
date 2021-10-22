<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommentsemployeesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommentsemployeesTable Test Case
 */
class CommentsemployeesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CommentsemployeesTable
     */
    protected $Commentsemployees;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Commentsemployees',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Commentsemployees') ? [] : ['className' => CommentsemployeesTable::class];
        $this->Commentsemployees = $this->getTableLocator()->get('Commentsemployees', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Commentsemployees);

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
