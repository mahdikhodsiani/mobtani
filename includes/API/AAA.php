<?php
class AAA{
	function __construct(){
		if( session_status() !== PHP_SESSION_ACTIVE ){
			session_set_cookie_params ( $lifetime = 30 * 24 * 60 * 60 , $path = '/', $domain = $_SERVER['HTTP_HOST'] , $secure = false , $httponly = true );
			session_start();
		}
	}
	function login( $uid ){
		//$_SESSION['authenticated'] = true;
		$_SESSION['uid'] = $uid;
	}
	function logout(){
		unset( $_SESSION['uid'] );
	}
	function isAuthenticated(){
		return isset( $_SESSION['uid'] );
	}
	
	function uid(){
		return intval( $_SESSION['uid'] );
	}
	
	function can($tableName, $action){ // can('Product', 'Edit')
		if( ! $this -> isAuthenticated() )
			return false;
		
		$user = new User( new DB() );
		$uid = $this -> uid();
		$table = $user -> findJoin("User.id = {$uid}", null, 'Role');
		$row = $table[0];
		$column = "{$tableName}{$action}";
		
		return ( $row[ $column ] == 1 );
	}
	
}
?>