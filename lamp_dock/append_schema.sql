CREATE TABLE orders(
  id INT AUTO_INCREMENT,
  user_id INT,
  create_datetime
);

CREATE TABLE order_items(
  orders_id INT,  
  item_id INT,
  item_name VARCHAR,
  item_price INT,
  amount INT
);
