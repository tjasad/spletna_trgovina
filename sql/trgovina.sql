/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     19.11.2020 22:41:36                          */
/*==============================================================*/


drop table if exists Artikel;

drop table if exists Naročilo;

drop table if exists Uporabnik;

drop table if exists Vloga;

drop table if exists sestavlja;

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
/* Table: Naročilo                                              */
/*==============================================================*/
create table Naročilo
(
   order_id             int not null,
   costumer_id          int not null,
   articles             text not null,
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
   vloga_id             int not null,
   name                 text not null,
   surname              text not null,
   street               text not null,
   house_number         int not null,
   post                 text not null,
   post_number          int not null,
   email                text not null,
   geslo                text not null,
   primary key (costumer_id)
);

/*==============================================================*/
/* Table: Vloga                                                 */
/*==============================================================*/
create table Vloga
(
   vloga_id             int not null,
   ime_vloge            text not null,
   primary key (vloga_id)
);

/*==============================================================*/
/* Table: sestavlja                                             */
/*==============================================================*/
create table sestavlja
(
   article_id           int not null,
   order_id             int not null,
   primary key (article_id, order_id)
);

alter table Naročilo add constraint FK_odda foreign key (costumer_id)
      references Uporabnik (costumer_id) on delete restrict on update restrict;

alter table Uporabnik add constraint FK_ima foreign key (vloga_id)
      references Vloga (vloga_id) on delete restrict on update restrict;

alter table sestavlja add constraint FK_sestavlja foreign key (article_id)
      references Artikel (article_id) on delete restrict on update restrict;

alter table sestavlja add constraint FK_sestavlja foreign key (order_id)
      references Naročilo (order_id) on delete restrict on update restrict;

