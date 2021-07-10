<?php
//定数ファイルを読み込み
require_once '../conf/const.php';
//汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';

//ログインチェックを行うためにセッションを開始する
session_start();

$_SESSION = array();
//sessionに関する設定を取得
$params = session_get_cookie_params();
//sessionに利用しているクッキーを無効化
setcookie(session_name(), '', time() - 42000,
  $params["path"], 
  $params["domain"],
  $params["secure"], 
  $params["httponly"]
);
//sessionIDを無効化
session_destroy();

//ログインページへリダイレクト
redirect_to(LOGIN_URL);

