# ************************************************************
# Sequel Pro SQL dump
# Version 4529
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.24)
# Database: food_laravel
# Generation Time: 2019-07-15 06:03:17 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table icons
# ------------------------------------------------------------

DROP TABLE IF EXISTS `icons`;

CREATE TABLE `icons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unicode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'unicode 字符',
  `class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '类名',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '名称',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `icons` WRITE;
/*!40000 ALTER TABLE `icons` DISABLE KEYS */;

INSERT INTO `icons` (`id`, `unicode`, `class`, `name`, `sort`, `created_at`, `updated_at`)
VALUES
	(1,'&#xe6c9;','layui-icon-rate-half','半星',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(2,'&#xe67b;','layui-icon-rate','星星-空心',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(3,'&#xe67a;','layui-icon-rate-solid','星星-实心',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(4,'&#xe678;','layui-icon-cellphone','手机',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(5,'&#xe679;','layui-icon-vercode','验证码',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(6,'&#xe677;','layui-icon-login-wechat','微信',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(7,'&#xe676;','layui-icon-login-qq','QQ',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(8,'&#xe675;','layui-icon-login-weibo','微博',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(9,'&#xe673;','layui-icon-password','密码',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(10,'&#xe66f;','layui-icon-username','用户名',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(11,'&#xe9aa;','layui-icon-refresh-3','刷新-粗',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(12,'&#xe672;','layui-icon-auz','授权',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(13,'&#xe66b;','layui-icon-spread-left','左向右伸缩菜单',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(14,'&#xe668;','layui-icon-shrink-right','右向左伸缩菜单',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(15,'&#xe6b1;','layui-icon-snowflake','雪花',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(16,'&#xe702;','layui-icon-tips','提示说明',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(17,'&#xe66e;','layui-icon-note','便签',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(18,'&#xe68e;','layui-icon-home','主页',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(19,'&#xe674;','layui-icon-senior','高级',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(20,'&#xe669;','layui-icon-refresh','刷新',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(21,'&#xe666;','layui-icon-refresh-1','刷新',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(22,'&#xe66c;','layui-icon-flag','旗帜',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(23,'&#xe66a;','layui-icon-theme','主题',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(24,'&#xe667;','layui-icon-notice','消息-通知',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(25,'&#xe7ae;','layui-icon-website','网站',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(26,'&#xe665;','layui-icon-console','控制台',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(27,'&#xe664;','layui-icon-face-surprised','表情-惊讶',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(28,'&#xe716;','layui-icon-set','设置-空心',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(29,'&#xe656;','layui-icon-template-1','模板',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(30,'&#xe653;','layui-icon-app','应用',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(31,'&#xe663;','layui-icon-template','模板',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(32,'&#xe6c6;','layui-icon-praise','赞',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(33,'&#xe6c5;','layui-icon-tread','踩',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(34,'&#xe662;','layui-icon-male','男',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(35,'&#xe661;','layui-icon-female','女',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(36,'&#xe660;','layui-icon-camera','相机-空心',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(37,'&#xe65d;','layui-icon-camera-fill','相机-实心',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(38,'&#xe65f;','layui-icon-more','菜单-水平',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(39,'&#xe671;','layui-icon-more-vertical','菜单-垂直',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(40,'&#xe65e;','layui-icon-rmb','金额-人民币',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(41,'&#xe659;','layui-icon-dollar','金额-美元',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(42,'&#xe735;','layui-icon-diamond','钻石-等级',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(43,'&#xe756;','layui-icon-fire','火',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(44,'&#xe65c;','layui-icon-return','返回',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(45,'&#xe715;','layui-icon-location','位置-地图',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(46,'&#xe705;','layui-icon-read','办公-阅读',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(47,'&#xe6b2;','layui-icon-survey','调查',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(48,'&#xe6af;','layui-icon-face-smile','表情-微笑',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(49,'&#xe69c;','layui-icon-face-cry','表情-哭泣',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(50,'&#xe698;','layui-icon-cart-simple','购物车',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(51,'&#xe657;','layui-icon-cart','购物车',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(52,'&#xe65b;','layui-icon-next','下一页',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(53,'&#xe65a;','layui-icon-prev','上一页',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(54,'&#xe681;','layui-icon-upload-drag','上传-空心-拖拽',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(55,'&#xe67c;','layui-icon-upload','上传-实心',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(56,'&#xe601;','layui-icon-download-circle','下载-圆圈',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(57,'&#xe857;','layui-icon-component','组件',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(58,'&#xe655;','layui-icon-file-b','文件-粗',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(59,'&#xe770;','layui-icon-user','用户',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(60,'&#xe670;','layui-icon-find-fill','发现-实心',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(61,'&#xe63d;','layui-icon-loading','loading',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(62,'&#xe63e;','layui-icon-loading-1','loading',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(63,'&#xe654;','layui-icon-add-1','添加',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(64,'&#xe652;','layui-icon-play','播放',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(65,'&#xe651;','layui-icon-pause','暂停',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(66,'&#xe6fc;','layui-icon-headset','音频-耳机',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(67,'&#xe6ed;','layui-icon-video','视频',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(68,'&#xe688;','layui-icon-voice','语音-声音',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(69,'&#xe645;','layui-icon-speaker','消息-通知-喇叭',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(70,'&#xe64f;','layui-icon-fonts-del','删除线',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(71,'&#xe64e;','layui-icon-fonts-code','代码',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(72,'&#xe64b;','layui-icon-fonts-html','HTML',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(73,'&#xe62b;','layui-icon-fonts-strong','字体加粗',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(74,'&#xe64d;','layui-icon-unlink','删除链接',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(75,'&#xe64a;','layui-icon-picture','图片',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(76,'&#xe64c;','layui-icon-link','链接',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(77,'&#xe650;','layui-icon-face-smile-b','表情-笑-粗',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(78,'&#xe649;','layui-icon-align-left','左对齐',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(79,'&#xe648;','layui-icon-align-right','右对齐',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(80,'&#xe647;','layui-icon-align-center','居中对齐',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(81,'&#xe646;','layui-icon-fonts-u','字体-下划线',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(82,'&#xe644;','layui-icon-fonts-i','字体-斜体',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(83,'&#xe62a;','layui-icon-tabs','Tabs 选项卡',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(84,'&#xe643;','layui-icon-radio','单选框-选中',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(85,'&#xe63f;','layui-icon-circle','单选框-候选',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(86,'&#xe642;','layui-icon-edit','编辑',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(87,'&#xe641;','layui-icon-share','分享',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(88,'&#xe640;','layui-icon-delete','删除',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(89,'&#xe63c;','layui-icon-form','表单',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(90,'&#xe63b;','layui-icon-cellphone-fine','手机-细体',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(91,'&#xe63a;','layui-icon-dialogue','聊天 对话 沟通',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(92,'&#xe639;','layui-icon-fonts-clear','文字格式化',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(93,'&#xe638;','layui-icon-layer','窗口',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(94,'&#xe637;','layui-icon-date','日期',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(95,'&#xe636;','layui-icon-water','水 下雨',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(96,'&#xe635;','layui-icon-code-circle','代码-圆圈',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(97,'&#xe634;','layui-icon-carousel','轮播组图',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(98,'&#xe633;','layui-icon-prev-circle','翻页',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(99,'&#xe632;','layui-icon-layouts','布局',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(100,'&#xe631;','layui-icon-util','工具',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(101,'&#xe630;','layui-icon-templeate-1','选择模板',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(102,'&#xe62f;','layui-icon-upload-circle','上传-圆圈',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(103,'&#xe62e;','layui-icon-tree','树',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(104,'&#xe62d;','layui-icon-table','表格',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(105,'&#xe62c;','layui-icon-chart','图表',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(106,'&#xe629;','layui-icon-chart-screen','图标 报表 屏幕',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(107,'&#xe628;','layui-icon-engine','引擎',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(108,'&#xe625;','layui-icon-triangle-d','下三角',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(109,'&#xe623;','layui-icon-triangle-r','右三角',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(110,'&#xe621;','layui-icon-file','文件',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(111,'&#xe620;','layui-icon-set-sm','设置-小型',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(112,'&#xe61f;','layui-icon-add-circle','添加-圆圈',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(113,'&#xe61c;','layui-icon-404','404',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(114,'&#xe60b;','layui-icon-about','关于',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(115,'&#xe619;','layui-icon-up','箭头 向上',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(116,'&#xe61a;','layui-icon-down','箭头 向下',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(117,'&#xe603;','layui-icon-left','箭头 向左',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(118,'&#xe602;','layui-icon-right','箭头 向右',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(119,'&#xe617;','layui-icon-circle-dot','圆点',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(120,'&#xe615;','layui-icon-search','搜索',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(121,'&#xe614;','layui-icon-set-fill','设置-实心',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(122,'&#xe613;','layui-icon-group','群组',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(123,'&#xe612;','layui-icon-friends','好友',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(124,'&#xe611;','layui-icon-reply-fill','回复 评论 实心',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(125,'&#xe60f;','layui-icon-menu-fill','菜单 隐身 实心',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(126,'&#xe60e;','layui-icon-log','记录',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(127,'&#xe60d;','layui-icon-picture-fine','图片-细体',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(128,'&#xe60c;','layui-icon-face-smile-fine','表情-笑-细体',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(129,'&#xe60a;','layui-icon-list','列表',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(130,'&#xe609;','layui-icon-release','发布 纸飞机',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(131,'&#xe605;','layui-icon-ok','对 OK',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(132,'&#xe607;','layui-icon-help','帮助',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(133,'&#xe606;','layui-icon-chat','客服',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(134,'&#xe604;','layui-icon-top','top 置顶',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(135,'&#xe600;','layui-icon-star','收藏-空心',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(136,'&#xe658;','layui-icon-star-fill','收藏-实心',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(137,'&#x1007;','layui-icon-close-fill','关闭-实心',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(138,'&#x1006;','layui-icon-close','关闭-空心',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(139,'&#x1005;','layui-icon-ok-circle','正确',0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(140,'&#xe608;','layui-icon-add-circle-fine','添加-圆圈-细体',0,'2019-04-25 15:26:01','2019-04-25 15:26:01');

/*!40000 ALTER TABLE `icons` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '权限名称',
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web' COMMENT '入口管理',
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '显示名称',
  `route` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '路由名称',
  `icon_id` int(11) DEFAULT NULL COMMENT '图标ID',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='权限管理';

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `display_name`, `route`, `icon_id`, `parent_id`, `sort`, `created_at`, `updated_at`)
VALUES
	(1,'system.manage','web','系统管理','',100,0,0,'2019-04-25 15:26:00','2019-04-25 15:26:00'),
	(2,'system.user','web','用户管理','admin.user.list',NULL,1,0,'2019-04-25 15:26:01','2019-04-28 19:36:35'),
	(3,'system.user.store','web','添加用户','admin.user.store',NULL,2,0,'2019-04-25 15:26:01','2019-04-28 21:04:40'),
	(4,'system.user.edit','web','编辑用户','admin.user.store',NULL,2,0,'2019-04-25 15:26:01','2019-04-28 21:00:51'),
	(5,'system.user.destroy','web','删除用户','admin.user.del',NULL,2,0,'2019-04-25 15:26:01','2019-04-28 21:00:32'),
	(8,'system.role','web','角色管理','admin.role.list',NULL,1,0,'2019-04-25 15:26:01','2019-04-28 19:36:51'),
	(9,'system.role.create','web','添加角色','admin.role.create',1,8,0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(10,'system.role.edit','web','编辑角色','admin.role.edit',1,8,0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(11,'system.role.destroy','web','删除角色','admin.role.destroy',1,8,0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(12,'system.role.permission','web','分配权限','admin.role.permission',1,8,0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(13,'system.permission','web','权限管理','admin.permission.list',NULL,1,0,'2019-04-25 15:26:01','2019-04-28 19:39:07'),
	(14,'system.permission.create','web','添加权限','admin.permission.create',1,13,0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(15,'system.permission.edit','web','编辑权限','admin.permission.edit',1,13,0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(16,'system.permission.destroy','web','删除权限','admin.permission.destroy',1,13,0,'2019-04-25 15:26:01','2019-04-25 15:26:01'),
	(17,'config.manage','web','配置管理',NULL,121,0,0,'2019-04-28 19:43:22','2019-07-15 13:45:05'),
	(18,'config.site','web','站点配置','admin.site',25,17,0,'2019-04-28 19:44:08','2019-07-15 13:45:07');

/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table role_has_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`)
VALUES
	(1,1),
	(2,1),
	(3,1),
	(4,1),
	(5,1),
	(8,1),
	(9,1),
	(10,1),
	(11,1),
	(12,1),
	(13,1),
	(14,1),
	(15,1),
	(16,1);

/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色名称',
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web' COMMENT '角色组web，api',
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '角色中文',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='角色管理';

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `display_name`, `created_at`, `updated_at`)
VALUES
	(1,'root','web','超级管理员','2019-04-26 19:04:17','2019-04-26 19:04:32'),
	(2,'business','web','商务','2019-04-26 18:55:00',NULL),
	(3,'assessor','web','审核员','2019-04-26 18:55:11',NULL),
	(4,'channel','web','渠道专员','2019-04-26 18:55:22',NULL),
	(5,'editor','web','编辑人员','2019-04-26 18:55:34',NULL),
	(6,'admin','web','管理员','2019-04-26 18:55:44','2019-04-26 19:00:46');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sites
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sites`;

CREATE TABLE `sites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='网站配置表';

LOCK TABLES `sites` WRITE;
/*!40000 ALTER TABLE `sites` DISABLE KEYS */;

INSERT INTO `sites` (`id`, `key`, `value`, `created_at`, `updated_at`)
VALUES
	(1,'title','测试管理',NULL,NULL),
	(2,'keywords','测试管理',NULL,NULL),
	(3,'description','测试管理',NULL,NULL),
	(4,'copyright','测试管理1',NULL,NULL),
	(5,'phone','测试管理',NULL,NULL),
	(6,'city','测试管理',NULL,NULL);

/*!40000 ALTER TABLE `sites` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_has_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_has_role`;

CREATE TABLE `user_has_role` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`role_id`),
  KEY `user_has_role_foreign` (`role_id`),
  KEY `role_has_user_users_id_foreign` (`user_id`),
  CONSTRAINT `role_has_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_user_users_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `user_has_role` WRITE;
/*!40000 ALTER TABLE `user_has_role` DISABLE KEYS */;

INSERT INTO `user_has_role` (`user_id`, `role_id`)
VALUES
	(1,1);

/*!40000 ALTER TABLE `user_has_role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_phone_unique` (`tel`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `tel`, `name`, `email`, `password`, `remember_token`, `uuid`, `created_at`, `updated_at`)
VALUES
	(1,'超级管理员','18721186620','root','root@admin.com','84bdd5a658db3da0fdac76a043d175b2',NULL,'2f3dff08-dbdb-4b88-8aeb-60f45e363234',NULL,'2019-07-15 14:00:46'),
	(2,'henry','18721186621','henry','henry@admin.com','4373810fc7751875f25347ebcddd9554',NULL,'72dfac92-cb78-4ab4-91cd-cb709bd569d8','2019-04-26 18:14:55','2019-07-15 13:45:50');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
