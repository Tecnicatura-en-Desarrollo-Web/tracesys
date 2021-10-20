<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProveedorRepuestoTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProveedorRepuestoTable Test Case
 */
class ProveedorRepuestoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProveedorRepuestoTable
     */
    protected $ProveedorRepuesto;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ProveedorRepuesto',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ProveedorRepuesto') ? [] : ['className' => ProveedorRepuestoTable::class];
        $this->ProveedorRepuesto = $this->getTableLocator()->get('ProveedorRepuesto', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ProveedorRepuesto);

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
