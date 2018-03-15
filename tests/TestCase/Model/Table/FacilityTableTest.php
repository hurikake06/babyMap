<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FacilityTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FacilityTable Test Case
 */
class FacilityTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FacilityTable
     */
    public $Facility;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.facility',
        'app.station',
        'app.category',
        'app.facility_category',
        'app.type'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Facility') ? [] : ['className' => FacilityTable::class];
        $this->Facility = TableRegistry::get('Facility', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Facility);

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
