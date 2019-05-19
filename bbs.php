<?php
session_start();
include_once 'dbconnect.php';

?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>掲示板の登録と削除</title>
<link rel="stylesheet" href="style.css">
<!-- Bootstrap読み込み（スタイリングのため） -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
</head>
</head>
<body>
<div class="col-xs-6 col-xs-offset-3">

<?php 
	// 受け取ったデータを書き込む
	if (isset($_POST["submit"]) ) {
			$content = $mysqli->real_escape_string($_POST["content"]);
		if(!isset($_SESSION['user'])) {
			$user_name = $mysqli->real_escape_string($_POST["user_name"]);
		}else{
			$user_name = $mysqli->real_escape_string($_SESSION['user']);
		}
		$query  = "INSERT INTO bbs (user, content, updated_at) VALUES ('$user_name', '$content',  NOW());";
		if($mysqli->query($query)) {  ?>
			<div class="alert alert-success" role="alert">登録が完了しました。</div>
			<a href="index.php">掲示板へ戻る</a>
			<?php } else { ?>
			<div class="alert alert-danger" role="alert">エラーが発生しました。</div>
			<a href="index.php">掲示板へ戻る</a>
			<?php
		}
	}
			
			
	// 受け取ったidのレコードの削除
	if (isset($_POST["delete"])) {
		$delete_id = $_POST["delete_id"];
		$query  = "DELETE FROM bbs WHERE id = $delete_id";

		if($mysqli->query($query)) {  ?>
			<div class="alert alert-success" role="alert">削除が完了しました。</div>
			<a href="index.php">掲示板へ戻る</a>
			<?php } else { ?>
			<div class="alert alert-danger" role="alert">エラーが発生しました。</div>
			<a href="index.php">掲示板へ戻る</a>
			<?php
		}
	}
?>


</div>
</body>
</html>