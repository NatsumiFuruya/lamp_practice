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

//フォームから各値を取得
$name = get_post('name');
$password = get_post('password');
$password_confirmation = get_post('password_confirmation');

//PDOを取得
$db = get_db_connect();

try{
  //user情報をDBにinsert
  $result = regist_user($db, $name, $password, $password_confirmation);
  if( $result=== false){
    set_error('ユーザー登録に失敗しました。');
    //失敗した場合signup.phpへリダイレクト
    redirect_to(SIGNUP_URL);
  }
}catch(PDOException $e){
  set_error('ユーザー登録に失敗しました。');
  //失敗した場合signup.phpへリダイレクト
  redirect_to(SIGNUP_URL);
}

set_message('ユーザー登録が完了しました。');
login_as($db, $name, $password);
//成功した場合index.phpへリダイレクト
redirect_to(HOME_URL);