ALTER TABLE usuario
ADD tipo ENUM('admin', 'user') DEFAULT 'user';