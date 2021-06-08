<link rel="stylesheet" href="assets/css/base.css">
<div  lang="fa">
	
	<?php
	
	include 'basein.php';
	include '../includes/functions.php';
	include '../includes/settings.php';

	if( isset( $_POST['submit'] ) ){ // اگر فرم قبلا پر شده پردازشش کن

	
		// 2. ايجاد کوئري
		//$sql = "INSERT INTO Message (name, email, message) 
		//VALUES('{$_POST['name']}', '{$_POST['email']}', '{$_POST['message']}')";
		
		$db = new DB();
		$message = new Message( $db );

		$parameters = array(
			'name'			=> $_POST['name'],
			'email'			=> $_POST['email'],
			'message'		=> $_POST['message'],
			'status'		=> 'active',
			);
		$message -> save( $parameters );
		

		unset($db);
		
	//----------------------------------------------------------ارسال ایمیل به ادمین----------------------------------------------------------
					/*
					$message = "نام کاربر : {$_POST['name']} \n
					//متن پیام کاربر : \n
					//{$_POST['message']}";

					$header = "از طرف : {$_POST['email']}";

					mail('mahdi@gmail.com','تماس با من مهدی خودسیانی',$message,$header);



					//echo'<br>'.'<a href="http://mahdikhodsiani.b6b.ir/" class="btn btn-danger" role="button">بازگشت</a>';
					}

					// ارسال ایمیل به ادمین
					$message = 
					"از طرف: {$_POST['name']}\r\n
					متن پیام کاربر:\r\n
					{$_POST['message']}";
					$header = "From: {$_POST['email']}";
					$sent = mail('navidimani.sisco@gmail.com', 'تماس با ما - سایت مبتنی', $message, $header);
					
					*/
	//----------------------------------------------------------ارسال ایمیل به ادمین----------------------------------------------------------

		
	}
	?>
	<br>
			<h1 class="font-weight-bolder text-info">تماس با من</h1><br>
			<?php echo $alert -> alerts();?>
			<div style="direction: ltr;text-align: left;">
            <a  style="position: absolute; top : 115px; " href="showContact.php" class="btn btn-danger" role="button"> مشاهده پیام ها </a>
			</div>
			<?php if( isset( $alert ) )  $alert -> alerts();?>
			<form action="" method="post">
					<p class="frontWhite font-weight-bold">نام : </p>
					<input type="text" name="name" id = "name" class="form-control" placeholder="مهدی خودسیانی"  required="required"><br>
					<p class="frontWhite font-weight-bold">ایمیل : </p>
					<input type="text" name="email" id = "email" class="form-control" placeholder="example@email.com" required="required"><br>
					<p class="frontWhite font-weight-bold">پیام : </p>
					<textarea name = "message" id = "message" class="form-control" placeholder="متن خود را وارد کنید" required="required"></textarea><br>
					<input type = "submit" name = "submit" value = "ارسال" class="btn btn-outline-success btn-block center">
			</form>
			</div>
	<br>
</div>