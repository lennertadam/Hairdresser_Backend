INSERT INTO reservations(start_time,end_time,price,barber_id,customer_id,active,status)
VALUES
("2030-01-01 00:00:01","2030-01-01 00:23:59",1000.0,1,3,true,"upcoming"),
("1999-01-01 00:00:01","1999-01-01 00:23:59",5000.0,2,3,false,"complete"),
("2004-01-01 00:00:01","2004-01-01 00:23:59",300.0,4,3,false,"cancelled"),
("1865-01-01 00:00:01","1995-01-01 00:23:59",10.0,5,3,false,"invalid");