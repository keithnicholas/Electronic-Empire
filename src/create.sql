DROP TABLE IF EXISTS Customer;
DROP TABLE IF EXISTS Product;
DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS Storage;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS Cart;
DROP TABLE IF EXISTS Shipment;
DROP TABLE IF EXISTS Stores;

CREATE TABLE Customer(
    userid VARCHAR(30),
    First_name VARCHAR(30)  NOT NULL,
    Last_name VARCHAR(30)  NOT NULL,
    Password VARCHAR(30)  NOT NULL,
    Address VARCHAR(50) NOT NULL,
    City VARCHAR(30)  NOT NULL,
    State VARCHAR(30)  NOT NULL,
    Zip VARCHAR(10)  NOT NULL,
    Card_number VARCHAR(17),
    Card_password VARCHAR(10),
    Primary Key(userid)
);

CREATE TABLE Product(
    Pid INT,
    Pname VARCHAR(30) NOT NULL,
    Description VARCHAR(100) NOT NULL,
    Price INT NOT NULL,
    Category VARCHAR(30) NOT NULL,
    con VARCHAR(3) NOT NULL,
    Primary Key(Pid)
);

CREATE TABLE Comment(
    userid VARCHAR(30),
    Pid INT,
    comment_id INT,
    comment_date DATE,
    Rate INT,
    comment_info VARCHAR(256),
    PRIMARY KEY(userid, Pid, comment_id),
    FOREIGN KEY(userid) REFERENCES Customer(userid)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY(Pid) REFERENCES Product(Pid)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

CREATE TABLE Storage(
    Sid int NOT NULL,
    Name  VARCHAR(30) NOT NULL,
    City  VARCHAR(30) NOT NULL,
    State  VARCHAR(10) NOT NULL,
    Primary Key(Sid)
);

CREATE TABLE Orders(
    order_id INT PRIMARY KEY,
    Order_date date
);

CREATE TABLE Cart(
    Userid VARCHAR(30),
    Pid INT,
    Add_date DATE  NOT NULL,
    Total_number INT NOT NULL,
    Total_price DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (Userid, Pid),
    FOREIGN KEY (Userid) REFERENCES Customer(Userid)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Pid) REFERENCES Product(Pid)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

CREATE TABLE Shipment(
    Sid INT,
    order_id INT,
    Shipment_Date DATE NOT NULL,
    Primary Key(Sid),
    FOREIGN KEY (order_id) REFERENCES Orders(order_id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

CREATE TABLE Stores(
    Pid INT,
    Sid INT,
    Inventory int NOT NULL,
    PRIMARY KEY(Pid, Sid),
    FOREIGN KEY (Pid) REFERENCES Product(Pid)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (Sid) REFERENCES Shipment(Sid)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);
