drop database if exists TellMe; #ece:Coder Exchage Camp
create database if not exists TellMe;
use TellMe;

#service(业务)层
	#  User  Ask  Answer Note Tag
#Model层
   #	自动校验 自动完成  表之间的关系

set names utf8;
create table if not exists t_user(
	id int primary key auto_increment,
	username varchar(32) not null unique,
	password varchar(32),
	status int default 1 comment '是否激活此用户'
)default charset utf8 ENGINE = MYISAM;

insert into t_user(username,password)values
('hj',123),('dd',123),('zx',123),('djh',123),('dyc',123),('lgg',123),('jdz',123),('hp',123);

#时间类型：timestamp datetime varchar int
create table if not exists t_userInfo(
	id int unique,
	nickname varchar(64) comment '昵称',
	age int(3),
	url varchar(64) comment '头像',
	website varchar(255) comment '个人(blog)主页地址',
	location varchar(255) comment '住址',
	regDate datetime comment '注册日期',
	lastLoginTime datetime comment '最近登录时间',
	reputation int default 0 comment '声望值',
	viewcount int comment '浏览量',
	profile text comment '人物简介'
);

insert into t_userInfo(id,nickname,age,url,website,location,regDate,lastLoginTime,viewcount,profile)values
(1,'HJ',20,'1.jpg','hj.blog.com','GXQ',now(),now(),48,'i am hj'),
(2,'DD',20,'1.jpg','dd.blog.com','GXQ',now(),now(),48,'i am dd'),
(3,'ZX',20,'1.jpg','zx.blog.com','GXQ',now(),now(),48,'i am zx'),
(4,'DJH',20,'1.jpg','djh.blog.com','GXQ',now(),now(),48,'i am djh'),
(5,'DYC',20,'1.jpg','dyc.blog.com','GXQ',now(),now(),48,'i am dyc'),
(6,'LGG',20,'1.jpg','lgg.blog.com','GXQ',now(),now(),48,'i am lgg'),
(7,'JDZ',20,'1.jpg','jdz.blog.com','GXQ',now(),now(),48,'i am jdz'),
(8,'HP',20,'1.jpg','hp.blog.com','GXQ',now(),now(),48,'i am hp');

#适当的添加冗余字段,使得查询效率提高
create table if not exists t_ask(
	id int primary key auto_increment,
	title varchar(255) not null,
	content text not null,
	publishTime datetime comment '发布时间',
	answerTime datetime comment '最近回复时间',
	editTime timestamp default current_timestamp on update current_timestamp ,#'自己再次编辑的时间(自动触发)'
	zan int,
	cai int,
	viewcount int comment '浏览量',
	asktype int default 0 comment '问题类型(悬赏与否) 0 1',
	bounty int default 0,
	endTime datetime default null comment '悬赏结束时间',
	remark text default null comment '悬赏备注',
	uid int comment '提问者',
	adoptid int comment '被采纳的回答者'
);

insert into t_ask(title,content,publishTime,answerTime,zan,cai,viewcount,uid,adoptid)values
('HTML','what is html?','2016-6-1 14:22:33','2016-6-1 22:22:33',100,20,500,1,2),
('JS','what is js?','2016-6-2 14:22:33','2016-6-1 22:22:33',10,0,700,2,3),
('PHP','what is php?','2016-6-3 14:22:33','2016-6-1 22:22:33',90,30,800,3,4),
('CSS','what is css?','2016-6-3 14:22:00','2016-6-1 22:22:33',50,60,900,4,1);

#他人再编辑
create table if not exists t_askRedit(
	id int primary key auto_increment,
	uid int,#编辑人id
	aid int,
	edittime datetime,#他人再次编辑的时间
	aftercontent text,
	isAccept int default 0 comment '编辑后是否被发布人接受'
);
insert into t_askRedit(uid,aid,edittime,aftercontent)values
(1,2,'2016-6-7 11:22:00','what can js do?'),
(2,3,'2016-6-7 11:22:00','what can php do?'),
(3,4,'2016-6-7 11:22:00','what can css do?'),
(4,1,'2016-6-7 11:22:00','what can html do?');

#问题备注表
create table if not exists t_askNote(
	id int primary key auto_increment,
	content text,
	publishtime varchar(16),
	uid int,#anyone
	aid int	
);
	
insert into t_askNote(content,publishtime,uid,aid)values
('clearly please!','2016-6-9 18:20:00',2,1),
('clearly please!','2016-6-10 18:20:00',3,2),
('clearly please!','2016-6-19 18:20:00',4,3),
('clearly please!','2016-6-12 18:20:00',1,4);

#回复
create table if not exists t_answer(
	id int primary key auto_increment,
	content text,
	publishTime datetime comment '发布时间',
	zan int default 0,
	cai int default 0,
	uid int,#回复者
	aid int
);
insert into t_answer(content,publishTime,zan,cai,uid,aid)values
('html is sb you know!','2016-6-13 18:20:00',23,12,2,1),#dd->ask1
('js is sb you know!','2016-6-19 18:20:00',23,12,3,2),#zx->ask2
('php is sb you know!','2016-6-14 18:20:00',23,12,4,3),#djh->ask3
('html is sb you know!','2016-6-15 18:20:00',23,12,1,4);#hj->ask4

#回复备注
create table if not exists t_answerNote(
	id int primary key auto_increment,
	content text,
	publishtime varchar(32),
	uid int,#回复者
	answerid int,
	showname int default 1 comment '是否匿名'
);

insert into t_answerNote(content,publishtime,uid,answerid)values
('sb?I dont no! plase tell me','2016-6-14 20:20:00',3,1),#zx->answer-1
('sb?I dont no! plase tell me','2016-6-20 20:20:00',4,2),#djh->answer-2
('sb?I dont no! plase tell me','2016-6-15 20:20:00',1,3),#hj->answer-3
('sb?I dont no! plase tell me','2016-6-16 20:20:00',2,4);#dd->answer-4

#用户zan/cai问题
#1 3
#1 3
create table if not exists t_ask_opt(
	uid int,
	askid int,
	votetime datetime,#方便月日 zan/cai统计--dongdong
	primary key(uid,askid) comment '避免当前用户对同一个问题多次赞踩'
);

insert into t_ask_opt(uid,askid,votetime)values
(1,2,'2016-6-16 20:20:00'),
(2,3,'2016-6-16 20:20:00'),
(3,1,'2016-6-16 20:20:00'),
(4,4,'2016-6-16 20:20:00');

#1 3 2 
#1 3 5
#用户zan/cai回复
create table if not exists t_ans_opt(
	uid int,
	askid int,
	answerid int,
	votetime datetime,
	primary key(uid,askid)
);

insert into t_ans_opt(uid,askid,answerid,votetime)values
(1,2,1,'2016-6-14 20:25:00'),
(2,3,2,'2016-6-13 15:10:00'),
(3,1,4,'2016-6-16 12:23:00'),
(4,4,3,'2016-6-13 23:20:00');

#标签
create table if not exists t_tag(
	id int primary key auto_increment,
	tagname varchar(32) unique,
	tagdesc text,
	uid int default null comment '由某用户创建',
	createTime datetime
);

insert into t_tag(tagname,tagdesc,uid,createTime)values
('c','I am c langue',1,'2016-3-1 23:20:00'),
('c#','I am c# langue',1,'2016-3-1 23:20:00'),
('js','I am js langue',1,'2016-3-1 23:20:00'),
('java','I am java langue',1,'2016-3-1 23:20:00'),
('css','I am css langue',1,'2016-3-1 23:20:00'),
('php','I am php langue',1,'2016-3-1 23:20:00'),
('html','I am html langue',1,'2016-3-1 23:20:00');
#问题 标签 中间表
create table if not exists t_ask_tag(
	id int primary key auto_increment,
	askid int,
	tagid int
);

insert into t_ask_tag(askid,tagid)values(1,7),(2,3),(3,6),(4,5);

#支持内存缓存第三方插件
#memcached服务器  set、get、clear
#命中率 
#memcached内存缓存

#动态权限
create table if not exists t_rights(
	id int primary key auto_increment,
	rightsName varchar(32),#操作名绑定
	rightsDesc varchar(255),
	grade int comment '对应的声望分数(至少)'
);
insert into t_rights(rightsName,rightsDesc,grade)values
('createTag','you can create some tags.',5),
('editAsk','you can change others question',10),
('editAskValid','you can change others question and effect right now',15),
('cai','you can cai for question and answers',2);
#徽章
create table if not exists t_badge(
	id int primary key auto_increment,
	name varchar(32),
	badgeType int(1),#1，2，3
	badgeDesc varchar(255),
	url varchar(32),#金银铜图片
	con text,#???
	action varchar(32) #操作名绑定？
);

insert into t_badge(name,badgeType,badgeDesc,url,con,action) values
('niceAsk',3,'you have asked a nice question','3.jpg','','publishQuestion'),
('greatAsk',2,'you have asked a nice question','3.jpg','','publishQuestion'),
('bestAsk',1,'you have asked a nice question','3.jpg','','publishQuestion'),
('niceAnsw',3,'you have asked a nice question','3.jpg','','publishQuestion'),
('greatAnsw',2,'you have asked a nice question','3.jpg','','publishQuestion'),
('bestAnsw',1,'you have asked a nice question','3.jpg','','publishQuestion'),
('niceVote',3,'one of your ask or answer has zaned by others morethan 50 times.','3.jpg','','publishQuestion'),
('greatVote',2,'one of your ask or answer has zaned by others morethan 100 times.','3.jpg','','publishQuestion'),
('bestVote',1,'one of your ask or answer has zaned by others morethan 200 times.','3.jpg','','publishQuestion');

#关于‘问题  回答  投票’三个方面的徽章类
#class NiceAnswer(
#	private $id = 1;
#	function niceAnswer(){
#		
#	}
#)

create table if not exists t_user_badge(
	id int primary key auto_increment,
	uid int,
	bid int
);
insert into t_user_badge(uid,bid) values
(1,1),(1,2),(1,3),(1,4),
(2,7),(2,6),(2,5),(2,4),
(3,8),(3,7),(3,6),(3,4),
(4,9),(4,8),(4,7),(4,6),(4,5),(4,4),(4,3),(4,2),(4,1);

#初始化数据  权限  默认标记  勋章 





