<?php

namespace Yoast\AcfAnalysis\Tests\Assets;

use Brain\Monkey;
use Brain\Monkey\Functions;

class Assets_Test extends \PHPUnit_Framework_TestCase {
	protected $preserveGlobalState      = false;
	protected $runTestInSeparateProcess = true;

	/**
	 * Set up test fixtures.
	 */
	protected function setUp() {
		parent::setUp();
		Monkey\setUp();
	}

	/**
	 * Tear down test fixtures previously setup.
	 */
	protected function tearDown() {
		Monkey\tearDown();
		parent::tearDown();
	}

	public function testInitHook() {
		define( 'AC_SEO_ACF_ANALYSIS_PLUGIN_FILE', '/directory/file' );
		Functions\expect( 'get_plugin_data' )
			->once()
			->with( AC_SEO_ACF_ANALYSIS_PLUGIN_FILE )
			->andReturn(
				array(
					'Version' => '2.0.0',
				)
			);

		$testee = new \Yoast_ACF_Analysis_Assets();
		$testee->init();

		$this->assertTrue( has_filter( 'admin_enqueue_scripts', array( $testee, 'enqueue_scripts' ) ) );
	}
}
