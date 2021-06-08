<?php
include 'Table.php';
include 'Message.php';
include 'User.php';
include 'Comment.php';
include 'Ostan.php';
include 'Shahr.php';
include 'opinions.php';
include 'Role.php';




// ....

class DB{
	private $dbc;
	var $executeError = false;
	
	public function __construct($transaction = false, $SelectDB = true){ // تابعي که با ایجاد شیء از کلاس، اتوماتیک فراخوانی می‌شود
		global $alert;
		// 1. اتصال به ديتابيس
		$this -> dbc = new mysqli ( DBHOST, DBUSER, DBPASS );
		if ( $this -> dbc -> connect_error){
			$alertMessage = "خطا در اتصال به دیتابیس!<section lang = 'en'>{$this -> dbc -> connect_error}</section>";
			$alert -> alerts( $alertMessage );
			exit();
		}
		
		if( $SelectDB ){
			$this -> dbc -> select_db( DBNAME );
			
			if ( $this -> dbc -> error ){
				$alertMessage = "خطا در انتخاب دیتابیس!<section lang = 'en'>{$this -> dbc -> error}</section>";
				$alert -> alerts( $alertMessage );
				exit();
			}
		}
		$this -> dbc -> set_charset( CHARSET );
		
		if( $transaction ){
			//$this -> dbc -> autocommit( false );//
			$this -> dbc -> begin_transaction();
		}
	}
	public function execute( $sql ){
		// 3. اجرای کوئری
		$result = $this -> dbc -> query( $sql );
		
		global $alert;
		if ( $this -> dbc -> error ){
			$this -> executeError = true;
			$alertMessage = "خطا در اجرای فرمان!<section lang = 'en'>{$this -> dbc -> error}</section>";
			$alert -> alerts( $alertMessage );
			exit();
		}
		else{
			$alertMessage = "با موفقیت اجرا شد!<section lang = 'en'>{$sql}</section>";
			$alert -> alerts( $alertMessage, 'success' );	
		}
		
		if( $result !== true && $result !== false){ // select query
			$table = $result -> fetch_all( MYSQLI_ASSOC ); // جدول نتیجه به صورت آرایه انجمنی
			return $table;
		}
		elseif( isset($this -> dbc -> insert_id) ) // insert query
			return $this -> dbc -> insert_id;
		else // update, delete query
			return $result;
	}
	public function commit(){
		if( $this -> executeError ){ // اگر خطا در تراکنش
			$this -> dbc -> rollback(); // بازگشت به حالت قبل از تراکنش
			
			$alertMessage = 'عدم اجرای تراکنش!<section lang = "en">' . $this -> dbc -> error . '</section>';
			mobtani_alerts($alertMessage);
		}
		else{	
			$this -> dbc -> commit(); // نهایی کردن تغییرات
			
			$alertMessage = 'تراکنش با موفقیت اجرا شد!';
			mobtani_alerts($alertMessage, 'success');
		}
	}
	public function __destruct(){ // با حذف شیء، این تابع فراخوانی می‌شود
		// 4. بستن اتصال
		$this -> dbc -> close();
	}		
}
?>