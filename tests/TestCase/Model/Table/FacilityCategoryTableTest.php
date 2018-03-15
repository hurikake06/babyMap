<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FacilityCategoryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FacilityCategoryTable Test Case
 */
class FacilityCategoryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FacilityCategoryTable
     */
    public $FacilityCategory;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.facility_category',
        'app.facility',
        'app.station',
        'app.category',
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
        $config = TableRegistry::exists('FacilityCategory') ? [] : ['className' => FacilityCategoryTable::class];
        $this->FacilityCategory = TableRegistry::get('FacilityCategory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FacilityCategory);

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
