CREATE TABLE purchase(
  order_id INT AUTO_INCREMENT,
  user_id INT,
  create_datetime DATETIME
);

CREATE TABLE order(
  order_id INT,  
  item_id INT,
  amount INT
);
