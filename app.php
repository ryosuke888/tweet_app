<?php 

ini_set('display_errors', 'on');
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

require_once('DbManager.php');
require_once('login_confirm.php');


if(isset($_SESSION['name'])){
          echo "ようこそ、".$_SESSION['name']."さん！";
        } else {
          header('Location:app_login.php');
          exit;
        }
try {
  $db = getDb();
  $sql = 'select name from UserData';
  $stmt = $db->query($sql);
  $stmt->execute();
} 
 catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}

/* 画像をアップロードするためにデータベースへ接続 */
try {
  $db = getDb();
  $sql = 'select url from ImageUrl';
  $stlt = $db->query($sql);
  $stlt->execute();
} 
 catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}

try {
  $db = getDb();
  $sql = 'select name, tweet, day from Tweet order by id desc';
  $stt = $db->query($sql);
  $stt->execute();
} 
 catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1.0">
	<title>tweet</title>
	<link rel="stylesheet" href="app.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css">	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="screen">
	<div class="box">
		<header>
			<h2 class="home">Home</h2> 
			<?php foreach( $stlt as $row) : ?>
				<img src="" alt="">
			<?php endforeach; ?>
		</header>
		<main>
			<div class="test">
				<div class="display">
					<div class="tweet">
						<div class="tweet-main-box">
							<div class="tweet-main-left">
								<div class="tweet-contents-img">

								</div>
								
							</div>
							<div class="tweet-main-right">
								<form action="tweet.php" method="post" accept-charset="utf-8" class="main-form">
								<input type="text" name="name" value="<?php echo $_SESSION['name']; ?>">
								<textarea name="tweet" placeholder="What's happening?"></textarea>
								<input type="submit" name="投稿" >
								</form>
							</div>
						</div>
					</div>
					<?php foreach( $stt as $row) : ?>
						<form action="fav.php" method="post" accept-charset="utf-8">
					<div class="card">
						<div class="card-content">
							<div class="card-content-left">
								<div class="card-content-img"></div>
							</div>
							<div class="card-contents">
								<div class="card-contents-name">
									<h4><input type="hidden" name="name" value="<?php echo $row['name']; ?>" readonly></h4>
									<h4><?php echo $row['name']; ?></h4>
									<p><?php echo '<br />'. $row['day']; ?></p>
								</div>
								<div class="card-contents-tweet">
									<input type="hidden" name="tweet" value="<?php echo $row['tweet']; ?>" readonly>
									<p><?php echo $row['tweet']; ?></p>
										<button type="submit" class="heart" id="heart"><a href="#" ><i class="far fa-heart"></i></a></button>
										<button type="submit" class="heart2" id="heart2">
											<a href="#"><i class="fas fa-heart"></i></a>
										</button>
								</div>
							</div>
						</div>
					</div>
					</form>
					<?php endforeach; ?>
				</div>
			</div>
		</main>
	</div>
	<aside>
		<div class="user-modal">
			<div class="user-modal-top">
				<div class="user-modal-title">
					<h2>おすすめのユーザー</h2>
				</div>
			</div>
			<div class="user-modal-middle">
				<div class="user-modal-contents">
					<div class="user-modal-content">
						<div class="user-modal-content-left">
							<div class="user-modal-content-img"></div>
						</div>
						<div class="user-modal-content-middle">
							<p>testname</p>
						</div>
						<div class="user-modal-content-right">
							<a href="" class="user-follow-btn">フォロー</a>
						</div>
					</div>
				</div>
				<div class="user-modal-contents">
					<div class="user-modal-content">
						<div class="user-modal-content-left">
							<div class="user-modal-content-img"></div>
						</div>
						<div class="user-modal-content-middle">
							<p>testname</p>
						</div>
						<div class="user-modal-content-right">
							<a href="" class="user-follow-btn">フォロー</a>
						</div>
					</div>
				</div>
				<div class="user-modal-contents">
					<div class="user-modal-content">
						<div class="user-modal-content-left">
							<div class="user-modal-content-img"></div>
						</div>
						<div class="user-modal-content-middle">
							<p>testname</p>
						</div>
						<div class="user-modal-content-right">
							<a href="" class="user-follow-btn">フォロー</a>
						</div>
					</div>
				</div>
			</div>
			<div class="user-modal-bottom">
				<a href="">さらに表示</a>
			</div>
		</div>
	</aside>
	<nav>
		<ul>
			<li><a href=""><i class="fas fa-home fa-2x"></i><p class="nav-font">Home</p></a></li>
			<li><a href="profile.php"><div class="profile-img"></div><p class="nav-font">Profile</p></a></li>
			<li><a href="#" class="tweet-btn">Tweet</a></li>
		</ul>
		<div class="tweet-modal" id="tweet-modal">
			<div class="tweet-content">
				<div class="tweet-modal-close">
					<i class="fas fa-times"></i>
				</div>
				<div class="tweet-contents">
					<div class="tweet-contents-left">
						<div class="tweet-contents-img">
						</div>
					</div>
					<div class="tweet-contents-right">
						<form action="" method="post" accept-charset="utf-8" class="form">
							<textarea name="message" placeholder="What's happening?"></textarea>
							<input type="submit" name="Tweet" >
						</form>
					</div>
				</div>
			</div>
		</div>
	</nav>
</div>

	<!-- jQuery、Popper.js、Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- jQueryの読み込み -->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="/app/app.js"></script>

</body>
</html>