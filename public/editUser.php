<div  lang="fa">
<link rel="stylesheet" href="assets/css/base.css">
	<?php
	include 'basein.php';
	include '../includes/settings.php';
	include '../includes/functions.php';
	

	$aaa = new AAA();
	if( ! $aaa -> isAuthenticated() ){
		$alert -> alerts('ابتدا وارد شوید!');
		mobtani_redirect('login.php?redirect=editUser.php');
	}
	// اگر کاربر حق دسترسی به این صفحه را ندارد به صفحه دیگری ریدایرکت شود
	if( ! $aaa -> can('User', 'Edit') ){
		$alert -> alerts('دسترسی غیر مجاز!');
		mobtani_redirect('profile.php');
	}

	$db = new db();
	$user = new User( $db );
	
if( isset( $_GET['id'] ) ) {
	
	// validate id
	$pageID = $_GET['id'];
	if( isset( $_POST['submit'] ) ){ // اطلاعات جدید
		// ویرایش کن
		//validate POST[]
		$parameters = $_POST;
		unset( $parameters['submit'] );
		
		$parameters['id'] = $pageID;
		
		$table = User::update( $parameters );			
	}
	// اطلاعات کاربر را از دیتابیس دریافت کن
	$table = User::find("id = {$pageID}");
	$row = $table[0];		
}
else{
	Alert::alerts('شناسه کاربر نامشخص!');
	//redirect
}

unset( $db );

$alerts = Alert::alerts();
view('editUser', null, $row , $alerts);
?>