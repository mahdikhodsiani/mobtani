<link rel="stylesheet" href="assets/css/base.css">
<div  lang="fa">

<?php
include 'basein.php';
include '../includes/settings.php' ;
include '../includes/functions.php';

$aaa = new AAA();
if( ! $aaa -> isAuthenticated() ){
	$alert -> alerts('ابتدا وارد شوید!');
	mobtani_redirect('login.php?redirect=profile.php');
}

if( isset( $_POST['submit'] ) ){ // اگر فرم قبلا پر شده پردازشش کن
	
}
?>

		<h1 class="font-weight-bolder text-info">پروفایل کاربر</h1>
		<div style="direction: ltr;text-align: left;">
        <a  style="position: absolute; top : 115px; " href="logout.php" class="btn btn-outline-danger" role="button">خروج از حساب کاربری</a>
      
		</div>
		<Br>
		<br>

		<a  href="editUser.php" class="btn btn-outline-primary" role="button">ویرایش حساب کاربری</a>
		<a  href="deleteUser.php" class="btn btn-outline-warning" role="button">حذف حساب کاربری</a>
		<a  href="showUser.php" class="btn btn-outline-Success" role="button">مشاهده اعضا</a>
		<?php echo $alert -> alerts();?>
		
	
</div>