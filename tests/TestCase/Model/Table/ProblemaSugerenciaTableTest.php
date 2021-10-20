<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProblemaSugerenciaTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProblemaSugerenciaTable Test Case
 */
class ProblemaSugerenciaTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProblemaSugerenciaTable
     */
    protected $ProblemaSugerencia;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ProblemaSugerencia',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ProblemaSugerencia') ? [] : ['className' => ProblemaSugerenciaTable::class];
        $this->ProblemaSugerencia = $this->getTableLocator()->get('ProblemaSugerencia', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ProblemaSugerencia);

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
