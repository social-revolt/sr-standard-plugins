<?php


namespace Yoast\AcfAnalysis\Tests\Configuration;

class String_Store_Test extends \PHPUnit_Framework_TestCase {

	/**
	 * @return \Yoast_ACF_Analysis_String_Store
	 */
	protected function getStore() {
		return new \Yoast_ACF_Analysis_String_Store();
	}

	public function testEmpty() {
		$store = $this->getStore();
		$this->assertEmpty( $store->to_array() );
	}

	public function testAdd() {

		$type = 'test';

		$store = $this->getStore();
		$store->add( $type );

		$this->assertSame( [ $type ], $store->to_array() );

	}

	public function testAddSame() {

		$type = 'test';

		$store = $this->getStore();
		$store->add( $type );
		$store->add( $type );

		$this->assertSame( [ $type ], $store->to_array() );

	}

	public function testAddMultiple() {

		$type_a = 'A';
		$type_b = 'B';

		$store = $this->getStore();
		$store->add( $type_a );
		$store->add( $type_b );

		$this->assertSame( [ $type_a, $type_b ], $store->to_array() );

	}

	public function testAddMultipleSorting() {

		$type_a = 'Z';
		$type_b = 'A';

		$store = $this->getStore();
		$store->add( $type_a );
		$store->add( $type_b );

		$this->assertSame( [ $type_b, $type_a ], $store->to_array() );

	}

	public function testAddNonString() {

		$store = $this->getStore();

		$this->assertFalse( $store->add( 999 ) );
		$this->assertEmpty( $store->to_array() );

	}

	public function testRemove() {

		$type_a = 'A';
		$type_b = 'B';

		$store = $this->getStore();

		$store->add( $type_a );
		$store->add( $type_b );

		$this->assertSame( [ $type_a, $type_b ], $store->to_array() );

		$store->remove( $type_a );

		$this->assertSame( [ $type_b ], $store->to_array() );

		$store->remove( $type_b );

		$this->assertEmpty( $store->to_array() );

	}

	public function testRemoveNonString() {

		$store = $this->getStore();
		$store->add( '999' );

		$this->assertFalse( $store->remove( 999 ) );

	}

	public function testRemoveNonExist() {

		$store = $this->getStore();

		$this->assertFalse( $store->remove( 'test' ) );

	}

}
