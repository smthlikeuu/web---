CREATE DATABASE IF NOT EXISTS demoshop
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE demoshop;

CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(150) NOT NULL,
    category VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    stock INT UNSIGNED NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO products (name, category, price, stock)
SELECT * FROM (
    SELECT 'Ноутбук StartBook 15', 'Ноутбуки', 54990.00, 7
    UNION ALL SELECT 'Мышь ClickPro', 'Аксессуары', 1290.00, 25
    UNION ALL SELECT 'Клавиатура TypeOne', 'Аксессуары', 2490.00, 14
) AS seed
WHERE NOT EXISTS (SELECT 1 FROM products);
