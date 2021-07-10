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
//DBから情報を取得（cartsだけどinsert文をfetchallで取得）
$carts = get_user_carts($db, $user['user_id']);
//合計金額を変数に格納(cartのpriceとamountをそれぞれ処理に使用)
$total_price = sum_carts($carts);

$token = get_csrf_token();

//cartの読み込み
include_once VIEW_PATH . 'cart_view.php';