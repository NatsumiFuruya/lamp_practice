<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title>購入明細</title>
    <link rel="stylesheet" href="<?php print(h(STYLESHEET_PATH . 'admin.css')); ?>">
</head>
<body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
    <h1>購入明細</h1>

    <div class="container">
        
    <!--注文番号-->
    <p>注文番号:<?php print(h($orders_total['id'])); ?></p>
    <!--購入日時-->
    <p>購入日時:<?php print(h($orders_total['create_datetime'])); ?></p>
    <!--合計金額-->
    <p>合計金額:<?php print(h($orders_total['SUM(order_items.item_price * order_items.amount)'])); ?>円</p>

        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>商品名</th>
                    <th>購入価格</th>
                    <th>購入数</th>
                    <th>小計</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($order_items as $order_item){ ?>
                <tr>
                  <!--商品名-->
                  <td><?php print(h($order_item['item_name'])); ?></td>
                  <!--購入価格-->
                  <td><?php print(h($order_item['item_price'])); ?></td>
                  <!--購入数-->
                  <td><?php print(h($order_item['amount'])); ?></td>
                  <!--小計-->
                  <td><?php print(h($order_item['item_price']) * ($order_item['amount'])); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
        
    