<?php

class UGL_BasicTests extends UGL_UnitTestCase {

	function test_UGL() {
		$this->assertInstanceOf( 'JCP_UseGoogleLibraries', $this->ugl );
		$props = array( 'google_scripts', 'noconflict_next', 
				'protocol_relative_supported', 'jquery_tag');

		foreach ( $props as $prop) {
			$this->assertObjectHasAttribute( $prop, $this->ugl );
		}
	}

	function test_UGL_remove_ver_query() {
		$dummy_src = '//ajax.googleapis.com/dummy.js';
		$dummy_script = add_query_arg( 'ver', '1.2.3', $dummy_src );
		$this->assertNotEquals( $dummy_src, $dummy_script );
		$this->assertEquals(
				$dummy_src, $this->ugl->remove_ver_query( $dummy_script ),
				'ver should be removed from url if from google libs' );
	}
	
	function test_UGL_remove_ver_query_negative() {
		$dummy_src = 'dummy.js';
		$dummy_script = add_query_arg( 'ver', '1.2.3', $dummy_src );
		$this->assertNotEquals( $dummy_src, $dummy_script );
		$this->assertEquals( 
				$dummy_script, $this->ugl->remove_ver_query( $dummy_script ),
				'ver should not be removed unless url is from google libs' );
	}

	function test_concatenate_scripts_disabled() {
		global $concatenate_scripts;
		$this->assertFalse($concatenate_scripts);
	}
}

