<!DOCTYPE html>
<html lang="ja">
<head>
  <!--'templates/head.php'の読み込み-->
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>商品一覧</title>
  <link rel="stylesheet" href="<?php print(h(STYLESHEET_PATH . 'index.css')); ?>">
</head>
<body>
  <!--'templates/header_logined.php'の読み込み-->
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  

  <div class="container">
    <h1>商品一覧</h1>
    <!--'templates/messages.php'の読み込み-->
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <div class="card-deck">
      <div class="row">
      <?php foreach($items as $item){ ?>
        <div class="col-6 item">
          <div class="card h-100 text-center">
            <div class="card-header">
              <!--商品名-->
              <?php print(h($item['name'])); ?>
            </div>
            <figure class="card-body">
              <!--商品画像-->
              <img class="card-img" src="<?php print(h(IMAGE_PATH . $item['image'])); ?>">
              <figcaption>
                <!--値段-->
                <?php print(h(number_format($item['price']))); ?>円
                <!--在庫数によって追加ボタンor売り切れ表示-->
                <?php if($item['stock'] > 0){ ?>
                  <form action="index_add_cart.php" method="post">
                    <input type="submit" value="カートに追加" class="btn btn-primary btn-block">
                    <input type="hidden" name="item_id" value="<?php print($item['item_id']); ?>">
                    <input type="hidden" name="token" value="<?php print $token; ?>">
                  </form>
                <?php } else { ?>
                  <p class="text-danger">現在売り切れです。</p>
                <?php } ?>
              </figcaption>
            </figure>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>
    <h1>人気ランキング</h1>
    <table>
      <tr>
        <th>１位</th>
        <th>２位</th>
        <th>３位</th>
      </tr>
      <tr>      
        <th><img class="card-img" src="<?php print(h(IMAGE_PATH . $item_ranking[0]['image'])); ?>"></th>
        <th><img class="card-img" src="<?php print(h(IMAGE_PATH . $item_ranking[1]['image'])); ?>"></th>
        <th><img class="card-img" src="<?php print(h(IMAGE_PATH . $item_ranking[2]['image'])); ?>"></th>
      </tr>
      <tr>
        <th><?php print(h($item_ranking[0]['name'])); ?></th>
        <th><?php print(h($item_ranking[1]['name'])); ?></th>
        <th><?php print(h($item_ranking[2]['name'])); ?></th>
      </tr>
  </div>
  
</body>
</html>