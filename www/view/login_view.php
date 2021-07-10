<!DOCTYPE html>
<html lang="ja">
<head>
  <!--'templates/head.php'の読み込み-->
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>ログイン</title>
  <link rel="stylesheet" href="<?php print(h(STYLESHEET_PATH . 'login.css')); ?>">
</head>
<body>
  <!--'templates/header.php'の読み込み-->
  <?php include VIEW_PATH . 'templates/header.php'; ?>
  <div class="container">
    <h1>ログイン</h1>

    <!--'templates/messages.php'の読み込み-->
    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    <!--フォームの入力＆値をlogin_process.phpへ渡す-->
    <form method="post" action="login_process.php" class="login_form mx-auto">
      <!--usernameの入力-->
      <div class="form-group">
        <label for="name">名前: </label>
        <input type="text" name="name" id="name" class="form-control">
      </div>
      <!--passwordの入力-->
      <div class="form-group">
        <label for="password">パスワード: </label>
        <input type="password" name="password" id="password" class="form-control">
      </div>
      <!--ログインボタン-->
      <input type="submit" value="ログイン" class="btn btn-primary">
      <input type="hidden" name="token" value="<?php print $token; ?>">
    </form>
  </div>
</body>
</html>