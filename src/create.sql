DROP TABLE IF EXISTS Stores;
DROP TABLE IF EXISTS Shipment;
DROP TABLE IF EXISTS OrderedProduct;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS Cart;
DROP TABLE IF EXISTS Storage;
DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS Product;
DROP TABLE IF EXISTS Customer;

CREATE TABLE Customer(
    username VARCHAR(50),
    first_name VARCHAR(30)  NOT NULL,
    last_name VARCHAR(30)  NOT NULL,
    pw VARCHAR(50)  NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    address VARCHAR(50) NOT NULL,
    city VARCHAR(30)  NOT NULL,
    state VARCHAR(30)  NOT NULL,
    zip VARCHAR(10)  NOT NULL,
    card_number VARCHAR(17),
    card_password VARCHAR(10),
    userImage longblob,
    userImageType VARCHAR(50),
    active INT DEFAULT 1,
    isAdmin INT DEFAULT 0,
    -- mediumblob
    Primary Key(username)
);

CREATE TABLE Product(
    pid INT AUTO_INCREMENT,
    pname VARCHAR(30) NOT NULL UNIQUE,
    description VARCHAR(255) NOT NULL,
    price INT NOT NULL,
    category VARCHAR(30) NOT NULL,
    con VARCHAR(3) NOT NULL,
    p_img_path VARCHAR(255),
    Primary Key(pid)
);

CREATE TABLE Comment(
    comment_id INT Auto_increment,
    username VARCHAR(50),
    pid INT,
    comment_date DATE,
    rate INT,
    comment_info VARCHAR(256),
    PRIMARY KEY(comment_id),
    FOREIGN KEY(username) REFERENCES Customer(username)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY(pid) REFERENCES Product(pid)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
);

-- CREATE TABLE Storage(
--     sid INT AUTO_INCREMENT,
--     name  VARCHAR(30) NOT NULL,
--     city  VARCHAR(30) NOT NULL,
--     state  VARCHAR(10) NOT NULL,
--     Primary Key(sid)
-- );


CREATE TABLE Cart(
    username VARCHAR(50),
    pid INT,
    add_date DATE  NOT NULL,
    total_number INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (username, pid),
    FOREIGN KEY (username) REFERENCES Customer(username)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (pid) REFERENCES Product(pid)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
);

CREATE TABLE Orders(
  order_id INT AUTO_INCREMENT PRIMARY KEY,
  order_date date,
  username VARCHAR(50),
  FOREIGN KEY (username) REFERENCES Customer(username)
)engine=innodb;

CREATE TABLE OrderedProduct (
  order_id INT,
  pid INT,
  total_number INT,
  PRIMARY KEY(order_id, pid),
  FOREIGN KEY(order_id) REFERENCES Orders(order_id),
  FOREIGN KEY(pid) REFERENCES Product(pid)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
);

-- CREATE TABLE Shipment(
--     sid INT Auto_increment,
--     order_id INT,
--     shipment_Date DATE NOT NULL,
--     Primary Key(sid),
--     FOREIGN KEY (order_id) REFERENCES Orders(order_id)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION
-- );
--
-- CREATE TABLE Stores(
--     pid INT,
--     sid INT,
--     inventory int NOT NULL,
--     PRIMARY KEY(pid, sid),
--     FOREIGN KEY (pid) REFERENCES Product(pid)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION,
--     FOREIGN KEY (sid) REFERENCES Shipment(sid)
--     ON DELETE NO ACTION
--     ON UPDATE NO ACTION
-- );
--



INSERT INTO Customer (username,first_name,last_name,pw, email, address,city,state,zip,card_number,card_password) Values ('JL','James','Lee',MD5('James'),'jl2000@gmail.com','123 Guder Rd','Kelowna','BC','V1Z3A9','1234556778877','11111111');

INSERT INTO Customer (username,first_name,last_name,pw, email, address,city,state,zip,card_number,card_password) Values ('OJ','Oliver','Jake',MD5('Oliver'),'oj2001@gmail.com','513 Hell Rd','Vancouver','BC','V1Z1A9','1234556353877','22222222');

INSERT INTO Customer (username,first_name,last_name,pw, email, address,city,state,zip,card_number,card_password) Values ('WD','William','Damian',MD5('William'),'wd1999@gmail.com','582 Pandora St','Yellowknife','YK','V1Z3A3','1234553278877','33333333');

INSERT INTO Customer (username,first_name,last_name,pw, email, address,city,state,zip,card_number,card_password) Values ('OR','Oscar','Ray',MD5('Oscar'),'or1999@gmail.com','95 Junge Rd','Missisauga','ON','V5Z3A9','1234567878877','44444444');

INSERT INTO Customer (username,first_name,last_name,pw, email, address,city,state,zip,card_number,card_password) Values ('EA','Emily','Alice',MD5('Emily'),'ea1999@gmail.com','505 Jane Rd','Hope','BC','V3Z3A8','1234258778877','55555555');
INSERT INTO Customer (username,first_name,last_name,pw, email, address,city,state,zip) Values ('Admin','Puck','Wang',MD5('Admin'),'puck19970418@gmail.com','123 ABC Rd','Kelowna','BC','V5PN3N');

INSERT INTO Product(pname, description, price, category, con) Values ('Macbook_pro','very good laptop designed by apple Inc',3299,'laptop','new');
INSERT INTO Product(pname, description, price, category, con) Values ('8G_Ram','8G ram for computer',599,'component','new');
INSERT INTO Product(pname, description, price, category, con) Values ('16G_Ram','16G ram for computer',899,'component','new');
INSERT INTO Product(pname, description, price, category, con) Values ('LG34UC79G','very good monitor designed by LG',999,'laptop','new');
INSERT INTO Product(pname, description, price, category, con) Values ('iphoneX','very good phone designed by apple Inc',1299,'laptop','new');
INSERT INTO Product(pname, description, price, category, con) Values ('Geforce1080ti','very good graphic ',1399,'component','new');
INSERT INTO Product(pname, description, price, category, con) Values ('LGspeaker','very good speaker designed by LG',399,'output device','new');
INSERT INTO Product(pname, description, price, category, con) Values ('SonyTV','very good TV designed by Sony',2399,'laptop','new');
INSERT INTO Product(pname, description, price, category, con) Values ('keyboard','very good keyboard designed by Logitech',199,'input device','new');
INSERT INTO Product(pname, description, price, category, con) Values ('mouse','very good mouse designed by Logitech',299,'input device','new');

INSERT INTO Comment (username,Pid,comment_date,Rate,comment_info) Values ('JL',1, '2018-11-23',5, 'this is very good');
INSERT INTO Comment (username,Pid,comment_date,Rate,comment_info) Values ('OJ',2, '2018-10-23',4, 'this is good');
INSERT INTO Comment (username,Pid,comment_date,Rate,comment_info) Values ('WD',2, '2018-09-23',3, 'this is very ok');
INSERT INTO Comment (username,Pid,comment_date,Rate,comment_info) Values ('OR',2, '2016-11-23',5, 'this is very good');
INSERT INTO Comment (username,Pid,comment_date,Rate,comment_info) Values ('OR',1, '2018-11-12',5, 'this is very good');
INSERT INTO Comment (username,Pid,comment_date,Rate,comment_info) Values ('EA',2, '2015-11-23',1, 'this is very bad');
INSERT INTO Comment (username,Pid,comment_date,Rate,comment_info) Values ('EA',1, '2018-11-22',2, 'this is very bad');

-- INSERT INTO Storage (name, city, state) Values ('Store A', 'Kelowna', 'BC');
-- INSERT INTO Storage (name, city, state) Values ('Store B', 'Vancouver', 'BC');
-- INSERT INTO Storage (name, city, state) Values ('Store C', 'Armstrong', 'BC');
-- INSERT INTO Storage (name, city, state) Values ('Store D', 'Burnaby', 'BC');
-- INSERT INTO Storage (name, city, state) Values ('Store E', 'Colwood', 'BC');
-- INSERT INTO Storage (name, city, state) Values ('Store F', 'Delta', 'BC');
-- INSERT INTO Storage (name, city, state) Values ('Store G', 'Duncan', 'BC');

-- INSERT INTO Orders(order_date,username,pid,total_number) Values ( '2017-11-23','OJ',);
-- INSERT INTO Orders(order_date,username,pid,total_number) Values ('2016-11-23');
-- INSERT INTO Orders(order_date,username,pid,total_number) Values ( '2015-11-23');
-- INSERT INTO Orders(order_date,username,pid,total_number) Values ('2014-11-23');
-- INSERT INTO Orders(order_date,username,pid,total_number) Values ('2018-10-23');
-- INSERT INTO Orders(order_date,username,pid,total_number) Values ('2018-09-23');
-- INSERT INTO Orders(order_date,username,pid,total_number) Values ('2018-08-23');
-- INSERT INTO Orders(order_date,username,pid,total_number) Values ('2018-07-23');
-- INSERT INTO Orders(order_date,username,pid,total_number) Values ('2018-11-28');
-- INSERT INTO Orders(order_date,username,pid,total_number) Values ('2018-11-23');

INSERT INTO Cart Values ('JL',2,'2018-11-23',1,599);
INSERT INTO Cart Values ('OJ',3,'2016-11-23',1,899);
INSERT INTO Cart Values ('WD',4,'2015-11-23',1,999);
INSERT INTO Cart Values ('OR',5,'2014-11-23',1,1299);
INSERT INTO Cart Values ('EA',8,'2013-11-23',1,2399);

-- INSERT INTO Shipment (order_id,shipment_Date)Values (1,'2018-11-23');
-- INSERT INTO Shipment (order_id,shipment_Date) Values (2,'2017-11-23');
-- INSERT INTO Shipment (order_id,shipment_Date) Values (3,'2016-11-23');
-- INSERT INTO Shipment (order_id,shipment_Date) Values (4, '2015-11-26');
-- INSERT INTO Shipment (order_id,shipment_Date) Values (5, '2014-11-23');
-- INSERT INTO Shipment (order_id,shipment_Date) Values (6, '2013-11-23');
-- INSERT INTO Shipment (order_id,shipment_Date) Values (7, '2018-10-23');
--
-- INSERT INTO Stores Values (1,1, 20);
-- INSERT INTO Stores Values (2,1, 20);
-- INSERT INTO Stores Values (3,1, 20);
-- INSERT INTO Stores Values (4,1, 20);
-- INSERT INTO Stores Values (5,1, 20);
-- INSERT INTO Stores Values (6,1, 20);
-- INSERT INTO Stores Values (7,1, 20);
-- INSERT INTO Stores Values (8,1, 20);
-- INSERT INTO Stores Values (10,3, 20);
-- INSERT INTO Stores Values (1,4, 20);
-- INSERT INTO Stores Values (1,5, 20);

UPDATE Product SET p_img_path = "images/Macbook_Pro.png" WHERE pid = 1;
UPDATE Product SET p_img_path = "images/8G_Ram.png" WHERE pid = 2;
UPDATE Product SET p_img_path = "images/16G_Ram.png" WHERE pid = 3;
UPDATE Product SET p_img_path = "images/LG_34UC79G.png" WHERE pid = 4;
UPDATE Product SET p_img_path = "images/iphoneX.png" WHERE pid = 5;
UPDATE Product SET p_img_path = "images/GeForce_GTX_1080ti.png" WHERE pid = 6;
UPDATE Product SET p_img_path = "images/LG_speaker.png" WHERE pid = 7;
UPDATE Product SET p_img_path = "images/Sony_TV.png" WHERE pid = 8;
UPDATE Product SET p_img_path = "images/Keyboard.png" WHERE pid = 9;
UPDATE Product SET p_img_path = "images/mouse.png" WHERE pid = 10;

UPDATE Customer SET isAdmin = 1 WHERE username = 'Admin';
-- UPDATE Customer SET userImage = "images/zelda.jpg" WHERE username = 'OJ';
-- UPDATE Customer SET userImage = "images/zelda.jpg" WHERE username = 'JL';
-- UPDATE Customer SET userImage = "images/zelda.jpg" WHERE username = 'WD';
-- UPDATE Customer SET userImage = "images/zelda.jpg" WHERE username = 'OR';
-- UPDATE Customer SET userImage = "images/zelda.jpg" WHERE username = 'EA';
