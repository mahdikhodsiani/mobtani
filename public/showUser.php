<link rel="stylesheet" href="assets/css/base.css">
<div  lang="fa">
	<?php
		include 'basein.php';
		include('../includes/settings.php');
        include '../includes/functions.php';
        
        $aaa = new AAA();
        if( ! $aaa -> isAuthenticated() ){
            $alert -> alerts('ابتدا وارد شوید!');
            mobtani_redirect('login.php?redirect=showUser.php');
        }
        // اگر کاربر حق دسترسی به این صفحه را ندارد به صفحه دیگری ریدایرکت شود
        if( ! $aaa -> can('User', 'Show') ){
            $alert -> alerts('دسترسی غیر مجاز!');
            mobtani_redirect('profile.php');
        }

		$db = new db();
		$user = new User( $db );

		$table = $user -> getAll();
		
		unset($user);
		unset($db);	
	?>
<h1 class="font-weight-bolder text-info">مشاهده اعضا</h1><br>
	<main class = "col container-fluid">
	<?php echo $alert -> alerts();?>

		<section class = "row">
		<?php
			foreach($table as $row){ // به ازای هر سطر از جدول
				include '../includes/templates/userCard.php';
			}
		?>
		</section>
	</main>
</div>