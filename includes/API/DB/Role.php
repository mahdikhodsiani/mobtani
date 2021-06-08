<?php
class Role extends Table{
	// ستون‌های جدول
	var $role;
	var $ProductEdit;
    var $ProductDelete;
    var $ProductDetails;
    var $ProductEditOther;
	var $ProductDeleteOther;
	var $ProductDetailsOther;
    var $UserEdit;
	var $UserDelete;
	var $UserDetails;
	var $UserEditOther;
	var $UserDeleteOther;
	var $UserDetailsOther;
    
    function findJoin( $where = 'TRUE', $order = '' , $joinedTable = 'User'){
        if( empty( $order) )
            $order = "{$this -> tableName}.id DESC";

		$sql = "SELECT * 
                FROM {$joinedTable} , {$this -> tableName} 
				WHERE {$joinedTable}id = {$joinedTable}.id
                AND {$where}   
                AND {$this -> tableName}.status != 'deleted'
				ORDER BY {$order}";
		echo $sql; 
		$table = $this -> db -> execute( $sql );
        var_dump($table); 
        return $table;

	}
}
?>