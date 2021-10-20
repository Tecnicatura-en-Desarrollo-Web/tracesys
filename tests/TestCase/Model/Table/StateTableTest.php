<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StateTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StateTable Test Case
 */
class StateTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\StateTable
     */
    protected $State;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.State',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('State') ? [] : ['className' => StateTable::class];
        $this->State = $this->getTableLocator()->get('State', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->State);

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
