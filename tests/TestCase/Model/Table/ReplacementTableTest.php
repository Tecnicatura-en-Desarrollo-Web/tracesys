<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReplacementTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReplacementTable Test Case
 */
class ReplacementTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReplacementTable
     */
    protected $Replacement;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Replacement',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Replacement') ? [] : ['className' => ReplacementTable::class];
        $this->Replacement = $this->getTableLocator()->get('Replacement', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Replacement);

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
