<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StationTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StationTable Test Case
 */
class StationTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StationTable
     */
    public $Station;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.station',
        'app.facility',
        'app.type',
        'app.category',
        'app.facility_category'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Station') ? [] : ['className' => StationTable::class];
        $this->Station = TableRegistry::get('Station', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Station);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
