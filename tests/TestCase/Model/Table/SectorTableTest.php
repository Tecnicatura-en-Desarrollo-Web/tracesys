<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SectorTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SectorTable Test Case
 */
class SectorTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SectorTable
     */
    protected $Sector;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Sector',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Sector') ? [] : ['className' => SectorTable::class];
        $this->Sector = $this->getTableLocator()->get('Sector', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Sector);

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
