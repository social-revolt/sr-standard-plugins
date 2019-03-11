<?php


namespace Yoast\AcfAnalysis\Tests\Configuration;

use Brain\Monkey;
use Brain\Monkey\Functions;
use Brain\Monkey\Filters;
use Yoast\AcfAnalysis\Tests\Doubles\Passing_Dependency;
use Yoast\AcfAnalysis\Tests\Doubles\Failing_Dependency;

class Requirements_Test extends \PHPUnit_Framework_TestCase {

	/**
	 * Set up test fixtures.
	 */
	protected function setUp() {
		parent::setUp();
		Monkey\setUp();

		Functions\expect( 'current_user_can' )->andReturn( true );
	}

	/**
	 * Tear down test fixtures previously setup.
	 */
	protected function tearDown() {
		Monkey\tearDown();
		parent::tearDown();
	}

	public function testNoDependencies() {
		$testee = new \Yoast_ACF_Analysis_Requirements();
		$this->assertTrue( $testee->are_met() );
	}

	public function testPassingDependency() {
		$testee = new \Yoast_ACF_Analysis_Requirements();
		$testee->add_dependency( new Passing_Dependency() );

		$this->assertTrue( $testee->are_met() );
	}

	public function testFailingDependency() {
		$testee = new \Yoast_ACF_Analysis_Requirements();
		$testee->add_dependency( new Failing_Dependency() );

		$this->assertFalse( $testee->are_met() );
	}

	public function testMixedDependencies() {
		$testee = new \Yoast_ACF_Analysis_Requirements();
		$testee->add_dependency( new Failing_Dependency() );
		$testee->add_dependency( new Passing_Dependency() );

		$this->assertFalse( $testee->are_met() );
	}
}
