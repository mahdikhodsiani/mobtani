<?php
echo "
	<article class = 'col-4'>
		<section class = 'card'>
			<section class = 'card-body'>
				<h4 class = 'card-title'>
					<a href = 'massageDetails.php?id={$row['id']}' class = 'card-link'>
						نام کاربر: {$row['name']}
					</a>
				</h4>
				<section class = 'card-text'>
					<p>
						ایمیل : {$row['email']} <br>
						پیام : {$row['message']}
					</p>
				</section>
			</section>
			<footer class = 'card-footer' style = 'text-align:center;'>
				<a href = 'public/editMassage.php?id={$row['id']}' class = 'btn btn-primary'>ویرایش</a>
				<a href = 'public/deleteMessage.php?id={$row['id']}' class = 'btn btn-danger'>حذف</a>
			</footer>
		</section>
	</article>
";
?>