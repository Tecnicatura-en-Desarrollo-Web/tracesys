<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProviderTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProviderTable Test Case
 */
class ProviderTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProviderTable
     */
    protected $Provider;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Provider',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Provider') ? [] : ['className' => ProviderTable::class];
        $this->Provider = $this->getTableLocator()->get('Provider', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Provider);

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
