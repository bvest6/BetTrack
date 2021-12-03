CREATE DATABASE BetTrack;
USE BetTrack;
DROP TABLE IF EXISTS wallettype;
Create table wallettype
(
ID int, definedtype varchar(20) primary key
);
DROP TABLE IF EXISTS user;
Create table user
(
ID int auto_increment PRIMARY KEY, username varchar(50) NOT NULL, password varchar(50) NOT NULL, email varchar(255) UNIQUE NOT NULL
);
DROP TABLE IF EXISTS wallets;
Create table wallets
(
walname varchar(50) NOT NULL, owner int NOT NULL, type varchar(20), balance float, primary key(walname,owner), foreign key(type) references wallettype(definedtype), foreign key(owner) references user(ID)
);
DROP TABLE IF EXISTS rooms;
Create table rooms
(
RMID int primary key NOT NULL, poolamt float, bet varchar(255), actual varchar(255)
);
DROP TABLE IF EXISTS results;
Create table results
(
RESID int primary key auto_increment, RMID int, expected varchar(255), wallet varchar(50) NOT NULL, amt float, eval int, CHECK(eval != 0 or eval != 1), foreign key(RMID) references rooms(RMID), foreign key(wallet) references wallets(walname)
);

INSERT INTO wallettype (ID, definedtype) VALUES (1,'Saving');
INSERT INTO wallettype (ID, definedtype) VALUES (2,'Spending');
INSERT INTO wallettype (ID, definedtype) VALUES (3,'General');

INSERT INTO user (username, password, email) VALUES ('BenVest','cf4d83bd1d5a9ced66f9b4f277c9716d3ec117eb', 'benvest@gmail.com');

INSERT INTO rooms (RMID, bet) VALUES (50,"Jets v Trucks");
INSERT INTO rooms (RMID, bet) VALUES (6409,"Heads or Tails");

COMMIT;