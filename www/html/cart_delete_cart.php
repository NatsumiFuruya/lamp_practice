<?php
//定数ファイルを読み込み
require_once '../conf/const.php';
//汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
//userデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'user.php';
//itemデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'item.php';
//cartデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'cart.php';

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

//フォームからidを取得
$cart_id = get_post('cart_id');
$token = get_post('token');

$check_csrf = is_valid_csrf_token($token);

if($check_csrf === TRUE){
  //カート内の削除処理
  if(delete_cart($db, $cart_id)){
    set_message('カートを削除しました。');
  } else {
    set_error('カートの削除に失敗しました。');
  }
}else{
  set_error('カートの削除に失敗しました。');
}
//cart.phpへリダイレクト
redirect_to(CART_URL);