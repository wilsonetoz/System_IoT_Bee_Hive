USE bee_hive_db;

CREATE TABLE IF NOT EXISTS tb_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    name VARCHAR(255),
    type ENUM('admin', 'user') DEFAULT 'user'
);

CREATE TABLE IF NOT EXISTS tb_dados2 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    timeStamp DATETIME,
    link_maps VARCHAR(255),
    n_sat INT,
    volt_bat DECIMAL(5,2),
    sinal INT,
    colmeia_id INT NOT NULL DEFAULT 1
);

INSERT INTO tb_users (email, senha, name, type) VALUES ('admin@example.com', MD5('admin123'), 'Administrador', 'admin') ON DUPLICATE KEY UPDATE name=name;
INSERT INTO tb_users (email, senha, name, type) VALUES ('user@example.com', MD5('user123'), 'Usuário Comum', 'user') ON DUPLICATE KEY UPDATE name=name;


CREATE USER IF NOT EXISTS 'admin_user'@'%' IDENTIFIED BY 'admin';
GRANT ALL PRIVILEGES ON bee_hive_db.* TO 'admin_user'@'%';
FLUSH PRIVILEGES;

CREATE USER IF NOT EXISTS 'readonly_user'@'%' IDENTIFIED BY 'user';
GRANT SELECT ON bee_hive_db.* TO 'readonly_user'@'%';
FLUSH PRIVILEGES;