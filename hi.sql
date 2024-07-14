-- Create the stock_market database if not exists
CREATE DATABASE IF NOT EXISTS stock_market DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Switch to the stock_market database
USE stock_market;

-- Table: users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);

-- Table: stocks
CREATE TABLE IF NOT EXISTS stocks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    symbol VARCHAR(10) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    change_amount DECIMAL(10, 2) NOT NULL,
    volume INT NOT NULL
);

-- Table: transactions
CREATE TABLE IF NOT EXISTS transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    stock_id INT NOT NULL,
    transaction_type ENUM('buy', 'sell') NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (stock_id) REFERENCES stocks(id)
);

-- Table: watchlist
CREATE TABLE IF NOT EXISTS watchlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    stock_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (stock_id) REFERENCES stocks(id)
);

-- Insert sample data into stocks table
INSERT INTO stocks (name, symbol, price, change_amount, volume) VALUES
('Apple Inc.', 'AAPL', 145.09, 1.12, 1000000),
('Microsoft Corp.', 'MSFT', 299.01, 2.35, 1500000),
('Amazon.com Inc.', 'AMZN', 3523.50, -15.45, 800000),
('Alphabet Inc.', 'GOOGL', 2845.79, 10.00, 500000),
('Tesla Inc.', 'TSLA', 750.50, -7.30, 1200000);
