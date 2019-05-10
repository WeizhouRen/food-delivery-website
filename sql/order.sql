CREATE TABLE orders (
    orderid int not null auto_increment,
    userid int (11) not null,
    did int(11) not null,
    primary key (orderid),
    foreign key (userid) references user (userid),
    foreign key (did) references dishes(did)
);