<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommentsEmployeeTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommentsEmployeeTable Test Case
 */
class CommentsEmployeeTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CommentsEmployeeTable
     */
    protected $CommentsEmployee;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.CommentsEmployee',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CommentsEmployee') ? [] : ['className' => CommentsEmployeeTable::class];
        $this->CommentsEmployee = $this->getTableLocator()->get('CommentsEmployee', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->CommentsEmployee);

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
