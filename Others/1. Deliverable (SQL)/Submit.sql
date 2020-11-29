-- Later, we decided to drop the table "username_passcode." We deleted it

-- create table username_passcode (
--     username varchar(20) PRIMARY KEY,
--     passcode varchar(20)
-- );

create table User (
    user_id int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name varchar(50) NOT NULL,
    cnic char(15) NOT NULL, /* including dashes of the CNIC, we need 15 characters */
    contact_number varchar(20) NOT NULL,
    email_id varchar(255) NOT NULL,
    address varchar(255) NOT NULL,
    username varchar(20) NOT NULL,
    role varchar(15) NOT NULL,
    FOREIGN KEY (username) REFERENCES username_passcode(username) ON DELETE CASCADE
);

-- As we dropped the table username_passcode, we had to add passcode field in the User table

ALTER TABLE User
ADD password varchar(255) NOT NULL
AFTER username;

-- As we dropped the table username_passcode, the FK "username" had to be dropped from User table

ALTER TABLE User 
DROP FOREIGN KEY User_ibfk_1;

-- In order to maintain consistency for which user is approved and which is not, we used an approved_bit, mentioned below

ALTER TABLE User
ADD approved_bit BIT NOT NULL
AFTER role

create table Customer (
    user_id int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    connection_type VARCHAR(255),
    total_discount FLOAT, /* 12% discount will be stored as 0.12 */
    balance FLOAT, /* Let us always store balance as float, i.e. 157.00 (RS) */
    black_list_status BIT, /* bit for bool. Can have 0 or 1 in it ONLY*/
    FOREIGN KEY (user_id) REFERENCES User (user_id) ON DELETE CASCADE
);

create table Admin (
    user_id int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    position VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES User (user_id) ON DELETE CASCADE
);

create table Data_Package (
    pkg_id int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    monthly_limit FLOAT
);

create table Third_Party (
    user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(255),
    pkg_id int UNSIGNED,
    FOREIGN KEY (pkg_id) REFERENCES Data_Package (pkg_id)
);

create table Utilities(
    utility_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    connection_type VARCHAR(255) NOT NULL,
    utility_name VARCHAR(255),
    fixed_monthly_price FLOAT,
    unit_price FLOAT,
    PRIMARY KEY (utility_id, connection_type)
);

-- Later, we decided to add images for the utility as well

ALTER TABLE Utilities
ADD image TEXT NOT NULL -- image name will be stored as text
AFTER unit_price

-- Again, we decided to change the PK and set it to VARCHAR (255) from INT UNSIGNED

ALTER TABLE Utilities
MODIFY COLUMN utility_id VARCHAR(255)

create table complaint(
    complaint_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    utility_id INT UNSIGNED,
    user_id INT UNSIGNED,
    complaint_status BIT,
    complaint_desc TEXT,
    registeration_date DATE,
    resolution_date DATE,
    escalation_status BIT,
    FOREIGN KEY (utility_id) REFERENCES Utilities (utility_id) ON DELETE SET NULL,
    FOREIGN KEY (user_id) REFERENCES User (user_id) ON DELETE SET NULL
);

create table Payments(
    user_id INT UNSIGNED,
    payment_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    payment_amount FLOAT,
    FOREIGN KEY (user_id) REFERENCES User (user_id) ON DELETE SET NULL
);

create table Registers_For(
    utility_id INT UNSIGNED,
    user_id INT UNSIGNED,
    connection_type VARCHAR(255),
    units_consumed FLOAT,
    PRIMARY KEY (user_id, utility_id, connection_type),
    FOREIGN KEY (user_id) REFERENCES User (user_id) ON DELETE CASCADE,
    FOREIGN KEY (utility_id) REFERENCES Utilities (utility_id) ON DELETE CASCADE
);

create table invoice(
    invoice_id INT UNSIGNED PRIMARY KEY,
    user_id INT UNSIGNED,
    utility_id INT UNSIGNED,
    bill_amount FLOAT,
    amount_received float,
    bill_due float,
    bill_status BIT,
    date_of_payment DATE,
    FOREIGN KEY (utility_id) REFERENCES Utilities (utility_id) ON DELETE SET NULL,
    FOREIGN KEY (user_id) REFERENCES User (user_id) ON DELETE SET NULL
);

create table Invoice_Payments(
    invoice_id INT UNSIGNED,
    payment_id INT UNSIGNED,
    PRIMARY KEY(invoice_id, payment_id),
    FOREIGN KEY(invoice_id) REFERENCES invoice (invoice_id) ON DELETE CASCADE,
    FOREIGN KEY(payment_id) REFERENCES Payments (payment_id) ON DELETE CASCADE
);
