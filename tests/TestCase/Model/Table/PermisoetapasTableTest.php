<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PermisoetapasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PermisoetapasTable Test Case
 */
class PermisoetapasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PermisoetapasTable
     */
    protected $Permisoetapas;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Permisoetapas',
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
        $config = $this->getTableLocator()->exists('Permisoetapas') ? [] : ['className' => PermisoetapasTable::class];
        $this->Permisoetapas = $this->getTableLocator()->get('Permisoetapas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Permisoetapas);

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
