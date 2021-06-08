<?php

include('../includes/settings.php');
include '../includes/functions.php';

    $aaa = new AAA();
	if( ! $aaa -> isAuthenticated() ){
		$alert -> alerts('ابتدا وارد شوید!');
		mobtani_redirect('login.php?redirect=deleteUser.php');
	}
	// اگر کاربر حق دسترسی به این صفحه را ندارد به صفحه دیگری ریدایرکت شود
	if( ! $aaa -> can('User', 'Delete') ){
		$alert -> alerts('دسترسی غیر مجاز!');
		mobtani_redirect('profile.php');
	}

$db = new db();
$user = new User( $db );

$id = $_GET['id'];

$user -> delete( $id );

mobtani_redirect('showContact.php');

unset($db);
?>