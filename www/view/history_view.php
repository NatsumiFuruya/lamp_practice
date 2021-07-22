<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title>購入履歴</title>
    <link rel="stylesheet" href="<?php print(h(STYLESHEET_PATH . 'admin.css')); ?>">
</head>
<body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
    <h1>購入履歴</h1>

    <div class="container">
        <?php if(count($orders) > 0){ ?>
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>注文番号</th>
                        <th>購入日時</th>
                        <th>合計金額</th>
                        <th>購入明細</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $order){ ?>
                    <tr>
                      <!--注文番号-->
                      <td><?php print(h($order['id'])); ?></td>
                      <!--購入日時-->
                      <td><?php print(h($order['create_datetime'])); ?></td>                      
                      <!--合計金額-->
                      <td><?php print(h($order['SUM(order_items.item_price * order_items.amount)'])); ?>円</td>
                      <!--購入明細ボタン-->     
                      <td>
                          <form method="post" action="order.php">
                              <input class="btn btn-block btn-primary" type="submit" value="購入明細表示">
                              <input type="hidden" name="id" value="<?php print(h($order['id'])); ?>">
                              <input type="hidden" name="token" value="<?php print $token; ?>">
                          </form>
                      </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php }
        else { ?>
            <p>購入履歴がありません。</p>
        <?php } ?>
    </div>
</body>
</html>