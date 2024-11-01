CREATE DATABASE DragonBall_Store;

USE DragonBall_Store;

CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL
);

INSERT INTO products (product_name, price)
VALUES
('DragonBall Action Figure', 19.99),
('DragonBall T-Shirt', 24.99),
('DragonBall Backpack', 39.99),
('DragonBall Mug', 9.99),
('DragonBall Poster', 14.99);

CREATE TABLE fans (
    fan_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    address VARCHAR(255) NOT NULL
);

INSERT INTO fans (username, password, full_name, address)
VALUES
('goku_fan', '123456', 'Goku Fan', '123 Kamehameha St, West City'),
('vegeta_fan', 'password', 'Vegeta Fan', '456 Capsule Corp Blvd, East City'),
('bulma_fan', 'bulma123', 'Bulma Fan', '789 Capsule Corp Blvd, East City'),
('krillin_fan', 'krillin456', 'Krillin Fan', '246 Turtle School Rd, Kame House');

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    fan_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (fan_id) REFERENCES fans(fan_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
);

INSERT INTO orders (fan_id, product_id, quantity, total_price)
VALUES
(1, 1, 2, 39.98),
(2, 3, 1, 39.99),
(3, 2, 3, 74.97),
(4, 5, 1, 14.99);

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE
);

INSERT INTO users (username, password, email)
VALUES
('admin', 'admin123', 'admin@example.com'),
('user1', 'user123', 'user1@example.com'),
('user2', 'user456', 'user2@example.com');
