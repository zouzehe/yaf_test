<?php
/*
	´úÂëÑ¹Ëõ
*/
class Minifier {


	public static function css( $data ) {

		// Removing comments
		$data=preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $data );
		// Removing tabs, spaces and newlines
		$data=str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '     ' ), '', $data );
		// Removing other spaces before and after
		$data=preg_replace( array( '(( )+{)', '({( )+)' ), '{', $data );
		$data=preg_replace( array( '(( )+})', '(}( )+)', '(;( )*})' ), '}', $data );
		$data=preg_replace( array( '(;( )+)', '(( )+;)' ), ';', $data );
		//Returning minified string
		return $data;

	}


	public static function js( $data ) {

		// Removing comments
		$data=preg_replace( "/((?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:\/\/.*))/", "", $data );
		// Removing tabs, spaces and newlines
		$data=str_replace( array( "\r\n", "\r", "\t", "\n", '  ', '    ', '     ' ), '', $data );
		// Removing other spaces before and after
		$data=preg_replace( array( '(( )+\))', '(\)( )+)' ), ')', $data );
		//Returning minified string
		return $data;

	}


	public static function html( $data ) {

		// Remove newlines and tabs
		$data=preg_replace( '/[\r\n\t]/i', '', $data );
		// Remove comments
		$data=preg_replace( '/<!--.*?-->/i', '', $data );
		//Returning minified string
		return $data;

	}

	public static function xml( $data ) {

		// Remove newlines and tabs
		$data=preg_replace( '/[\r\n\t]/i', '', $data );
		// Remove comments
		$data=preg_replace( '/<!--.*?-->/i', '', $data );
		//Returning minified string
		return $data;

	}

}
