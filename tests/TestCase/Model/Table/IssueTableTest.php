<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IssueTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IssueTable Test Case
 */
class IssueTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\IssueTable
     */
    protected $Issue;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Issue',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Issue') ? [] : ['className' => IssueTable::class];
        $this->Issue = $this->getTableLocator()->get('Issue', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Issue);

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
