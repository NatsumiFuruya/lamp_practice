<?php
//定数ファイルを読み込み
require_once '../conf/const.php';
//汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
//userデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'user.php';
//itemデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'item.php';

//ログインチェックを行うためにセッションを開始する
session_start();

//ログインチェック用関数を利用
if(is_logined() === false){
  //ログインしていない場合はログインページにリダイレクト
  redirect_to(LOGIN_URL);
}

//PDOを取得
$db = get_db_connect();
//PDOを利用してログインユーザーのデータを取得
$user = get_login_user($db);

//adminでログインしていなければログインページにリダイレクト
if(is_admin($user) === false){
  redirect_to(LOGIN_URL);
}

//フォームからid取得
$item_id = get_post('item_id');
$token = get_post('token');


$check_csrf = is_valid_csrf_token($token);

if($check_csrf === TRUE){
  //DBから削除処理
  if(destroy_item($db, $item_id) === true){
    set_message('商品を削除しました。');
  } else {
    set_error('商品削除に失敗しました。');
  }
}else{
  set_error('商品削除に失敗しました。');
}
//adminページにリダイレクト
redirect_to(ADMIN_URL);