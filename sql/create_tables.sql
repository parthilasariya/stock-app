CREATE TABLE requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type ENUM('buy', 'withdraw') NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    shares INT NOT NULL,
    status ENUM('Pending', 'Processed') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);