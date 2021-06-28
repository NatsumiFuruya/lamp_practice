<!DOCTYPE html>
<html lang="ja">
<head>
  <!--'templates/head.php'の読み込み-->
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>カート</title>
  <link rel="stylesheet" href="<?php print(h(STYLESHEET_PATH . 'cart.css')); ?>">
</head>
<body>
  <!--'templates/header_logined.php'の読み込み-->
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  <h1>カート</h1>
  <div class="container">
    <!--'templates/messages.php'の読み込み-->
    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    <!--カート内に一つ以上の商品があるとき-->
    <?php if(count($carts) > 0){ ?>
      <table class="table table-bordered">
        <thead class="thead-light">
          <tr>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>購入数</th>
            <th>小計</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($carts as $cart){ ?>
          <tr>
            <!--商品画像-->
            <td><img src="<?php print(h(IMAGE_PATH . $cart['image']));?>" class="item_image"></td>
            <!--商品名-->
            <td><?php print(h($cart['name'])); ?></td>
            <!--値段-->
            <td><?php print(h(number_format($cart['price']))); ?>円</td>

            <!--カート内の購入数変更-->
            <td>        
              <form method="post" action="cart_change_amount.php">
                <input type="number" name="amount" value="<?php print(h($cart['amount'])); ?>">
                個
                <input type="submit" value="変更" class="btn btn-secondary">
                <input type="hidden" name="cart_id" value="<?php print(h($cart['cart_id'])); ?>">
              </form>
            </td>
            <!--小計-->
            <td><?php print(h(number_format($cart['price'] * $cart['amount']))); ?>円</td>

            <td>
              <!--カート内削除-->
              <form method="post" action="cart_delete_cart.php">
                <input type="submit" value="削除" class="btn btn-danger delete">
                <input type="hidden" name="cart_id" value="<?php print(h($cart['cart_id'])); ?>">
              </form>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <!--合計金額-->
      <p class="text-right">合計金額: <?php print(h(number_format($total_price))); ?>円</p>
      <form method="post" action="finish.php">
        <input class="btn btn-block btn-primary" type="submit" value="購入する">
      </form>
    <?php } 
    //カート内に商品がないとき
    else { ?>
      <p>カートに商品はありません。</p>
    <?php } ?> 
  </div>
  <!--商品削除アラート-->
  <script>
    $('.delete').on('click', () => confirm('本当に削除しますか？'))
  </script>
</body>
</html>