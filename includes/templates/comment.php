<div lang="fa">
	<link rel="stylesheet" href="assets/css/base.css">
	
	<?php

echo "
<style>
.com {
	margin: 0 auto;
	max-width: 800px;
	padding: 0 20px;
  }
  
  .container1 {
	border: 2px solid #dedede;
	background-color: #f1f1f1;
	border-radius: 5px;
	padding: 10px;
	margin: 10px 0;
  }
  
  .darker1 {
	border-color: #ccc;
	background-color: #ddd;
  }
  
  .container1::after {
	content: '';
	clear: both;
	display: table;
  }
  
  .container1 img {
	float: right;
	max-width: 60px;
	width: 100%;
	margin-left: 20px;
	margin-right:0;
	border-radius: 50%;
  }
  
  

</style>

<diV class='com'>


<div class='container1'>
  <img src='{$row['imgSrc']}' alt='Avatar' style='width:100%;'>
  <h2 style='width:100%;margin-top:10px;'>{$row['firstname']} {$row['lastname']}</h2><br>
  <p>{$row['message']}</p>


			<button type = 'button' class = 'btn text-muted replyButton'>پاسخ</button>
			<button type = 'button' class = 'btn far fa-thumbs-up text-muted'> 2</button>
			<button type = 'button' class = 'btn far fa-thumbs-down text-muted'> 5</button>
			</div>
		<section class = 'commentFormBlock container-fluid'>
			<form action = '#comments' method = 'post' class='form-inline row'>
				<textarea name = 'message' id = 'message' class='col' placeholder = 'نظر شما ...'></textarea>
				<input name = 'parentid' readonly type = 'hidden' value = '{$row['id']}'>
				<span class = 'col-3'>
					<input type = 'submit' name = 'submit' value = 'ثبت' class = 'btn btn-success '>
				</span>
			</form>
		</section>
		";
if( $level < 5 ) showComments( $row['id'] , $level + 1);
echo '
	</section>		
	</article>'
	;
if( $level >= 5 ) showComments( $row['id'] , $level + 1);

?>
</div>
