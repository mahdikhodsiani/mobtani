<?php
include 'API/DB/DB.php';
include 'API/Alert.php';
include 'API/AAA.php';

function get_header( $fileName = '' ){
	if( ! empty($fileName) )
		$fileName = '-' . $fileName; // -main
	include "templates/header{$fileName}.php";
}
function get_footer( $fileName = '' ){
	if( ! empty($fileName) )
		$fileName = '-' . $fileName; // -main
	include "templates/footer{$fileName}.php";
}
function get_sidebar( $fileName = '' ){
	if( ! empty($fileName) )
		$fileName = '-' . $fileName; // -main
	include "templates/sidebar{$fileName}.php";
}
function get_template_part( $slug, $name = '' ){
	if( ! empty($name) )
		$slug .= '-' . $name; // -main
	//echo "templates/{$slug}.php";
	include "templates/{$slug}.php";
}

function mobtani_redirect( $address ){
	header("Location: {$address}");
	// ... echo javascript for redirect in case of not working header
	die();
}

?>