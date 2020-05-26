<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>sample</h1>
  <div class="iine">
    <button onclick="iine(this, 1)">いいね！</button><span class="count">0</span>
  </div>
  <div class="iine">
    <button onclick="iine(this, 2)">いいね！</button><span class="count">0</span>
  </div>
 
  <script>
    const httpRequest = new XMLHttpRequest();
    function iine(event, postId) {
     const iine = event.parentNode.querySelector("span.count")

     httpRequest.onreadystatechange = function(){
        // ここでサーバーからの応答を処理します。
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
              const response = JSON.parse(httpRequest.responseText)
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
  </script>
</body>
</html>