<?php
    $name = $_POST['name'];
    $comment = $_POST['tweet'];
    $date = date("Y/m/d H:i:s");

    $filename = 'data.txt'; /*保存先にファイル名を$filenameに代入*/

    $fp = fopen($filename,'a'); /*ファイルを追記モードで開く*/

    fwrite($fp,$name.' <> '.$comment.' <> '.$date."\n"); /*情報をファイルに書き込む*/

    fclose($fp); /*ファイルを閉じる*/
?>

<?php
    header('Location:app_file.php'); /*次の処理を行うファイルへ移動させる*/
    ?>