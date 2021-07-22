<?php
require_once MODEL_PATH . 'db.php';

function insert_orders($db, $user_id){
  $sql = "
    INSERT INTO
      orders(
        user_id       
      )
    VALUES(?)
  ";

  return execute_query($db, $sql, [$user_id]);
}

//orders_id:orderテーブルのid / item_id:cartsテーブルのitem_id / item_name:itemテーブルのname / item_price:itemsテーブルのprice / amount:cartsテーブルのamount
function insert_order_items($db, $orders_id, $item_id, $item_name, $item_price, $amount){
  $sql = "
    INSERT INTO
      order_items(
        orders_id,
        item_id,
        item_name,
        item_price,
        amount
      )
    VALUES(?, ?, ?, ?, ?)
   ";

  return execute_query($db, $sql, [$orders_id, $item_id, $item_name, $item_price, $amount]);
}

//idごとの合計を取得
function get_user_orders($db, $user_id){
  $sql = "
  SELECT
    orders.id,
    orders.user_id,
    orders.create_datetime,
    order_items.orders_id,      
    SUM(order_items.item_price * order_items.amount)
  FROM
    orders
  JOIN
    order_items
  ON
    orders.id = order_items.orders_id
  WHERE
    orders.user_id = ?
  GROUP BY
    orders.id
  ORDER BY
    orders.create_datetime DESC
  ";

  return fetch_all_query($db, $sql, [$user_id]);
}

//全てのデータを取得
function get_all_orders($db){
  $sql = "
  SELECT
    orders.id,
    orders.user_id,
    orders.create_datetime,
    order_items.orders_id,      
    SUM(order_items.item_price * order_items.amount)
  FROM
    orders
  JOIN
    order_items
  ON
    orders.id = order_items.orders_id  
  GROUP BY
    orders.id
  ORDER BY
    orders.create_datetime DESC
  ";

  return fetch_all_query($db, $sql);
}

function get_orders($db, $id){
  $sql = "
    SELECT
      orders.id,
      orders.user_id,
      orders.create_datetime,
      order_items.orders_id,
      order_items.item_name,
      order_items.item_price,
      order_items.amount
    FROM
      orders
    JOIN
      order_items
    ON
      orders.id = order_items.orders_id 
    WHERE
      orders.id = ?
    ORDER BY
      orders.create_datetime DESC
    ";

    return fetch_all_query($db, $sql, [$id]);
}

function get_orders_total($db, $id){
  $sql = "
  SELECT
    orders.id,
    orders.user_id,
    orders.create_datetime,
    order_items.orders_id,      
    SUM(order_items.item_price * order_items.amount)
  FROM
    orders
  JOIN
    order_items
  ON
    orders.id = order_items.orders_id
  WHERE
    orders.id = ?
  GROUP BY
    orders.id
  ORDER BY
    orders.create_datetime DESC
  ";

  return fetch_query($db, $sql, [$id]);
}