<link rel="stylesheet" href="assets/css/base.css">
<div  lang="fa">


<?php
include 'basein.php';
include '../includes/settings.php' ;
include '../includes/functions.php';
		
	$aaa = new AAA();
	$aaa -> logout();
		
	$alert -> alerts('با موفقیت خارج شدید!', 'success');
	mobtani_redirect('login.php');
	
?>

		<h1 class="font-weight-bolder text-info">خروج</h1>
		<?php echo $alert -> alerts();?>
		
		<p class="frontWhite font-weight-bold"> ممنونیم که از سرویس ما استفاده کردید</p>
		
</div>