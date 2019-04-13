<?php  
	session_start();

	// DBとの接続
	include_once 'dbconnect.php';

	//SQL命令文を$queryへ代入
	$query = "SELECT * FROM users WHERE user_id=".$_SESSION['user']."";// ユーザーIDをキーにDBからユーザー情報を取得

	//$queryを実行
	$result = $mysqli->query($query);

	if (!$result) {
		print('クエリーが失敗しました。' . $mysqli->error);
		$mysqli->close();
		exit();
	}

	/*while (
	$row = $result->fetch_assoc()) {
	$username = $row['username'];
	$email = $row['email'];
	$birth_year = $row['birth_year'];
	}*/

	// データベースの切断
	$result->close();
?>

<html>
<head>
<title>PHP TEST</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>イッテQについて語ろう！の掲示板</title>
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
	<div class="container">
		<div id="main">
			<center><h1>イッテQについて語ろう！の掲示板</h1></center>
			<br>
			<?php
			// 受け取ったidのレコードの削除
			if (isset($_POST["delete_id"])) {
				$delete_id = $_POST["delete_id"];
				$sql  = "DELETE FROM bbs WHERE id = :delete_id;";
				$stmt = $pdo->prepare($sql);
				$stmt -> bindValue(":delete_id", $delete_id, PDO::PARAM_INT);
				$stmt -> execute();
			}

			// 受け取ったデータを書き込む
			if (isset($_POST["content"]) && isset($_POST["user_name"])) {
				$content   = $_POST["content"];
				$user_name = $_POST["user_name"];
				$sql  = "INSERT INTO bbs (content, user_name, updated_at) VALUES (:content, :user_name, NOW());";
				$stmt = $pdo->prepare($sql);
				$stmt -> bindValue(":content", $content, PDO::PARAM_STR);
				$stmt -> bindValue(":user_name", $user_name, PDO::PARAM_STR);
				$stmt -> execute();
			} 
			?>


			<h3>投稿フォーム</h3>
			<form class="form" action="bbs.php" method="post">
			<?php
				if(!isset($_SESSION['user'])) {
			?>
			<div class="form-group">
					<label class="control-label">投稿者</label>
					<input class="form-control" type="text" name="user_name">
			</div>
			<?php
			}
			?>
			<div class="form-group">
					<label class="control-label">投稿内容</label>
					<textarea class="form-control" type="text" name="content"></textarea>
				</div>
				<button class="btn btn-primary pull-right" type="submit">送信</button>
			</form>
			<br>
			<h3>発言リスト</h3>
			<table class="table table-striped">
				<tr>
					<th>id</th>
					<th>日時</th>
					<th>投稿内容</th>
					<th>投稿者</th>
					<th></th>
				</tr>
				<?php
				// データベースからデータを取得する
				$sql = "SELECT * FROM bbs ORDER BY updated_at;";
				$stmt = $pdo->prepare($sql);
				$stmt -> execute();
				// 取得したデータを表示する
				while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)) { ?>
					<tr>
						<td><?= $row["id"] ?></td>
						<td><?= $row["updated_at"] ?></td>
						<td><?= $row["content"] ?></td>
						<td><?= $row["user_name"] ?></td>
						<td>
						<?php
							if(!isset($_SESSION['user'])) {
						?>
						<form action="bbs.php" method="post">
							<input type="hidden" name="delete_id" value=<?= $row["id"] ?>>
							<button class="btn btn-danger" type="submit">削除</button>
						</form>
						<?php
						}
						?>
						</td>
					</tr>
				<?php } ?>
			</table>
		</div>
	</div>
</body>
</html>
