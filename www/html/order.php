<?php
//定数ファイルを読み込み
require_once '../conf/const.php';
//汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
//userデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'user.php';
//itemデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'item.php';
//orderデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'order.php';

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

$id = get_post('id');
$token = get_post('token');


$orders = get_all_orders($db);

$order_items = get_orders($db, $id);

$orders_total = get_orders_total($db, $id);


$token = get_csrf_token();

//indexの読み込み
include_once VIEW_PATH . 'order_view.php';