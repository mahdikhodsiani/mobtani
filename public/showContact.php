<link rel="stylesheet" href="assets/css/base.css">
<div  lang="fa">
	<?php
		include 'basein.php';
		$alert = '';

		include('../includes/settings.php');
		include '../includes/functions.php';
		
		$aaa = new AAA();
		if( ! $aaa -> isAuthenticated() ){
			$alert -> alerts('ابتدا وارد شوید!');
			mobtani_redirect('login.php?redirect=showContact.php');
			}
		$db = new db();
		$massage = new Message( $db );

		$table = $massage -> getAll();
		
		unset($massage);
		unset($db);	
		
	?>
<h1 class="font-weight-bolder text-info">پیام ها</h1><br>
	<main class = "col container-fluid">
	<?php echo $alert -> alerts();?>
		<section class = "row">
		<?php
			foreach($table as $row){ // به ازای هر سطر از جدول
				include '../includes/templates/contactCard.php';
			}
		?>
		</section>
	</main>
</div>