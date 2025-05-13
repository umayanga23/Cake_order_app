create database cakee;
use cakee;
CREATE TABLE users (
  email VARCHAR(100) PRIMARY KEY,
  password VARCHAR(100) NOT NULL
);

CREATE TABLE orderr (
  item VARCHAR(100) NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  fullName VARCHAR(100) NOT NULL,
  address TEXT NOT NULL,
  contactNumber VARCHAR(15) NOT NULL,
  size INT NOT NULL,
  paymentMethod VARCHAR(50) NOT NULL,
  deliveryDate DATE NOT NULL
);

CREATE TABLE contact (
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  message TEXT NOT NULL
);
