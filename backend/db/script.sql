CREATE DATABASE car_rental;

USE car_rental;

-- Table to store the staff details
CREATE TABLE staff (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    nic VARCHAR(20) NOT NULL,  -- National ID Card number
    contact_number VARCHAR(20) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    address TEXT NOT NULL,
    designation VARCHAR(50) NOT NULL
);

-- Table to store the customer rides
CREATE TABLE rides (
    ride_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    car_id INT NOT NULL,
    pickup_date DATETIME NOT NULL,
    dropoff_date DATETIME NOT NULL,
    pickup_location VARCHAR(255) NOT NULL,
    with_driver BOOLEAN NOT NULL,
    driver_id INT,                              -- NULL if with_driver is false
    discount_coupon VARCHAR(50),
    FOREIGN KEY (car_id) REFERENCES cars(car_id),
    FOREIGN KEY (driver_id) REFERENCES drivers(driver_id)
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);

-- Table to store the car details
CREATE TABLE cars (
    car_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique vehicle ID
    brand VARCHAR(100) NOT NULL,                -- Brand of the vehicle
    year YEAR NOT NULL,                         -- Year of manufacture
    engine_capacity DECIMAL(4, 1) NOT NULL,     -- Engine capacity in liters
    no_plate VARCHAR(20) NOT NULL,              -- Vehicle number plate
    colour VARCHAR(50) NOT NULL,                -- Color of the vehicle
    fuel_type VARCHAR(50) NOT NULL,             -- Fuel type (e.g., Petrol, Diesel, Electric)
    no_of_seats INT NOT NULL,                   -- Number of seats in the vehicle
    rental_price DECIMAL(10, 2) NOT NULL,       -- Rental price per day
    details TEXT,                               -- Additional details about the vehicle
    is_available BOOLEAN DEFAULT TRUE           -- Availability status (1 for available, 0 for not available)
    supplier_id INT NOT NULL,                   -- Supplier ID
    FOREIGN KEY (supplier_id) REFERENCES suppliers(supplier_id)
);


-- Table to store the driver details
CREATE TABLE suppliers (
    supplier_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique supplier ID
    supplier_name VARCHAR(255) NOT NULL,         -- Name of the supplier
    contact_info VARCHAR(255),                   -- Contact information (optional)
    address TEXT                                 -- Address of the supplier (optional)
    dob DATE,                                    -- Date of birth of
    age INT,                                     -- Age of the supplier
    telephone VARCHAR(20),                       -- Telephone number of the supplier
    email VARCHAR(100)                           -- Email address of the supplier
    address TEXT                                 -- Address of the supplier
);

-- Table to store the driver details
CREATE TABLE drivers (
    driver_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique driver ID
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    nic VARCHAR(20) NOT NULL,  -- National ID Card number
);

-- Table to store the customer details
CREATE TABLE customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique customer ID
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    nic VARCHAR(20) NOT NULL,  -- National ID Card number
    email VARCHAR(100) NOT NULL,
    contact_number VARCHAR(20) NOT NULL
);