<?php
//定数ファイルを読み込み
require_once '../conf/const.php';
//汎用関数ファイルを読み込み
require_once MODEL_PATH . 'functions.php';

//ログインチェックを行うためにセッションを開始する
session_start();

//ログインチェック用関数を利用
if(is_logined() === true){
  //ログインしている場合はindex.phpへリダイレクト
  redirect_to(HOME_URL);
}

//signupの読み込み
include_once VIEW_PATH . 'signup_view.php';



