ALTER TABLE Utilities
ADD COLUMN image TEXT NOT NULL
AFTER unit_price

DROP TABLE Registers_For
DROP TABLE complaint
DROP TABLE Invoice_Payments
DROP TABLE invoice

ALTER TABLE Utilities
MODIFY COLUMN utility_id VARCHAR(255)

---------------------- WE ARE HALF WAY THROUGH THE JOURNEY. WE HAVE DROPPED + MODIFIEID ... NOW WE NEED TO RE-CREATE

create table Registers_For(
utility_id VARCHAR(255),
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
utility_id VARCHAR(255),
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

create table complaint(
complaint_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
utility_id VARCHAR (255),
user_id INT UNSIGNED,
complaint_status BIT,
complaint_desc TEXT,
registeration_date DATE,
resolution_date DATE,
escalation_status BIT,
FOREIGN KEY (utility_id) REFERENCES Utilities (utility_id) ON DELETE SET NULL,
FOREIGN KEY (user_id) REFERENCES User (user_id) ON DELETE SET NULL
);

