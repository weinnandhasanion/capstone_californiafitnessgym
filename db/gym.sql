CREATE DATABASE gym;
USE gym;

CREATE TABLE admin(
    admin_id INT(100) PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100),
    password VARCHAR(100),
    first_name VARCHAR(100),
    last_name VARCHAR(100)
);
ALTER TABLE `admin`
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87000;

CREATE TABLE member(
    member_id INT(100) PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    username VARCHAR(100),
    password VARCHAR(100),
    passwordChanged TINYINT(1),
    gender ENUM('M','F'),
    birthdate DATE,
    email VARCHAR(100),
    phone VARCHAR(11),
    member_status ENUM('Paid', 'Expired') NOT NULL,
    date_registered DATE,
    date_deleted DATE,
    first_check_in_date DATE,
    member_type ENUM('Regular','Walk-in'),
    address VARCHAR(100),
    acc_status ENUM('active','inactive') NOT NULL,
    admin_id INT(100),
    program_id INT(100)
);
ALTER TABLE `member`
  MODIFY `member_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1921681000;


CREATE TABLE trainer(
    trainer_id INT(100) PRIMARY KEY,
    trainer_status ENUM('active','inactive') NOT NULL,
    trainer_position ENUM('junior','senior') NOT NULL,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    address VARCHAR(100),
    gender ENUM('M','F'),
    phone VARCHAR(11),
    email VARCHAR(100),
    file BLOB,
    birthdate DATE,
    date_hired DATE, 
    date_deleted DATE,
    acc_status ENUM('able','disable') NOT NULL
);
ALTER TABLE `trainer`
  MODIFY `trainer_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1510;
  

CREATE TABLE paymentLog(
    payment_id INT(100) PRIMARY KEY,
    member_id INT(100),
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    admin_id INT(100),
    payment_amount ENUM('750','200','50') NOT NULL,
    date_payment DATE,  
    payment_description ENUM('Monthly Subscription', 'Annual Subscription', 'Walk-in'),
    payment_type ENUM('Cash','Online') NOT NULL
);
ALTER TABLE `paymentLog`
  MODIFY `payment_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=09260;

ALTER TABLE paymentlog
ADD FOREIGN KEY (member_id) REFERENCES member(member_id);

CREATE TABLE program(
    program_id INT(100) PRIMARY KEY,
    program_name VARCHAR(100),
    program_type VARCHAR(100),
    date_added DATE,
    date_deleted DATE,
    program_description VARCHAR(500),
    program_status ENUM('active','remove')NOT NULL
);
ALTER TABLE `program`
  MODIFY `program_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT= 1001;

CREATE TABLE inventory(
  inventory_id INT(100) PRIMARY KEY,
  inventory_name VARCHAR(100),
  inventory_category ENUM('Cardio Equipment','Weight Equipment'),
  inventory_qty INT(255),
  inventory_damage INT(255),
  inventory_working INT(255),
  inventory_description VARCHAR(255),
  date_deleted DATE,
  date_added DATE
);
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT= 110;
  
CREATE TABLE logtrail(
    logtrail_id INT(100) PRIMARY KEY AUTO_INCREMENT,
    admin_id INT(100),
    dateandtime_login  DATETIME DEFAULT CURRENT_TIMESTAMP,
    time_logout  TIME NULL,
    first_name VARCHAR(100),
    last_name VARCHAR(100)
);
ALTER TABLE `logtrail`
  MODIFY `logtrail_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT= 3100;
ALTER TABLE logtrail
ADD FOREIGN KEY (admin_id) REFERENCES admin(admin_id);
  






