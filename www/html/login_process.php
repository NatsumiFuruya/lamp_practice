<?php
//定数ファイルを読み込み
require_once '../conf/const.php';
//汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
//userデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'user.php';

//ログインチェックを行うためにセッションを開始する
session_start();

//ログインチェック用関数を利用
if(is_logined() === true){
  //ログインしている場合はindex.phpへリダイレクト
  redirect_to(HOME_URL);
}

//usernameとpasswordを変数に格納
$name = get_post('name');
$password = get_post('password');

//PDOを取得
$db = get_db_connect();

//ログイン処理
$user = login_as($db, $name, $password);
if( $user === false){
  set_error('ログインに失敗しました。');
  redirect_to(LOGIN_URL);
}
//ログイン完了メッセージ
set_message('ログインしました。');
//adminならばadmin.phpにリダイレクト
if ($user['type'] === USER_TYPE_ADMIN){
  redirect_to(ADMIN_URL);
}
//adminn以外ならばindex.phpにリダイレクト
redirect_to(HOME_URL);