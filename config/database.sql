CREATE DATABASE shop_master;
USE shop_master;

CREATE TABLE users(
id              int(255) auto_increment not null,
name          varchar(100) not null,
email           varchar(255) not null,
password        varchar(255) not null,
role             varchar(20),
image          varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)  
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'Admin', 'Admin', 'admin@admin.com', 'password', 'admin', null);

CREATE TABLE categories(
id              int(255) auto_increment not null,
name          varchar(100) not null,
CONSTRAINT pk_categories PRIMARY KEY(id) 
)ENGINE=InnoDb;

INSERT INTO categories VALUES(null, 'Short sleeve');
INSERT INTO categories VALUES(null, 'Suspenders');
INSERT INTO categories VALUES(null, 'Long sleeve');
INSERT INTO categories VALUES(null, 'Sweatshirts');

CREATE TABLE products(
id              int(255) auto_increment not null,
category_id    int(255) not null,
name          varchar(100) not null,
description     text,
price          float(100,2) not null,
stock           int(255) not null,
offer          varchar(2),
date           date not null,
image          varchar(255),
CONSTRAINT pk_categories PRIMARY KEY(id),
CONSTRAINT fk_product_category FOREIGN KEY(category_id) REFERENCES categories(id)
)ENGINE=InnoDb;


CREATE TABLE requests(
id              int(255) auto_increment not null,
user_id      int(255) not null,
province       varchar(100) not null,
location       varchar(100) not null,
direction       varchar(255) not null,
cost           float(200,2) not null,
condition          varchar(20) not null,
date           date,
hour            time,
CONSTRAINT pk_requests PRIMARY KEY(id),
CONSTRAINT fk_request_user FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;

CREATE TABLE lines_requests(
id              int(255) auto_increment not null,
request_id       int(255) not null,
product_id     int(255) not null,
units        int(255) not null,
CONSTRAINT pk_lines_requests PRIMARY KEY(id),
CONSTRAINT fk_line_request FOREIGN KEY(request_id) REFERENCES requests(id),
CONSTRAINT fk_line_product FOREIGN KEY(product_id) REFERENCES products(id)
)ENGINE=InnoDb;
