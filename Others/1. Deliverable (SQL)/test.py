import mysql.connector
database = mysql.connector.connect(
    host = "localhost", # connecting with localhost
    username = "root", # username is root
    password = "", # no password    
    database = "CS300", # the existing database we want to connect with
    port = 4433
)
my_connection = database.cursor()
# my_connection.execute("CREATE DATABASE CS300")
if (database):
    # my_connection.execute("create table User (user_id int UNSIGNED AUTO_INCREMENT PRIMARY KEY, \
    #     name VARCHAR(50) NOT NULL, \
    #     cnic char(15) NOT NULL, \
    #     contact_number VARCHAR(20) NOT NULL, \
    #     email_id VARCHAR(255) NOT NULL, \
    #     address VARCHAR(255) NOT NULL, \
    #     username VARCHAR(20) NOT NULL, \
    #     role VARCHAR(15) NOT NULL)"
    # )

    insert_query = "INSERT INTO User(name, cnic, contact_number, email_id, address, username, role)";
    insert_query += " VALUES('Uzair', '35202-1234567-9', '090078601', 'uzair9990@gmail.com', '155-H', 'uzair_9990', 'Admin')";
    my_connection.execute(insert_query)
    database.commit()

    read_query = "SELECT * FROM User"
    my_connection.execute(read_query)
    result = my_connection.fetchall()

    for x in result:
        print(x, "\n")
