<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProductSalesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProductSalesTable Test Case
 */
class ProductSalesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProductSalesTable
     */
    public $ProductSales;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.product_sales',
        'app.products',
        'app.sales'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ProductSales') ? [] : ['className' => ProductSalesTable::class];
        $this->ProductSales = TableRegistry::get('ProductSales', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProductSales);

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
