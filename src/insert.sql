  INSERT INTO Customer (username,first_name,last_name,pw, email, address,city,state,zip,card_number,card_password) Values ('JL','James','Lee',MD5('James'),'jl2000@gmail.com','123 Guder Rd','Kelowna','BC','V1Z3A9','1234556778877','Lee');

  INSERT INTO Customer (username,first_name,last_name,pw, email, address,city,state,zip,card_number,card_password) Values ('OJ','Oliver','Jake',MD5('Oliver'),'oj2001@gmail.com','513 Hell Rd','Vancouver','BC','V1Z1A9','1234556353877','Jake');

  INSERT INTO Customer (username,first_name,last_name,pw, email, address,city,state,zip,card_number,card_password) Values ('WD','William','Damian',MD5('William'),'wd1999@gmail.com','582 Pandora St','Yellowknife','YK','V1Z3A3','1234553278877','Damian');

  INSERT INTO Customer (username,first_name,last_name,pw, email, address,city,state,zip,card_number,card_password) Values ('OR','Oscar','Ray',MD5('Oscar'),'or1999@gmail.com','95 Junge Rd','Missisauga','ON','V5Z3A9','1234567878877','Ray');

  INSERT INTO Customer (username,first_name,last_name,pw, email, address,city,state,zip,card_number,card_password) Values ('EA','Emily','Alice',MD5('Emily'),'ea1999@gmail.com','505 Jane Rd','Hope','BC','V3Z3A8','1234258778877','Alice');

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

INSERT INTO Storage (name, city, state) Values ('Store A', 'Kelowna', 'BC');
INSERT INTO Storage (name, city, state) Values ('Store B', 'Vancouver', 'BC');
INSERT INTO Storage (name, city, state) Values ('Store C', 'Armstrong', 'BC');
INSERT INTO Storage (name, city, state) Values ('Store D', 'Burnaby', 'BC');
INSERT INTO Storage (name, city, state) Values ('Store E', 'Colwood', 'BC');
INSERT INTO Storage (name, city, state) Values ('Store F', 'Delta', 'BC');
INSERT INTO Storage (name, city, state) Values ('Store G', 'Duncan', 'BC');

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
INSERT INTO Cart Values ('EA',8,'2013-11-23',1,1599);

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

UPDATE product SET p_img_path = "images/Macbook_Pro.PNG" WHERE pid = 1;
UPDATE product SET p_img_path = "images/8G_Ram.PNG" WHERE pid = 2;
UPDATE product SET p_img_path = "images/16G_Ram.PNG" WHERE pid = 3;
UPDATE product SET p_img_path = "images/LG_34UC79G.PNG" WHERE pid = 4;
UPDATE product SET p_img_path = "images/iphoneX.PNG" WHERE pid = 5;
UPDATE product SET p_img_path = "images/GeForce_GTX_1080ti.PNG" WHERE pid = 6;
UPDATE product SET p_img_path = "images/LG_speaker.PNG" WHERE pid = 7;
UPDATE product SET p_img_path = "images/Sony_TV.PNG" WHERE pid = 8;
UPDATE product SET p_img_path = "images/Keyboard.PNG" WHERE pid = 9;
UPDATE product SET p_img_path = "images/mouse.PNG" WHERE pid = 10;
