<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';

session_start();

if(is_logined() === true){
  redirect_to(HOME_URL);
}

$name = get_post('name');
$password = get_post('password');
$token = get_post('token');

$db = get_db_connect();

$check_csrf = is_valid_csrf_token($token);

$user = login_as($db, $name, $password);
if($check_csrf === TRUE){
  if( $user === false){
    set_error('ログインに失敗しました。');
    redirect_to(LOGIN_URL);
  }

  set_message('ログインしました。');
  if ($user['type'] === USER_TYPE_ADMIN){
    redirect_to(ADMIN_URL);
  }
}else{
  set_error('ログインに失敗しました。');
}
redirect_to(HOME_URL);