<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1.0">
	<title>tweet-register</title>
	<link rel="stylesheet" href="app-login.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css">	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="register-box">
	<div class="register">
		<div class="register-contents1">
		<!--	<div class="next">
				<a href="#" class="next-btn">次へ</a>
			</div>  -->
			<div class="register-title">
				<h1>アカウント作成</h1>
			</div>
			<div class="register-form">
				<form action="register_confirm.php" method="post" accept-charset="utf-8">
					<input type="text" name="name" placeholder="name" required>
					<input type="email" name="email" placeholder="email" required>
					<input type="text" name="password" placeholder="password" required>
					<input type="submit" value="確認">
				</form>
			</div>
		</div>
		<!--
		<div class="register-contents2">
			<div class="back">
				<a href="#" class="back-btn">戻る</a>
			</div>
			<div class="register-title">
				<h1>アカウント作成</h1>
			</div>
			<div class="register-form">
				<form action="" method="post" accept-charset="utf-8">
					<input type="text" name="name" value="">
					<input type="text" name="email" placeholder="email">
					<input type="text" name="password" placeholder="password">
					<div class="submit">
						<input type="submit" name="submit">
					</div>
				</form>
			</div>
		</div>  -->
	</div>
</div>





	<!-- jQuery、Popper.js、Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- jQueryの読み込み -->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="/app/register.js"></script>

</body>
</html>