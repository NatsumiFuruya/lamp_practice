<?php
//定数ファイルを読み込み
require_once '../conf/const.php';
//汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';
//userデータに関する関数ファイルを読み込み
require_once MODEL_PATH . 'user.php';
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

//admin時の処理
if ($user['type'] === USER_TYPE_ADMIN){  
  //ordersテーブルの値を取得
  $orders = get_all_orders($db);
  
  //$sum_price = SUM(order_items.item_price * order_items.amount)  
}else{
  //admin以外の処理  
  $orders = get_user_orders($db, $user['user_id']);
  
  
}

//indexの読み込み
include_once VIEW_PATH . 'history_view.php';