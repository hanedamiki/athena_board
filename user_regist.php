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
                <center><h1>会員登録</h1></center>
                <br>
                <br>
                <form action="./user_regist_comp.php" method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="input_name" class="col-md-3 control-label">ニックネーム：</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="nick_name" placeholder="Name"  required="required"/><br />
                    </div>
                    </div>

                    <div class="form-group">
                    <label for="input_name" class="col-md-3 control-label">メールアドレス：</label>
                    <div class="col-md-9">
                        <input type="email" class="form-control" id="Email" placeholder="email"  required="required"/><br />
                    </div>
                    </div>

                    <div class="form-group">
                    <label for="input_password" class="col-md-3 control-label">パスワード：</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" id="password" placeholder="Password"  required="required"/></label><br />
                    </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right">登録</button>
                    </div>
                　</form>
            </div>
        </div>
    </div>
</body>
</html>