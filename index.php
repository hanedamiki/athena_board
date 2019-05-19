<?php
session_start();
include_once 'dbconnect.php';
// ここまで、register.phpと同様
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
			<?php
			if(!isset($_SESSION['user'])) {
			?>
				<p class="text-right"><a href="regist.php">新規登録</a></p>
				<p class="text-right"><a href="login.php">ログイン</a></p>
			<?php 
			}else{
		    ?>
				<p class="text-right"><a href="home.php">マイページ</a></p>
				<p class="text-right"><a href="logout.php?logout">ログアウト</a></p>
			<?php
			}
			?>
			<center><h1>イッテQについて語ろう！の掲示板</h1></center>
			<br>
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
			}else{
			?>
				<input class="form-control" type="hidden" name="user_name" value="<?php echo(isset($_SESSION['user'])) ?>">
			<?php
			}
			?>
			<div class="form-group">
				<label class="control-label">投稿内容</label>
				<textarea class="form-control" type="text" name="content"></textarea>
			</div>
			<button class="btn btn-primary pull-right" name="submit" type="submit">送信</button>
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
				$query = "SELECT * FROM bbs ORDER BY updated_at;";
				$result = $mysqli->query($query);
				if (!$result) {
					print('クエリーが失敗しました。' . $mysqli->error);
					$mysqli->close();
					exit();
                }

				// 取得したデータを表示する
				while ($row = $result->fetch_assoc()) { ?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['updated_at']; ?></td>
						<td><?php echo $row['content']; ?></td>
						<td><?php echo $row['user']; ?></td>
						<td>
						<?php
						if(isset($_SESSION['user'])) {
						?>
						<form action="bbs.php" method="post">
							<input type="hidden" name="delete_id" value=<?php echo $row['id']; ?>>
							<button class="btn btn-danger" name="delete" type="submit">削除</button>
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
