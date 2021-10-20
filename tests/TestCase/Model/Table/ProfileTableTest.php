<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProfileTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProfileTable Test Case
 */
class ProfileTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProfileTable
     */
    protected $Profile;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Profile',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Profile') ? [] : ['className' => ProfileTable::class];
        $this->Profile = $this->getTableLocator()->get('Profile', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Profile);

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
