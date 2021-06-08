
<div  lang="fa">
  <link rel="stylesheet" href="assets/css/base.css">
<?php

    include 'basein.php';
	include '../includes/functions.php';
    include '../includes/settings.php';
  
    $aaa = new AAA();
    if( $aaa -> isAuthenticated() )
		mobtani_redirect('profile.php');

    if( isset( $_POST['submit'] ) ){ // اگر فرم قبلا پر شده پردازشش کن
        
        $imgSrc = 'assets/images/male-profile.jpg';
	
        $db = new DB();
        $user = new User( $db );
        $where = "email = '{$_POST['email']}'";
        $table = $user -> find( $where ); // پیدا کردن کاربر با این مشخصات
        
        if( count( $table ) === 0 ){ // اگر چنین کاربری نبود
            // مشخصات کاربری را ذخیره کن
            $parameters = $_POST;
            $parameters['imgSrc'] = $imgSrc;
            /*
            $parameters = array(
                'firstname'			=> $_POST['firstname'],
                'lastname'			=> $_POST['lastname'],
                'email'		=> $_POST['weekday'],
                'timeFrom'		=> $_POST['timeFrom'],
                'timeTo'		=> $_POST['timeTo'],
                'imgSrc'		=> $imgSrc,
                'description' 	=> $_POST['description'],
                //'status'		=> 'active',
                );*/
                $uid = $user -> save( $parameters );
                // همچنین این کاربر را لاگین کن
                $aaa = new AAA();
                $aaa -> login( $uid );
                mobtani_redirect('profile.php');
        }
        else
            $alert -> alerts('کاربری با این ایمیل قبلا ثبت نام شده است!');
        
        unset($user);
        unset($db);
        
    }
?>

    <br>
    <h1 class="font-weight-bolder text-info">ثبت نام</h1><br>
    <?php echo $alert -> alerts();?>
    <div style="direction: ltr;text-align: left;">
        <a  style="position: absolute; top : 115px; " href="showUser.php" class="btn btn-outline-danger" role="button"> مشاهده کاربر ها </a>
        <a style="position: absolute; top : 70px; " href = "login.php" class = "btn btn-outline-success">ورود به حساب کاربری</a>
	</div>
    <?php if( isset( $alert ) )  $alert -> alerts();?>
    <form action = "" method = "post" class="container">
               
			<label class="frontWhite font-weight-bold" for = "firstname">نام و نام خانوادگی</label>
			<span class = "input-group">
				<input type = "text" name = "firstname" id = "firstname" placeholder = "مهدی"   class="form-control" required="required">
				<input type = "text" name = "lastname"  id = "lastname"  placeholder = "خودسیانی" class="form-control" required="required">
			</span><br>
			
			<label class="frontWhite font-weight-bold" for = "email">ایمیل</label>
			<input type = "email" name = "email" id = "email" class="form-control" required="required"><br>
			
			<label class="frontWhite font-weight-bold" for = "password">کلمه عبور</label>
			<input type = "password" name = "password" id = "password" class="form-control" required="required"><br>
            
            <label class="frontWhite font-weight-bold" for = "state">استان</label>			
			<input name = "state" list = "stateList" id = "state" class="form-control">
			<datalist id = "stateList">
				<?php
					$ostan = new Ostan( new DB() );
					$table = $ostan -> getAll();
					foreach($table as $row){
						echo "<option value = '{$row['name']}'>";
					}
				?>
			</datalist>
			<br>
			<label class="frontWhite font-weight-bold" for = "city">شهر</label>			
			<input name = "city" list = "cityList" id = "city" class="form-control">
			<datalist id = "cityList">
				<?php
					$shahr = new Shahr( new DB() );
					$table = $shahr -> find('shahr_type = 0');
					foreach($table as $row){
						echo "<option value = '{$row['name']}'>";
					}
				?>
			</datalist>
			<br>
            
			<input type = "submit" name = "submit" value = "ارسال" class="btn btn-outline-success btn-block center">
			

    </form>

</div>