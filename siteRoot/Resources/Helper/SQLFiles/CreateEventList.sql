
CREATE TABLE EventList
(
    EventID int identity(1,1) not null,
    eventName varchar(25) not null, 
    eventDesc varchar(250) not null,
    priceURL varchar(50) not null,
    imageLink varchar(50) not null,
    Region varchar(25) not null,
);
