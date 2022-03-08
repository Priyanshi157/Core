create schema IF NOT EXISTS `ecommerce`;

create table `ecommerce`.`category`(
	`cat_id` int not null primary key,
    `cat_name` varchar(24) not null,
    `parent_id` int not null,
    primary key(`cat_id`));
    
create table `ecommerce`.`product`(
	`pro_id` int not null,
    `pro_name` varchar(64),
    `cat_id` int not null,
    `price` int not null,
    primary key(`pro_id`) , 
	foreign key (cat_id) references category(cat_id));

create table `ecommerce`.`customer`(
	`cus_id` int not null,
    `cus_name` varchar(32) not null,
    `email` varchar(32) not null,
    `mobile_number` int(10),
    primary key(cus_id)
    );
    
create table `ecommerce`.`address`(
	`address_id` int not null,
    `address` varchar(128) not null,
    `cus_id` int not null,
    primary key(address_id),
    foreign key (cus_id) references customer(cus_id)
    );

create table `ecommerce`.`orders`(
`order_id` int not null,
`cus_id` int not null,
`pro_id` int not null,
`address_id` int not null,
`quantity` int not null,
`total` decimal(8,3),
primary key(order_id),
foreign key (cus_id) references customer(cus_id),
foreign key (pro_id) references product(pro_id),
foreign key (address_id) references address(address_id)
);