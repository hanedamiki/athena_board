<?php  
	// DBとの接続
	include_once 'dbconnect.php';
    //暗号化してインサートする！！！
	//SQL命令文を$queryへ代入
	$query = "INSERT INTO users (nickname, email, pass) VALUES ($_POST["nick_name"]), $_POST["Email"]), $_POST["password"]))";// ユーザーIDをキーにDBからユーザー情報を取得

	//$queryを実行
	$result = $mysqli->query($query);

	if (!$result) {
		print('クエリーが失敗しました。' . $mysqli->error);
		$mysqli->close();
		exit();
	}

	// データベースの切断
	$result->close();
?>


<!DOCTYPE HTML>
<html lang="ja">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>イッテQについて語ろう！の掲示板 会員登録</title>
	<!-- bootstrap CDN -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<style type=text/css>
		div#main {
			padding: 30px;
			background-color: #efefef;
		}
	</style>
  </head>
  <body>
    <div id="main">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <center><h1>会員登録が完了しました。</h1></center>
                <br>
                <br>
                <a href="./login.php">ログインする</a>
            </div>
        </div>
    </div>
</body>
</html>