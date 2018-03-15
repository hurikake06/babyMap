<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StationCategoryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StationCategoryTable Test Case
 */
class StationCategoryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StationCategoryTable
     */
    public $StationCategory;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.station_category',
        'app.stations',
        'app.categories'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('StationCategory') ? [] : ['className' => StationCategoryTable::class];
        $this->StationCategory = TableRegistry::get('StationCategory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->StationCategory);

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
