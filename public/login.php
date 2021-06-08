<link rel="stylesheet" href="assets/css/base.css">
<div  lang="fa">

<?php
include 'basein.php';
include '../includes/settings.php' ;
include '../includes/functions.php';

$aaa = new AAA();
if( $aaa -> isAuthenticated() )
		mobtani_redirect('profile.php');
		
if( isset( $_POST['submit'] ) ){ // اگر فرم قبلا پر شده پردازشش کن
		
	$db = new DB();
	$user = new User( $db );
	$where = "email = '{$_POST['email']}' AND password = '{$_POST['password']}'";
	$table = $user -> find( $where ); // پیدا کردن کاربر با این مشخصات ورود
	
	if( count( $table ) > 0 ){ // اگر مشخصات ورود صحیح است
		$row = $table[0];
		$id = $row['id']; // کاربر لاگین کرده id
		
		$aaa -> login( $id );
		
		$alert -> alerts("{$row['firstname']} {$row['lastname']} خوش آمدید!", 'success');
		
		$redirect = 'profile.php';
		if( isset($_GET['redirect']) )
			$redirect = $_GET['redirect'];
		mobtani_redirect( $redirect );
	}
	else
		$alert -> alerts('نام کاربری یا کلمه عبور اشتباه است!');
		
	unset($user);
	unset($db);
	
}
?>

		<h1 class="font-weight-bolder text-info">ورود</h1>
		<div style="direction: ltr;text-align: left;">
		<a style="position: absolute; top : 90px; "class = "btn btn-outline-success" href = "signin.php" >ثبت نام کنید</a>
        </div>
		
		<?php echo $alert -> alerts();?>
		<form action = "" method = "post">			
			<label class="frontWhite font-weight-bold" for = "email">ایمیل</label>
			<input type = "email" name = "email" id = "email" class="form-control" value = "<?php if( isset($_POST['email']) ) echo $_POST['email']; ?>"><br>
			
			<label class="frontWhite font-weight-bold" for = "password">کلمه عبور</label>
			<input type = "password" name = "password" id = "password" class="form-control">
			<button style="position: absolute; z-index: 4; left: 250px; top : 250;" type = "button" class = "input-group-text fas fa-eye" id = "toggleButton"></button>
			<br>
			<input type = "submit" name = "submit" value = "ورود" class="btn btn-outline-success btn-block center">
			
		</form>
		
		<script src = "assets/js/main.js"></script>