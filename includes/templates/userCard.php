<?php
echo "
	<article class = 'col-4'>
		<section class = 'card'>
		<img src = '{$row['imgSrc']}' class = 'card-img-top'>
			<section class = 'card-body'>
				<p class = 'card-title'>
					<a href = 'massageDetails.php?id={$row['id']}' class = 'card-link'>
						نام کاربر: {$row['firstname']}
					</a>
				</p>
				<section class = 'card-text'>
					<p>
						نام خانوادگی: {$row['lastname']} <br>
						ایمیل : {$row['email']} <br>
						رمز : {$row['password']}
					</p>
				</section>
			</section>
			<footer class = 'card-footer' style = 'text-align:center;'>
				<a href = 'public/editUser.php?id={$row['id']}' class = 'btn btn-primary'>ویرایش</a>
				<a href = 'public/deleteUser.php?id={$row['id']}' class = 'btn btn-danger'>حذف</a>
			</footer>
		</section>
	</article>
";
?>