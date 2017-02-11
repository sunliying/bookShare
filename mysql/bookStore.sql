/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     2016/12/30 0:39:47                           */
/*==============================================================*/


drop table if exists book;

drop table if exists user;

/*==============================================================*/
/* Table: book                                                  */
/*==============================================================*/
create table book
(
   bname                varchar(30),
   bid                  varchar(12) not null,
   author               varchar(20),
   classfication        varchar(60),
   bdesc                varchar(500),
   sid                  varchar(12),
   primary key (bid)
);

/*==============================================================*/
/* Table: user                                                  */
/*==============================================================*/
create table user
(
   name                 varchar(20),
   age                  int,
   gender               varchar(10),
   major                varchar(30),
   sid                  varchar(12) not null,
   grade                varchar(6),
   qq                   varchar(12),
   phone                varchar(11),
   password             varchar(30),
   regdate              varchar(16),
   primary key (sid)
);

alter table book add constraint FK_Reference_1 foreign key (sid)
      references user (sid) on delete restrict on update restrict;

