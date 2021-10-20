<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\IncorporatesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\IncorporatesTable Test Case
 */
class IncorporatesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\IncorporatesTable
     */
    protected $Incorporates;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Incorporates',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Incorporates') ? [] : ['className' => IncorporatesTable::class];
        $this->Incorporates = $this->getTableLocator()->get('Incorporates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Incorporates);

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
