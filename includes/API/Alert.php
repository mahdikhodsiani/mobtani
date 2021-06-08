<?php
class Alert{
	public function __construct(){
		if(session_status() !== PHP_SESSION_ACTIVE)
			session_start();
	}
	
	private function makeAlert($alertMessage, $status){
		switch($status){
			case 'error':
				$classPostfix = 'danger';
				break;
			case 'success':
				$classPostfix = 'success';
				break;			
		}
		$alert = 
				"<article class = 'alert alert-{$classPostfix} alert-dismissible' role = 'alert'>
					{$alertMessage} 
					<button type = 'button' class = 'close' data-dismiss = 'alert' aria-label = 'Close'>
						<span aria-hidden = 'true'>&times;</span>
					</button>
				</article>";
		return $alert;
	}

	public function alerts( $alert = '' , $status = 'error'){
		$result = '';
		if(  $alert !== '' ){ // اگر خطای جدید داریم
			$_SESSION['alert'][] =  $this -> makeAlert($alert, $status);
		}
		elseif( isset( $_SESSION['alert'] ) ){
			$result = join("\n", $_SESSION['alert']); // لیست خطاها را برگردان
			unset( $_SESSION['alert'] );
		}
		
		return $result;
	}	
}
$alert = new Alert();
?>