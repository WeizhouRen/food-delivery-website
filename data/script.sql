CREATE TABLE IF NOT EXISTS user (
    `userid` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(20),
    `password` VARCHAR(20),
    `email` VARCHAR(50),
    `phone` INT,
    `address` VARCHAR(100),
    `identity` VARCHAR(8),
    `avatar` VARCHAR(100),
    PRIMARY KEY (userid)
);
INSERT INTO user VALUES
    (1,'Amy','dummypassword','dummy@gmail.com',1234567890,'St Lucia QLD 4072','customer','http://localhost/img/avatar/default.jpg'),
    (2,'Alice','dummypassword','dummy@gmail.com',1234567890,'St Lucia QLD 4073','customer','http://localhost/img/avatar/default.jpg'),
    (3,'Bob','dummypassword','dummy@gmail.com',1234567890,'St Lucia QLD 4074','customer','http://localhost/img/avatar/default.jpg'),
    (4,'Cindy','dummypassword','dummy@gmail.com',1234567890,'St Lucia QLD 4075','customer','http://localhost/img/avatar/default.jpg'),
    (5,'David','dummypassword','dummy@gmail.com',1234567890,'St Lucia QLD 4076','customer','http://localhost/img/avatar/default.jpg'),
    (6,'Edward','dummypassword','dummy@gmail.com',1234567890,'St Lucia QLD 4077','starff','http://localhost/img/avatar/default.jpg'),
    (7,'Fold','dummypassword','dummy@gmail.com',1234567890,'St Lucia QLD 4078','starff','http://localhost/img/avatar/default.jpg'),
    (8,'Gin','dummypassword','dummy@gmail.com',1234567890,'St Lucia QLD 4079','starff','http://localhost/img/avatar/default.jpg'),
    (9,'Henry','dummypassword','dummy@gmail.com',1234567890,'St Lucia QLD 4080','starff','http://localhost/img/avatar/default.jpgpg');

CREATE TABLE IF NOT EXISTS restaurant (
    `rid` INT NOT NULL AUTO_INCREMENT,
    `rcover` VARCHAR(48),
    `rname` VARCHAR(21),
    `suburb` VARCHAR(14),
    `managerid` INT,
    `raddress` VARCHAR(66),
    `category` VARCHAR(9),
    `rphone` VARCHAR(14),
    `lat` VARCHAR(10),
    `lng` VARCHAR(10),
    PRIMARY KEY (rid),
    FOREIGN KEY (managerid) REFERENCES user (userid)
);
INSERT INTO restaurant VALUES
    (1,'http://localhost/img/restaurant/bamboobasket.jpg','Bamboo Basket','South Bank',6,'Shop 1003 – 1004, 199 Grey St, South Brisbane, Qld, 4101','Chinese','(07) 3844 0088', '-27.480641027229808', '153.02270052668283'),
    (2,'http://localhost/img/restaurant/gabbabbq.jpg','Gabba BBQ','Woolloongabba',7,'10A/803 Stanley St, Woolloongabba QLD 4102','Fast Food','(07) 3076 8630', '-27.486812399250958', '153.0354649266829'),
    (3,'http://localhost/img/restaurant/grill''d.png','Grill D','Toowong',8,'Toowong Village, Shop G44/9 Sherwood Rd, Toowong QLD 4066','Healthy','(07) 3371 0333', '-27.484908664504637', '152.99263538066398'),
    (4,'http://localhost/img/restaurant/guzmanygomez.jpg','Guzman y Gomez','St Lucia',9,'Level 4 Building 21, St Lucia QLD 4067','Fast Food','(07) 3188 1725', '-27.497263513700915', '153.0154865266831'),
    (5,'http://localhost/img/restaurant/leelathai.jpg','Leela Thai','Woolloongabba',6,'5a/14 Annerley Rd, Woolloongabba QLD 4102','Healthy','(07) 3217 4388', '-27.4868797222387', '153.02953182668293'),
    (6,'http://localhost/img/restaurant/macdonald.jpg','MacDonald','Brisbane City',7,'130 Queen St, Brisbane City QLD 4000','Fast Food','(07) 3012 8587', '-27.469437498358843', '153.02493804202223'),
    (7,'http://localhost/img/restaurant/subway.jpg','Subway','Brisbane City',8,'shop 1/120 Edward St, Brisbane City QLD 4000','Fast Food','(07) 3211 7481', '-27.46992411837596', '153.02823734017792'),
    (8,'http://localhost/img/restaurant/suki.jpg','SUKI - Poke'' Bowls','South Brisbane',9,'182 Grey St, South Brisbane QLD 4101','Healthy','0422 858 614', '-27.479641287646633', '153.02280664017803'),
    (9,'http://localhost/img/restaurant/trang.jpg','Trang Restaurant','West End',6,'2/59 Hardgrave Rd, West End QLD 4101','Chinese','(07) 3255 1610', '-27.481823992355583', '153.0069687438668'),
    (10,'http://localhost/img/restaurant/phatelephant.jpg','Phat Elephant','Brisbane City',7,'Post Office Square, shop 7/215 Adelaide St, Brisbane City QLD 4000','Healthy','(07) 3236 4454', '-27.467099736064192', '153.02707694017784'),
    (11,'http://localhost/img/restaurant/blackfire.png','Black Fire Restaurant','Brisbane City',8,'74 Albert St, Brisbane City QLD 4000','Healthy','(07) 3013 0058', '-27.472161365098852', '153.0275222690129'),
    (12,'http://localhost/img/restaurant/fatnoodle.png','Fat Noodle','Brisbane City',9,'1, Treasury Casino, George St & Queen St, Brisbane City QLD 4000','Chinese','(07) 3306 8888','-27.471455725674975', '153.02367477085716');


CREATE TABLE IF NOT EXISTS dishes (
    `did` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(20),
    `rid` INT,
    `price` NUMERIC(4, 2),
    `photo` VARCHAR(50),
    `description` VARCHAR(100)
);
INSERT INTO dishes VALUES
    (1,'Dish1',6,10.00,'http://localhost/img/dishes/McDonald1.jpg','Dummy Description… Placeholder blablabla'),
    (2,'Dish2',6,11.50,'http://localhost/img/dishes/McDonald2.jpg','Dummy Description… Placeholder blablabla'),
    (3,'Dish3',6,13.00,'http://localhost/img/dishes/McDonald3.jpg','Dummy Description… Placeholder blablabla'),
    (4,'Dish4',6,12.50,'http://localhost/img/dishes/McDonald5.jpg','Dummy Description… Placeholder blablabla'),
    (5,'Dish1',7,7.60,'http://localhost/img/dishes/subway1.jpg','Dummy Description… Placeholder blablabla'),
    (6,'Dish2',7,6.60,'http://localhost/img/dishes/subway2.jpg','Dummy Description… Placeholder blablabla'),
    (7,'Dish3',7,7.60,'http://localhost/img/dishes/subway3.jpg','Dummy Description… Placeholder blablabla'),
    (8,'Dish4',7,6.60,'http://localhost/img/dishes/subway4.jpg','Dummy Description… Placeholder blablablaceholder blablabla');


CREATE TABLE IF NOT EXISTS comments (
    `cid` INT NOT NULL AUTO_INCREMENT,
    `rid` INT,
    `text` VARCHAR(5),
    `date` varchar(20),
    `userid` INT,
    `username` VARCHAR(6),
    `rate` NUMERIC(2, 1),
    PRIMARY KEY (cid),
    FOREIGN KEY (rid) REFERENCES restaurant (rid),
    FOREIGN KEY (userid) REFERENCES user (userid)
);
INSERT INTO comments VALUES
    (1,1,'Good','2019-04-30',1,'Amy',4.5),
    (2,2,'Good','2019-05-01',2,'Alice',5),
    (3,3,'Good','2019-05-02',3,'Bob',3.5),
    (4,4,'Good','2019-05-03',4,'Cindy',2.5),
    (5,5,'Good','2019-05-04',5,'David',3),
    (6,6,'Good','2019-05-05',6,'Edward',4.5),
    (7,7,'Good','2019-05-06',7,'Fold',5),
    (8,8,'Good','2019-05-07',8,'Gin',4.5),
    (9,9,'Good','2019-05-08',9,'Henry',5),
    (10,10,'Great','2019-05-09',1,'Amy',3.5),
    (11,11,'Great','2019-05-10,2,'Alice',2.5),
    (12,12,'Great','2019-05-11,3,'Bob',3),
    (13,1,'Great','2019-05-12',4,'Cindy',4.5),
    (14,2,'Great','2019-05-13',5,'David',5),
    (15,3,'Great','2019-05-14',6,'Edward',4.5),
    (16,4,'Great','2019-05-15',7,'Fold',5),
    (17,5,'Great','2019-05-16',8,'Gin',3.5),
    (18,6,'Great','2019-05-17',9,'Henry',2.5),
    (19,7,'Great','2019-05-18',1,'Amy',3);


CREATE TABLE orders (
    orderid int not null auto_increment,
    userid int (11) not null,
    did int(11) not null,
    phone int(10),
    `address` text,
    ordernumber varchar(20),
    `status` varchar(20),
    primary key (orderid),
    foreign key (userid) references `user` (userid),
    foreign key (did) references dishes(did)
);

CREATE TABLE cart (
    cid int(11) not null auto_increment,
    userid int(11),
    did int(11),
    qty int(2),
    primary key (cid),
    foreign key (userid) references user (userid),
    foreign key (did) references dishes (did)
);