
<!DOCTYPE HTML>
<html lang="ja">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>イッテQについて語ろう！の掲示板 ログイン</title>
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
          <center><h1>ログイン</h1></center>
          <br>
          <br>
          <form action="" method="post" class="form-horizontal">
            <div class="form-group">
              <label for="input_name" class="col-md-3 control-label">メールアドレス：</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="Email" placeholder="email" /><br />
              </div>
            </div>
            
            <div class="form-group">
              <label for="input_password" class="col-md-3 control-label">パスワード：</label>
              <div class="col-md-9">
                <input type="password" class="form-control" id="password" placeholder="Password" /></label><br />
              </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary pull-right">ログイン</button>
            </div>
        　</form>      
    　 </div>
    </div>
    </div>
  </body>
</html>

<?php

// ログインボタンがクリックされたときに下記を実行
if(isset($_POST['login'])) {

  $email = $mysqli->real_escape_string($_POST['email']);
  $password = $mysqli->real_escape_string($_POST['password']);

  // クエリの実行
  $query = "SELECT * FROM users WHERE email='$email'";
  $result = $mysqli->query($query);
  if (!$result) {
    print('クエリーが失敗しました。' . $mysqli->error);
    $mysqli->close();
    exit();
  }

  // パスワード(暗号化済み）とユーザーIDの取り出し
  while ($row = $result->fetch_assoc()) {
    $db_hashed_pwd = $row['password'];
    $user_id = $row['user_id'];
  }

  // データベースの切断
  $result->close();

  // ハッシュ化されたパスワードがマッチするかどうかを確認
  if (password_verify($password, $db_hashed_pwd)) {
    $_SESSION['user'] = $user_id;
    header("Location: home.php");
    exit;
  } else { ?>
    <div class="alert alert-danger" role="alert">メールアドレスとパスワードが一致しません。</div>
  <?php }
}


?>