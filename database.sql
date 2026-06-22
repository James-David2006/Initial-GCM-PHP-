CREATE DATABASE IF NOT EXISTS gcm_db;
USE gcm_db;

-- Admin
CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL
  ALTER TABLE admins ADD COLUMN full_name VARCHAR(100);
ALTER TABLE admins ADD COLUMN photo VARCHAR(255);

);

-- Homepage Hero
CREATE TABLE home_hero (
  id INT PRIMARY KEY,
  heading VARCHAR(255),
  subheading TEXT,
  button_text VARCHAR(100),
  button_link VARCHAR(255)
);

-- Homepage Slider
CREATE TABLE home_slides (
  id INT AUTO_INCREMENT PRIMARY KEY,
  image VARCHAR(255)
);

-- About
CREATE TABLE about (
  id INT PRIMARY KEY,
  intro TEXT,
  mission TEXT,
  vision TEXT,
  values TEXT
);

-- Events
CREATE TABLE events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  description TEXT,
  date DATE,
  banner VARCHAR(255)
);

-- Sermons
CREATE TABLE sermons (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  minister VARCHAR(255),
  date DATE,
  video_link VARCHAR(255)
);

-- Pastors
CREATE TABLE pastors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  title VARCHAR(255),
  image VARCHAR(255),
  bio TEXT
);

-- Stream
CREATE TABLE stream (
  id INT PRIMARY KEY,
  video_embed TEXT
);

-- Contacts
CREATE TABLE contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100),
  message TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Giving
CREATE TABLE donations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100),
  amount DECIMAL(10,2),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Optional: Insert default values
INSERT INTO home_hero (id, heading, subheading, button_text, button_link) 
VALUES (1, 'Welcome to God\'s Care Missions', 'Raising Kingdom Giants, Reaching out to souls and Transforming Nations', 'Learn More', 'about.html');

INSERT INTO about (id, intro, mission, vision, values)
VALUES (1, 'God\'s Care Missions is a Bible-based...', 'To reach the lost...', 'To raise a global army...', 'Integrity, Purity, Passion...');
-- audit log
CREATE TABLE audit_log (
  id INT AUTO_INCREMENT PRIMARY KEY,
  admin VARCHAR(50),
  action TEXT,
  timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

