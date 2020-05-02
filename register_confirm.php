<?php 

ini_set('display_errors', 'on');
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

require_once 'DbManager.php';

   $name = $_POST['name'];
   $email = $_POST['email'];
   $password = $_POST['password'];

?>
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

	<!-- メールアドレスが正しいかどうかの確認 -->
	<?php  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) : ?>
    			 <p><?php echo '正しいメールアドレスを登録してください'; ?></p>
    			 <a href="register.php#" class="back-btn"><?php echo '戻る' ?></a> 
   <?php return false; ?>
   <?php endif ?>
   <!-- パスワードが正しいかどうかの確認　 -->

   <?php if (!preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['password'])) : ?>
     <p><?php echo 'パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。'; ?></p>
     <a href="register.php#" class="back-btn"><?php echo '戻る' ?></a> 
   <?php return false; ?>
   <?php endif ?>
<!-- データベースに接続 -->
   <?php
    $db = getDb();
	$sql = "SELECT * FROM UserData where email = ? OR password = ?";
	$stt = $db->prepare($sql);
	$stt->execute(array($email, $password));
	$member = $stt->fetch(PDO::FETCH_ASSOC);
	?>
<!--　同じメールアドレスがあるかの確認 -->
   <?php if ($email === $member['email']) : ?>
   	<p><?php echo '同じメールアドレスが存在します。'; ?></p>
  <!--　同じパスワードがあるかの確認 -->
    <?php elseif($password === $member['password']) : ?>
   		<p><?php echo '同じパスワードが存在します。'; ?></p>
   <?php else : ?>


<div class="register-box">
	<div class="register">
		<div class="register-contents1">
			<div class="back">
				<a href="register.php#" class="back-btn">戻る</a>
			</div> 
			<div class="register-title">
				<h1>アカウント作成</h1>
			</div>
			<div class="register-form">
				<form action="send.php" method="post" accept-charset="utf-8">
					<input type="text" name="name" value="<?php echo $name; ?>" readonly>
					<input type="text" name="email" value="<?php echo $email; ?>" readonly>
					<input type="text" name="password" value="<?php echo $password; ?>" readonly>
					<input type="submit" value="確認">
				</form>
			</div>
		</div>
	</div>
</div>
     <?php endif ?>
	<!-- jQuery、Popper.js、Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- jQueryの読み込み -->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="/app/register.js"></script>

</body>
</html>