<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PermisoEtapaTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PermisoEtapaTable Test Case
 */
class PermisoEtapaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PermisoEtapaTable
     */
    protected $PermisoEtapa;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.PermisoEtapa',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PermisoEtapa') ? [] : ['className' => PermisoEtapaTable::class];
        $this->PermisoEtapa = $this->getTableLocator()->get('PermisoEtapa', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->PermisoEtapa);

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
