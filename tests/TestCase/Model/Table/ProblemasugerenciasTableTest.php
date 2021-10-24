<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProblemasugerenciasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProblemasugerenciasTable Test Case
 */
class ProblemasugerenciasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProblemasugerenciasTable
     */
    protected $Problemasugerencias;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Problemasugerencias',
        'app.Suggestions',
        'app.Issues',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Problemasugerencias') ? [] : ['className' => ProblemasugerenciasTable::class];
        $this->Problemasugerencias = $this->getTableLocator()->get('Problemasugerencias', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Problemasugerencias);

        parent::tearDown();
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
