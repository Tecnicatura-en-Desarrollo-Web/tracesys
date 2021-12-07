<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReplacementsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReplacementsTable Test Case
 */
class ReplacementsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReplacementsTable
     */
    protected $Replacements;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Replacements',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Replacements') ? [] : ['className' => ReplacementsTable::class];
        $this->Replacements = $this->getTableLocator()->get('Replacements', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Replacements);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ReplacementsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
