-- Creación de la base de datos
CREATE DATABASE IF NOT EXISTS lodging_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
  CHARACTER SET = utf8mb4 
  COLLATE = utf8mb4_unicode_ci;

USE lodging_db;

-- Tabla de ciudades
CREATE TABLE cities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    province VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uk_city_province (name, province)
) ENGINE=InnoDB;

-- Tabla de tipos de habitaciones
CREATE TABLE room_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabla de traducciones para tipos de habitaciones
CREATE TABLE room_type_translations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_type_id INT NOT NULL,
    language_code VARCHAR(5) NOT NULL,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (room_type_id) REFERENCES room_types(id) ON DELETE CASCADE,
    UNIQUE KEY uk_room_type_lang (room_type_id, language_code)
) ENGINE=InnoDB;

-- Tabla base para hospedajes
CREATE TABLE accommodations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) NOT NULL UNIQUE,
    type ENUM('hotel', 'apartment') NOT NULL,
    city_id INT NOT NULL,
    active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (city_id) REFERENCES cities(id)
) ENGINE=InnoDB;

-- Tabla de traducciones para hospedajes
CREATE TABLE accommodation_translations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    accommodation_id INT NOT NULL,
    language_code VARCHAR(5) NOT NULL,
    name VARCHAR(200) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (accommodation_id) REFERENCES accommodations(id) ON DELETE CASCADE,
    UNIQUE KEY uk_accommodation_lang (accommodation_id, language_code),
    -- Índice para búsqueda por primeras letras
    INDEX idx_name_search (name)
) ENGINE=InnoDB;

-- Tabla específica para hoteles
CREATE TABLE hotels (
    accommodation_id INT PRIMARY KEY,
    stars INT NOT NULL CHECK (stars BETWEEN 1 AND 5),
    room_type_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (accommodation_id) REFERENCES accommodations(id) ON DELETE CASCADE,
    FOREIGN KEY (room_type_id) REFERENCES room_types(id)
) ENGINE=InnoDB;

-- Tabla específica para apartamentos
CREATE TABLE apartments (
    accommodation_id INT PRIMARY KEY,
    total_units INT NOT NULL CHECK (total_units > 0),
    adult_capacity INT NOT NULL CHECK (adult_capacity > 0),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (accommodation_id) REFERENCES accommodations(id) ON DELETE CASCADE
) ENGINE=InnoDB;

SET NAMES 'utf8mb4';
-- Datos de ejemplo para pruebas
INSERT INTO cities (name, province) VALUES 
('Valencia', 'Valencia'),
('Almeria', 'Almeria'),
('Mojacar', 'Almeria'),
('Sanlucar', 'Cádiz'),
('Málaga', 'Málaga');

INSERT INTO room_types (code) VALUES 
('SINGLE'),
('DOUBLE'),
('DOUBLE_VIEW');

INSERT INTO room_type_translations (room_type_id, language_code, name) VALUES 
(1, 'es', 'Habitación Individual'),
(1, 'en', 'Single Room'),
(2, 'es', 'Habitación Doble'),
(2, 'en', 'Double Room'),
(3, 'es', 'Habitación Doble con Vistas'),
(3, 'en', 'Double Room with View');

-- Insertar hospedajes de ejemplo
-- Hotel Azul
INSERT INTO accommodations (code, type, city_id) VALUES ('HAZUL', 'hotel', 1);
SET @hazul_id = LAST_INSERT_ID();
INSERT INTO accommodation_translations (accommodation_id, language_code, name) VALUES 
(@hazul_id, 'es', 'Hotel Azul'),
(@hazul_id, 'en', 'Blue Hotel');
INSERT INTO hotels (accommodation_id, stars, room_type_id) VALUES (@hazul_id, 3, 3);

-- Apartamentos Beach
INSERT INTO accommodations (code, type, city_id) VALUES ('ABEACH', 'apartment', 2);
SET @abeach_id = LAST_INSERT_ID();
INSERT INTO accommodation_translations (accommodation_id, language_code, name) VALUES 
(@abeach_id, 'es', 'Apartamentos Beach White'),
(@abeach_id, 'en', 'Beach White Apartments');
INSERT INTO apartments (accommodation_id, total_units, adult_capacity) VALUES (@abeach_id, 10, 4);

-- Hotel Blanco en Mojacar
INSERT INTO accommodations (code, type, city_id) VALUES ('HBLAN', 'hotel', 3);
SET @hblan_id = LAST_INSERT_ID();
INSERT INTO accommodation_translations (accommodation_id, language_code, name) VALUES 
(@hblan_id, 'es', 'Hotel Blanco Beach'),
(@hblan_id, 'en', 'White Beach Hotel');
INSERT INTO hotels (accommodation_id, stars, room_type_id) VALUES (@hblan_id, 4, 2);

-- Hotel Rojo en Sanlucar
INSERT INTO accommodations (code, type, city_id) VALUES ('HROJO', 'hotel', 4);
SET @hrojo_id = LAST_INSERT_ID();
INSERT INTO accommodation_translations (accommodation_id, language_code, name) VALUES 
(@hrojo_id, 'es', 'Hotel Rojo'),
(@hrojo_id, 'en', 'Red Hotel');
INSERT INTO hotels (accommodation_id, stars, room_type_id) VALUES (@hrojo_id, 3, 1);

-- Apartamentos Sol y Playa en Málaga
INSERT INTO accommodations (code, type, city_id) VALUES ('ASOL', 'apartment', 5);
SET @asol_id = LAST_INSERT_ID();
INSERT INTO accommodation_translations (accommodation_id, language_code, name) VALUES 
(@asol_id, 'es', 'Apartamentos Sol y Playa'),
(@asol_id, 'en', 'Sun and Beach Apartments');
INSERT INTO apartments (accommodation_id, total_units, adult_capacity) VALUES (@asol_id, 50, 6);

-- Hotel Marina en Valencia
INSERT INTO accommodations (code, type, city_id) VALUES ('HMAR', 'hotel', 1);
SET @hmar_id = LAST_INSERT_ID();
INSERT INTO accommodation_translations (accommodation_id, language_code, name) VALUES 
(@hmar_id, 'es', 'Hotel Marina'),
(@hmar_id, 'en', 'Marina Hotel');
INSERT INTO hotels (accommodation_id, stars, room_type_id) VALUES (@hmar_id, 5, 3);

-- Apartamentos Costa en Almeria
INSERT INTO accommodations (code, type, city_id) VALUES ('ACOS', 'apartment', 2);
SET @acos_id = LAST_INSERT_ID();
INSERT INTO accommodation_translations (accommodation_id, language_code, name) VALUES 
(@acos_id, 'es', 'Apartamentos Costa'),
(@acos_id, 'en', 'Coast Apartments');
INSERT INTO apartments (accommodation_id, total_units, adult_capacity) VALUES (@acos_id, 25, 4);

-- Hotel Playa en Mojacar
INSERT INTO accommodations (code, type, city_id) VALUES ('HPLA', 'hotel', 3);
SET @hpla_id = LAST_INSERT_ID();
INSERT INTO accommodation_translations (accommodation_id, language_code, name) VALUES 
(@hpla_id, 'es', 'Hotel Playa'),
(@hpla_id, 'en', 'Beach Hotel');
INSERT INTO hotels (accommodation_id, stars, room_type_id) VALUES (@hpla_id, 4, 2);

-- Apartamentos Vista Mar en Sanlucar
INSERT INTO accommodations (code, type, city_id) VALUES ('AVIS', 'apartment', 4);
SET @avis_id = LAST_INSERT_ID();
INSERT INTO accommodation_translations (accommodation_id, language_code, name) VALUES 
(@avis_id, 'es', 'Apartamentos Vista Mar'),
(@avis_id, 'en', 'Sea View Apartments');
INSERT INTO apartments (accommodation_id, total_units, adult_capacity) VALUES (@avis_id, 15, 3);

-- Hotel Mediterráneo en Málaga
INSERT INTO accommodations (code, type, city_id) VALUES ('HMED', 'hotel', 5);
SET @hmed_id = LAST_INSERT_ID();
INSERT INTO accommodation_translations (accommodation_id, language_code, name) VALUES 
( @hmed_id, 'es', 'Hotel Mediterráneo'),
( @hmed_id, 'en', 'Mediterranean Hotel');
INSERT INTO hotels (accommodation_id, stars, room_type_id) VALUES ( @hmed_id, 5, 3);

-- Apartamentos Sunset en Valencia
INSERT INTO accommodations (code, type, city_id) VALUES ('ASUN', 'apartment', 1);
SET @asun_id = LAST_INSERT_ID();
INSERT INTO accommodation_translations (accommodation_id, language_code, name) VALUES 
(@asun_id, 'es', 'Apartamentos Sunset'),
(@asun_id, 'en', 'Sunset Apartments');
INSERT INTO apartments (accommodation_id, total_units, adult_capacity) VALUES (@asun_id, 30, 5);