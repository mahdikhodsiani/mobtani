<link rel="stylesheet" href="assets/css/base.css">
<div  lang="fa">
	<?php
	include 'basein.php';
	include('../includes/settings.php');
	include '../includes/functions.php';

	$aaa = new AAA();
	if( ! $aaa -> isAuthenticated() ){
		$alert -> alerts('ابتدا وارد شوید!');
		mobtani_redirect('login.php?redirect=editMessage.php');
	}
	// اگر کاربر حق دسترسی به این صفحه را ندارد به صفحه دیگری ریدایرکت شود
	if( ! $aaa -> can('Message', 'Edit') ){
		$alert -> alerts('دسترسی غیر مجاز!');
		mobtani_redirect('profile.php');
	}
	

	$db = new db();
	$message = new Message( $db );

	$id = $_GET['id']; // دریافت شناسه آیتم از URL


	if( isset( $_POST['submit'] ) ){ // اگر کاربر دکمه سابمیت را فشرده
			
		// اطلاعات داخل فرم را در جدول ویرایش کن
		$parameters = array(
			'name'			=> $_POST['name'],
			'email'			=> $_POST['email'],
			'message'		=> $_POST['message'],
			'id'			=> $id
			);
		$message -> save( $parameters );
		
		
		mobtani_redirect('showContact.php');
	}
	else // اگر کاربر میخواهد فرم ویرایش پیام را ببیند
		$row = $message -> get( $id );

	unset($message);
	unset($db);
	?>
	<h1 class="font-weight-bolder text-info">ویرایش پیام</h1><br>

	<?php echo $alert -> alerts();?>
			<form action="" method="post">
					<p class="frontWhite font-weight-bold">نام : </p>
					<input type="text" name="name" id = "name" class="form-control" value =  "<?php echo $row['name']; ?> " required="required"><br>
					<p class="frontWhite font-weight-bold">ایمیل : </p>
					<input type="text" name="email" id = "email" class="form-control" value =  "<?php echo $row['email']; ?> " required="required"><br>
					<p class="frontWhite font-weight-bold">پیام : </p>
					<textarea name = "message" id = "message" class="form-control"  required="required"><?php echo $row['message'];?></textarea><br>
					<input type = "submit" name = "submit" value = "ویرایش" class="btn btn-outline-success btn-block center">
			</form>
</div>