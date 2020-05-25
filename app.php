<?php 

ini_set('display_errors', 'on');
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

//session_start();
require_once('DbManager.php');
require_once('login_confirm.php');


if(isset($_SESSION['name'])){
					echo "ようこそ、".$_SESSION['name']."さん！";
        } else {
          header('Location:app_login.php');
          exit;
		}
		
/* 画像をアップロードするためにデータベースへ接続 */
try {
  $db = getDb();
  $sql = 'select url from ImageUrl where name = :name ';
  $stlt = $db->prepare($sql);
  $stlt->bindValue(':name'  ,$_SESSION['name']);
  $stlt->execute();
  $row = $stlt->fetch(PDO::FETCH_ASSOC);
  $url= $row['url'];
} 
 catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}


/* tweetを表示するためにデータベースへ接続 */
try {
  $db = getDb();
  $sql = 'select name, tweet, day, image_url, id, fav from posts where user_id = :id or user_id = any(
		select user_id2 from follow where user_id = :id) order by id desc';
	$stt = $db->prepare($sql);
	$stt->bindValue(':id' ,$_SESSION['id']);
	$stt->execute();

  //$stt->fetch(PDO::FETCH_ASSOC);
} 
 catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}


/* retweetを表示するためにデータベースへ接続 */
try {
  $db = getDb();
  $sql = 'select name, id from retweet';
  $strt = $db->prepare($sql);
  $strt->execute();
  $row3 = $strt->fetch(PDO::FETCH_ASSOC);
  $r_name= $row3['name'];
} 
 catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}


/* ユーザデータを表示するためにデータベースへ接続 */
try {
  $db = getDb();
  $sql = 'select name, id from UserData order by id desc';
  $stmt = $db->query($sql);
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
	<link rel="stylesheet" href="style.php">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css">	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="screen">
	<div class="box">
		<header>
			<h2 class="home">Home</h2>
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
												<input type="hidden" name="url" value="<?php echo $url ?>">
												<input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
												<input type="text" name="name" value="<?php echo $_SESSION['name']; ?>" readonly>
												<textarea name="tweet" placeholder="What's happening?"></textarea>
												<input type="submit" name="投稿" >
												</form>
										</div>
										<button type="submit" class="heart2" id="heart2"> 
								</div>
						</div>
						<div class="display2">
<?php foreach($stt as $row) : ?>
					<div class="card">
							<div class="card-content">
									<div class="card-content-left">
										<!-- <div class="card-content-img"></div> -->
											<img src="image/profile/<?php echo $row['image_url']; ?>" alt="" height="50" width="50"> 
									</div>
									<div class="card-contents">
											<div class="card-contents-name">
												<h4><input type="hidden" name="name" value="<?php echo $row['name']; ?>" readonly></h4>
												<p><?php echo $r_name; ?>よってリツイートにされました</p>
												<h4><?php echo $row['name']; ?></h4>
												<p><?php echo '<br />'. $row['day']; ?></p>
											</div>
											<div class="card-contents-tweet">
													<input type="hidden" name="tweet" value="<?php echo $row['tweet']; ?>" readonly>
													<p><?php echo $row['tweet']; ?></p>
													<div class="iine">
															<button onclick="iine(this, <?php echo $row['id']; ?>)" class="heart"><a href="#"><i class="far fa-heart"></i></a></button>
															<button onclick="undoIine(this, <?php echo $row['id']; ?>)" class="heart2">
																<a href="#"><i class="fas fa-heart"></i></a>
															</button> 
															<span class="count"><?php echo $row['fav']; ?></span>
													</div>
											</div>
									</div>
							</div>
							<div class="reply-open">
									<button class="reply-open-btn" id="reply-open-btn">↓reply</button>
									<form action="retweet.php" method="post">
									<input type="hidden" name="name" value="<?php echo $row['name']; ?>">
									<input type="hidden" name="tweet" value="<?php echo $row['tweet']; ?>">
									<input type="hidden" name="image" value="<?php echo $row['image_url']; ?>">
									<input type="hidden" name="image" value="<?php echo $row['id']; ?>">
									<input type="submit" value="リツイート">
									</form>
							</div>
							<div class="reply-box">
									<form action="reply.php" method="post" accept-charset="utf-8"> 
												<p>返信してください</p>
												<button class="reply-back" id="reply-back">戻る</button>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="message">
												<input type="submit" value="送信">
									</form>
<!-- replyを表示するためにデータベースへ接続 -->
<?php 
											try {
												$stht = $db->prepare('select message from reply where id = :id');
												$stht->bindValue(':id', $row['id']);
												$stht->execute();
											 //$stt->fetch(PDO::FETCH_ASSOC);
											} catch (\Exception $e) {
												echo $e->getMessage() . PHP_EOL;
											}
?>
											<?php foreach ($stht as $row2) : ?>
    									<p><?php echo $row2['message']."<br>"; ?></p>
 											<?php endforeach; ?>
							</div>
					</div>
<?php endforeach; ?>
						</div>
				</div>
			</div>
		</main>
	</div>
	<!-- フォロー機能実装 -->
	<aside>
		<div class="user-modal">
				<div class="user-modal-top">
					<div class="user-modal-title">
						<h2>おすすめのユーザー</h2>
					</div>
				</div>
				
				<div class="user-modal-middle">
<?php

try {
	$db = getDb();
	$sql = 'select * from UserData where name not in (
		select name from follow where user_id = :id)';
	$stft = $db->prepare($sql);
	$stft->bindValue(':id' ,$_SESSION['id']);
	$stft->execute();
} 
catch (\Exception $e) {
	echo $e->getMessage() . PHP_EOL;
}
?>
<?php foreach($stft as $row) : ?> 
				<?php if($row['id'] != $_SESSION['id']): ?><!--ログインユーザ以外を表示
	followテーブルに接続し、フォローしたユーザを表示 -->
										<div class="user-modal-content">
												<div class="user-modal-content-left">
														<!-- <div class="user-modal-content-img"></div> 
														<img src="image/profile/<?php echo $row['image_url']; ?>" alt="" height="50" width="50"> -->
												</div>
												<div class="user-modal-content-middle">
														<p><?php echo $row['name']; ?></p>
													<!-- <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
													<input type="hidden" name="id" value="<?php echo$_SESSION['id']; ?>"> -->
												</div>
												<div class="user-modal-content-right">
														<button onclick="follow(this, <?php echo $row['id']; ?>)" class="user-follow-btn">フォロー</button>
												</div>
										</div>
				<?php endif ?>
<?php endforeach; ?>
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
		<script>
			 //いいね機能実装
			 function iine(event, postId) {
				const httpRequest = new XMLHttpRequest();
     			const iine = event.parentNode.querySelector("span.count")
					 event.style.display = "none";
					 event.parentNode.querySelector("button.heart2").style.display = "inline-block"; 
					 
     			httpRequest.onreadystatechange = function(){
        // ここでサーバーからの応答を処理します。
							if (httpRequest.readyState === XMLHttpRequest.DONE) {
									if (httpRequest.status === 200) {
										const response = JSON.parse(httpRequest.responseText)　 //json_decode() 
										iine.innerText = response.fav_count 
									} else {
										alert('リクエストに問題が発生しました');
									}
							}
		 			};
					httpRequest.open('POST', 'http://localhost:8888/app/count.php', true);
					httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					httpRequest.send(`post_id=${postId}`);
				}
				
				function undoIine(event, postId) {
					const httpRequest = new XMLHttpRequest();
					const iine = event.parentNode.querySelector("span.count")

							event.parentNode.querySelector("button.heart2").style.display = "none";
							event.parentNode.querySelector("button.heart").style.display = "inline-block"; 
							
							httpRequest.onreadystatechange = function(){
        // ここでサーバーからの応答を処理します。
							if (httpRequest.readyState === XMLHttpRequest.DONE) {
									if (httpRequest.status === 200) {
										const response = JSON.parse(httpRequest.responseText)　 //json_decode() 
										iine.innerText = response.fav_count 
									} else {
										alert('リクエストに問題が発生しました');
									}
							}
		 			};
					httpRequest.open('POST', 'http://localhost:8888/app/decrement.php', true);
					httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					httpRequest.send(`post_id=${postId}`);
					}


					//フォロー機能実装
			 function follow(event, postId) {
				const httpRequest = new XMLHttpRequest();
     		 //const follow = event.parenNode;//.querySelector("button.user-follow-btn")
					event.parentNode.parentNode.style.display = "none";

     			httpRequest.onreadystatechange = function(){
        // ここでサーバーからの応答を処理します。
							if (httpRequest.readyState === XMLHttpRequest.DONE) {
									if (httpRequest.status === 200) {
										//const response = JSON.parse(httpRequest.responseText)　 //json_decode() 
										// follow.innerText = response.post_id
										break;
									} else {
										alert('リクエストに問題が発生しました');
									}
							}
		 			};
					httpRequest.open('POST', 'http://localhost:8888/app/follow.php', true);
					httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					httpRequest.send(`post_id=${postId}`);
				}
		</script>
</body>
</html>	