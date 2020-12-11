/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     25.11.2020 11:32:31                          */
/*==============================================================*/
drop database if exists trgovina;
create database trgovina;
use trgovina;

drop table if exists Artikel;

drop table if exists Kolicina;

drop table if exists Naročilo;

drop table if exists Uporabnik;

/*==============================================================*/
/* Table: Artikel                                               */
/*==============================================================*/
create table Artikel
(
   article_id           int not null,
   article_name         text not null,
   article_price        float not null,
   article_description  text not null,
   article_status       bool not null,
   primary key (article_id)
);

/*==============================================================*/
/* Table: Kolicina                                              */
/*==============================================================*/
create table Kolicina
(
   id_kolicina          int NOT NULL AUTO_INCREMENT,
   order_id             int not null,
   article_id           int not null,
   overal               int not null,
   primary key (id_kolicina)
);

/*==============================================================*/
/* Table: Naročilo                                              */
/*==============================================================*/
create table Naročilo
(
   order_id             int not null,
   costumer_id          int not null,
   total_price          float not null,
   order_status         int not null,
   primary key (order_id)
);

/*==============================================================*/
/* Table: Uporabnik                                             */
/*==============================================================*/
create table Uporabnik
(
   costumer_id          int not null,
   name                 text not null,
   surname              text not null,
   street               text not null,
   house_number         int not null,
   post                 text not null,
   post_number          int not null,
   email                text not null,
   password             text not null,
   role                 text not null,
   primary key (costumer_id)
);

alter table Kolicina add constraint FK_r2 foreign key (order_id)
      references Naročilo (order_id) on delete restrict on update restrict;

alter table Kolicina add constraint FK_r3 foreign key (article_id)
      references Artikel (article_id) on delete restrict on update restrict;

alter table Naročilo add constraint FK_r1 foreign key (costumer_id)
      references Uporabnik (costumer_id) on delete restrict on update restrict;
      
insert into Artikel (article_id, article_name, article_price, article_description,  article_status) values
(1, "Krajnska klobasa", 3.45, "Dimljena klobasa", TRUE),
(2, "Kekec pašteta", 1.34, "Pašteta, ki ni iz Kekca", TRUE),
(3, "Pisalo modro", 0.78, "Pisalo za pisanje - modro", FALSE),
(4, "Žemlja bela", 0.25, "Bela žemlja, velika", FALSE),
(5, "Računalnik", 794.91, "Računalnik - PC, HP", TRUE);

INSERT INTO `Uporabnik` (costumer_id, name, surname, street, house_number,post,post_number,email,password,role) VALUES

(1, 'Ivan', 'Bratko', 'Vecna pot',113,'Ljubljana',1000,'ivan@gmail.com','alala','administrator'),
(2, 'Mici', 'Luna', 'Vecna pot',115,'Ljubljana',1000,'mici@gmail.com','1234','prodajalec'),
(3, 'Jo', 'Kip', 'Vesela cesta',1,'Ljubljana',1000,'jo@gmail.com','jooo','stranka');

