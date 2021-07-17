<?php

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

function get_user_orders($db, $user_id){
    $sql = "
      SELECT
        orders.id,
        orders.user_id,
        order_items.orders_id,
        order_items.item_id,
        order_items.item_name,
        order_items.item_price,
        order_items.amount
      FROM
        order_items
      JOIN
        orders
      ON
        order_items.orders_id = orders.id
      WHERE
        orders.user_id = ?
    ";

    return fetch_all_query($db, $sql, [$user_id]);
}