<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CommentTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CommentTable Test Case
 */
class CommentTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CommentTable
     */
    public $Comment;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.comment'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Comment') ? [] : ['className' => CommentTable::class];
        $this->Comment = TableRegistry::get('Comment', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Comment);

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
