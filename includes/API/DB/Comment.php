<?php
class Comment extends Table{
	// ستون‌های جدول
	var $Productid;
	var $Userid;
	var $message;
	var $parentid = 0;
}
?>