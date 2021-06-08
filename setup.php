<div  lang="fa">
<link rel="stylesheet" href="public/assets/css/base.css">


	<?php
	include 'includes/settings.php';
	include 'includes/functions.php';
	include 'public/basein.php';
	include 'public/sqtahlil.php';
	
					
	$db = new DB(false, false); // transaction = false, SelectDB = false	
	
	if( $restartingSetup ){
		$sql = "DROP DATABASE IF EXISTS {$DBNAME}";
		$db -> execute( $sql );
	}
	
	$sql = "CREATE DATABASE IF NOT EXISTS {$DBNAME}
			CHARACTER SET {$CHARSET}
			COLLATE {$COLLATE}";
	$db -> execute( $sql );

	unset( $db );
	$db = new DB();
	$sql = "CREATE TABLE IF NOT EXISTS {$DBNAME}.Message(
				id INT NOT NULL AUTO_INCREMENT,
				name VARCHAR(30),
				email VARCHAR(30),
				message TEXT,
                status  VARCHAR(15),
				PRIMARY KEY(id)
			)ENGINE = INNODB";
	$db -> execute( $sql );
	
	
	
	$sql = "CREATE TABLE IF NOT EXISTS {$DBNAME}.opinions(
				id INT NOT NULL AUTO_INCREMENT,
				name VARCHAR(30),
				shahr_type VARCHAR(30),				 
				ostan int(15),				 
				shahrestan int(15),
				bakhsh int(15),
				amar_code VARCHAR(30),			
				PRIMARY KEY(id)
			)ENGINE = INNODB";
	$db -> execute( $sql );
	
	
	$sql = "CREATE TABLE IF NOT EXISTS {$DBNAME}.Ostan(
				id INT NOT NULL AUTO_INCREMENT,
				name VARCHAR(50),
				email VARCHAR(30),
				opinions VARCHAR(15),
                status  VARCHAR(15),
				PRIMARY KEY(id)
			)ENGINE = INNODB";
	$db -> execute( $sql );

    $sql = "CREATE TABLE IF NOT EXISTS {$DBNAME}.Shahr(
				id INT NOT NULL AUTO_INCREMENT,
                name VARCHAR(50),
				shahr_type int(15),
				ostan int(15),
				shahrestan  int(15),
                bakhsh int(15),
                amar_code VARCHAR(15),
                status  VARCHAR(15),
				PRIMARY KEY(id)
			)ENGINE = INNODB";
	$db -> execute( $sql );
		
	
	
	

	$sql = "CREATE TABLE IF NOT EXISTS {$DBNAME}.User( 
				id INT NOT NULL AUTO_INCREMENT,
				firstname VARCHAR(50),
				lastname VARCHAR(50),
				email VARCHAR(50),
				password VARCHAR(50),
				state VARCHAR(50),
				city VARCHAR(50),
				Roleid INT,
				imgSrc VARCHAR(255),
                status  VARCHAR(15),
				PRIMARY KEY(id)
			)ENGINE = INNODB";
	$db -> execute( $sql );
	
	
	
	$sql = "CREATE TABLE IF NOT EXISTS {$DBNAME}.Role( 
				id INT NOT NULL AUTO_INCREMENT,
				role VARCHAR(15),
				ProductEdit BOOLEAN,
				ProductDelete BOOLEAN,
				ProductDetails BOOLEAN,
				ProductEditOther BOOLEAN,
				ProductDeleteOther BOOLEAN,
				ProductDetailsOther BOOLEAN,
				RateEdit BOOLEAN,
				UserEdit BOOLEAN,
				UserDelete BOOLEAN,
				UserDetails BOOLEAN,
				UserEditOther BOOLEAN,
				UserDeleteOther BOOLEAN,
				UserDetailsOther BOOLEAN,
                status  VARCHAR(15),
				PRIMARY KEY(id)
			)ENGINE = INNODB";
	$db -> execute( $sql );
	
	
	
	$role = new Role( $db );	
	$parameters = array(
		
		'role'					=> 'admin',
		'ProductEdit'			=> TRUE,
		'ProductDelete'			=> TRUE,
		'ProductDetails'		=> TRUE,
		'ProductEditOther'		=> TRUE,
		'ProductDeleteOther'	=> TRUE,
		'ProductDetailsOther'	=> TRUE,
		'RateEdit'				=> TRUE,
		'UserEdit'				=> TRUE,
		'UserDelete'			=> TRUE,
		'UserDetails'			=> TRUE,
		'UserEditOther'			=> TRUE,
		'UserDeleteOther'		=> TRUE,
		'UserDetailsOther'		=> TRUE,
		);
	$role -> save( $parameters );
	
	
	
	// Temporary variable, used to store current query
	$sql = '';
	// Read in entire file
	$lines = file('mydb.sql');
	// Loop through each line
	foreach ($lines as $line)
	{
		// Skip if it's a comment
		if (substr($line, 0, 2) == '--' || $line == '')
			continue;

		// Add this line to the current segment
		$sql .= $line;
		// If it has a semicolon at the end, it's the end of the query
		if (substr(trim($line), -1, 1) == ';')
		{
			// Perform the query			
			$db -> execute( $sql );
			
			// Reset temp variable to empty
			$sql = '';
		}
	}
	
if( $restartingSetup ){
	
	$sql = "ALTER TABLE {$DBNAME}.ostan
			ADD Column status VARCHAR(15) DEFAULT ''";
	$db -> execute( $sql );
	
	$sql = "ALTER TABLE {$DBNAME}.shahr
			ADD Column status VARCHAR(15) DEFAULT ''";
	$db -> execute( $sql );
	/*
	$sql = "RENAME TABLE
			{$DBNAME}.ostan TO {$DBNAME}.Ostan,
			{$DBNAME}.shahr TO {$DBNAME}.Shahr";
	$db -> execute( $sql );
	*/
}

	unset( $db );	
	?>

	<?php echo $alert -> alerts();?>

</div>