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

//フォームから各値を取得(changes_toは公開/非公開の値)
$item_id = get_post('item_id');
$changes_to = get_post('changes_to');

//非公開→公開変更
if($changes_to === 'open'){
  update_item_status($db, $item_id, ITEM_STATUS_OPEN);
  set_message('ステータスを変更しました。');
//公開→非公開変更  
}else if($changes_to === 'close'){
  update_item_status($db, $item_id, ITEM_STATUS_CLOSE);
  set_message('ステータスを変更しました。');
}else {
  set_error('不正なリクエストです。');
}

//adminページにリダイレクト
redirect_to(ADMIN_URL);