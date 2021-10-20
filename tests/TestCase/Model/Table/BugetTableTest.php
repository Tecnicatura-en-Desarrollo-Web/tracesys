<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BugetTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BugetTable Test Case
 */
class BugetTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BugetTable
     */
    protected $Buget;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Buget',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Buget') ? [] : ['className' => BugetTable::class];
        $this->Buget = $this->getTableLocator()->get('Buget', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Buget);

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
