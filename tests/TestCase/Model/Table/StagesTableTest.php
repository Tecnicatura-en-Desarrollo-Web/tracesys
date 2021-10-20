<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StagesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StagesTable Test Case
 */
class StagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\StagesTable
     */
    protected $Stages;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Stages',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Stages') ? [] : ['className' => StagesTable::class];
        $this->Stages = $this->getTableLocator()->get('Stages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Stages);

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
