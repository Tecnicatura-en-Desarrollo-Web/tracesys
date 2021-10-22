<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProveedorrepuestosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProveedorrepuestosTable Test Case
 */
class ProveedorrepuestosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProveedorrepuestosTable
     */
    protected $Proveedorrepuestos;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Proveedorrepuestos',
        'app.Providers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Proveedorrepuestos') ? [] : ['className' => ProveedorrepuestosTable::class];
        $this->Proveedorrepuestos = $this->getTableLocator()->get('Proveedorrepuestos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Proveedorrepuestos);

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
