<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommentsclientsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommentsclientsTable Test Case
 */
class CommentsclientsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CommentsclientsTable
     */
    protected $Commentsclients;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Commentsclients',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Commentsclients') ? [] : ['className' => CommentsclientsTable::class];
        $this->Commentsclients = $this->getTableLocator()->get('Commentsclients', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Commentsclients);

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
