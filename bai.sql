-- 创建新闻表 
create table if not exists cs_news (`id` int(10) not null auto_increment,
	`title` varchar(255) not null,
	`content` varchar(255) not null,
	`time` datetime not null,
	primary key (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 创建管理员表
create table if not exists cs_admin (`id` int(10) not null auto_increment,
	`username` varchar(255) not null,
	`password` varchar(255) not null,
	primary key (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
