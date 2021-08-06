mysql> create database filemanagementsystem;
Query OK, 1 row affected (0.01 sec)

mysql> use filemanagementsystem;
Database changed

mysql> create table auth (
    ->     id int NOT NULL AUTO_INCREMENT,
    ->     name varchar(100) NOT NULL,
    ->     email varchar(100) NOT NULL UNIQUE,
    ->     password varchar(100) NOT NULL,
    ->     PRIMARY KEY(id)
    -> );
Query OK, 0 rows affected (0.03 sec)

mysql> alter table auth AUTO_INCREMENT=1000;
Query OK, 0 rows affected (0.03 sec)
Records: 0  Duplicates: 0  Warnings: 0

mysql> create table files (
    ->     id int NOT NULL AUTO_INCREMENT,
    ->     name varchar(100) NOT NULL,
    ->     content varchar(5120),
    ->     createdOn datetime NOT NULL,
    ->     createdBy int NOT NULL,
    ->     PRIMARY KEY(id),
    ->     FOREIGN KEY(createdBy) REFERENCES auth(id),
    ->     CONSTRAINT unique_name UNIQUE (name, createdBy)
    -> );
Query OK, 0 rows affected (0.05 sec)

mysql> alter table files AUTO_INCREMENT=1000;
Query OK, 0 rows affected (0.02 sec)
Records: 0  Duplicates: 0  Warnings: 0