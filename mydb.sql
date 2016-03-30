-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-03-29 17:31:31
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- 替换视图以便查看 `haha`
--
CREATE TABLE IF NOT EXISTS `haha` (
`id` int(11) unsigned
,`title` varchar(30)
);
-- --------------------------------------------------------

--
-- 表的结构 `wzc_admin`
--

CREATE TABLE IF NOT EXISTS `wzc_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `authKey` smallint(4) NOT NULL,
  `createTime` datetime NOT NULL,
  `lastTime` datetime NOT NULL,
  `lastIP` varchar(32) DEFAULT NULL,
  `groupID` int(11) NOT NULL DEFAULT '0',
  `cardID` int(11) NOT NULL DEFAULT '0',
  `phone` char(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `status` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wzc_admin`
--

INSERT INTO `wzc_admin` (`id`, `username`, `password`, `authKey`, `createTime`, `lastTime`, `lastIP`, `groupID`, `cardID`, `phone`, `email`, `nickname`, `status`) VALUES
(1, 'admin', '69cc4ce9629af403cfc83f70c1342add', 9982, '2016-02-29 02:00:00', '2016-02-23 00:00:00', '192.126.12.2', 0, 0, '14718070574', 'admin@163.com', '超级管理员', 1);

-- --------------------------------------------------------

--
-- 表的结构 `wzc_attribute`
--

CREATE TABLE IF NOT EXISTS `wzc_attribute` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `inputType` tinyint(2) unsigned DEFAULT '0' COMMENT '0输入框，1下拉，2单选，3多选',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wzc_attr_relation`
--

CREATE TABLE IF NOT EXISTS `wzc_attr_relation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attrID` int(11) unsigned NOT NULL,
  `valueID` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wzc_brand`
--

CREATE TABLE IF NOT EXISTS `wzc_brand` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `logo` varchar(225) DEFAULT NULL,
  `intro` text,
  `flag` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0国内，1国外',
  `status` tinyint(2) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- 转存表中的数据 `wzc_brand`
--

INSERT INTO `wzc_brand` (`id`, `title`, `logo`, `intro`, `flag`, `status`) VALUES
(1, '是的发送到', NULL, '', 0, 0),
(2, '松岛枫', NULL, '', 0, 0),
(3, '豆腐干豆腐', NULL, '', 0, 0),
(4, '是的发送到', NULL, '', 0, 0),
(5, '水电费水电费', NULL, '', 0, 0),
(6, '水电费水电费', NULL, '', 0, 0),
(7, '松岛枫', NULL, '', 0, 0),
(8, '水电费水电费', NULL, '', 0, 0),
(9, '水电费水电费', NULL, '', 1, 0),
(10, '是的发送到', NULL, '', 0, 0),
(11, '热热热', NULL, '', 0, 0),
(12, '灌灌灌灌灌', NULL, '', 0, 0),
(13, '的观点是放水电费水电费', NULL, '', 0, 0),
(14, '额哥哥哥哥', NULL, '', 0, 0),
(15, 'SDFSDSDF', NULL, '', 0, 0),
(16, '水电费是的发送到', NULL, '', 0, 0),
(17, '是的发生的发生', NULL, '', 0, 0),
(18, '是东风微风', NULL, '', 0, 0),
(19, '而我认为', NULL, '', 0, 0),
(20, '阿萨德请问', NULL, '', 0, 0),
(21, '服务而访问', NULL, '', 0, 0),
(22, '水电费水电费', NULL, '', 0, 0),
(23, '风微风微风', NULL, '', 0, 0),
(24, '风微风微风', NULL, '', 0, 0),
(25, '人文氛围', NULL, '', 0, 0),
(26, '额', NULL, '', 0, 0),
(27, '是东风微风任务', 'QQ图片20150411202134.gif', '', 0, 0),
(29, '啊谁打我', 'QQ图片20150411202134.gif', '', 0, 0),
(31, '的期望的期望', 'QQ图片20150410092626.jpg', '', 0, 0),
(35, 'wefwefwef', 'QQ图片20150410092626.jpg', '', 0, 0),
(36, 'gdsgfsfsdfsdf', '3.jpg', '', 0, 0),
(38, '李宁', 'QQ图片20150702204000.jpg', '好看又便宜', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `wzc_brand_relation`
--

CREATE TABLE IF NOT EXISTS `wzc_brand_relation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `brandID` int(11) unsigned NOT NULL,
  `categoryID` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `wzc_brand_relation`
--

INSERT INTO `wzc_brand_relation` (`id`, `brandID`, `categoryID`) VALUES
(1, 22, 39),
(2, 22, 40),
(3, 23, 40),
(4, 24, 40),
(5, 25, 40),
(6, 26, 40),
(7, 27, 39),
(8, 27, 40),
(9, 28, 39),
(10, 28, 40),
(11, 29, 40),
(12, 30, 40),
(13, 31, 39),
(14, 32, 40),
(15, 33, 40),
(16, 34, 40),
(17, 35, 39),
(18, 36, 40),
(19, 37, 39),
(20, 38, 39);

-- --------------------------------------------------------

--
-- 表的结构 `wzc_categories`
--

CREATE TABLE IF NOT EXISTS `wzc_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `level` smallint(3) unsigned NOT NULL,
  `lft` int(11) unsigned NOT NULL,
  `rgt` int(11) unsigned NOT NULL,
  `path` varchar(200) NOT NULL,
  `sort` int(11) unsigned DEFAULT '0',
  `status` tinyint(2) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- 转存表中的数据 `wzc_categories`
--

INSERT INTO `wzc_categories` (`id`, `title`, `pid`, `level`, `lft`, `rgt`, `path`, `sort`, `status`) VALUES
(1, '商品所属类别', 0, 0, 1, 84, '1', 0, 0),
(2, '女装/内衣', 1, 1, 2, 9, '1-2', 0, 0),
(3, '男装 /运动户外', 1, 1, 10, 15, '1-3', 0, 0),
(4, '女鞋 /男鞋 /箱包', 1, 1, 16, 21, '1-4', 0, 0),
(5, '化妆品 /个人护理', 1, 1, 22, 25, '1-5', 0, 0),
(6, ' 腕表 /珠宝饰品 /眼镜', 1, 1, 26, 29, '1-6', 0, 0),
(7, '手机 /数码 /电脑办公', 1, 1, 30, 33, '1-7', 0, 0),
(8, '母婴玩具', 1, 1, 34, 39, '1-8', 0, 0),
(9, ' 零食 /进口食品 /茶酒', 1, 1, 40, 45, '1-9', 0, 0),
(10, '大家电 /生活电器', 1, 1, 46, 51, '1-10', 0, 0),
(11, ' 家具建材', 1, 1, 52, 55, '1-11', 0, 0),
(14, ' 家纺 /家饰 /鲜花', 1, 1, 62, 65, '1-14', 0, 0),
(13, '汽车 /配件 /用品', 1, 1, 58, 61, '1-13', 0, 0),
(15, '医药保健', 1, 1, 66, 69, '1-15', 0, 0),
(16, ' 厨具 /收纳 /宠物', 1, 1, 70, 75, '1-16', 0, 0),
(17, '图书音像', 1, 1, 76, 79, '1-17', 0, 0),
(18, '天猫超市', 1, 1, 80, 83, '1-18', 0, 0),
(19, '当季新品', 2, 2, 3, 6, '1-2-19', 0, 0),
(20, '百褶裙', 2, 2, 7, 8, '1-2-20', 0, 0),
(21, '一口价好车', 13, 2, 59, 60, '1-13-21', 0, 0),
(22, '电磁炉', 10, 2, 47, 48, '1-10-22', 0, 0),
(23, '电压力锅', 10, 2, 49, 50, '1-10-23', 0, 0),
(24, '婴儿玩具', 8, 2, 35, 36, '1-8-24', 0, 0),
(25, '毛绒玩具', 8, 2, 37, 38, '1-8-25', 0, 0),
(26, '巧克力', 9, 2, 41, 42, '1-9-26', 0, 0),
(27, '牛奶', 9, 2, 43, 44, '1-9-27', 0, 0),
(28, '强化复合地板', 11, 2, 53, 54, '1-11-28', 0, 0),
(29, '人参', 15, 2, 67, 68, '1-15-29', 0, 0),
(30, '玫瑰花', 14, 2, 63, 64, '1-14-30', 0, 0),
(31, '钢铁是怎样炼成的', 17, 2, 77, 78, '1-17-31', 0, 0),
(32, '盘子', 16, 2, 71, 74, '1-16-32', 0, 0),
(33, '进口商品', 18, 2, 81, 82, '1-18-33', 0, 0),
(34, '外套', 3, 2, 11, 14, '1-3-34', 0, 0),
(35, '凉鞋', 4, 2, 17, 18, '1-4-35', 0, 0),
(36, '大宝SOD蜜', 5, 2, 23, 24, '1-5-36', 0, 0),
(37, '光明眼镜', 6, 2, 27, 28, '1-6-37', 0, 0),
(38, '小米5', 7, 2, 31, 32, '1-7-38', 0, 0),
(39, '高级盘子', 32, 3, 72, 73, '1-16-32-39', 0, 0),
(40, '军大衣', 34, 3, 12, 13, '1-3-34-40', 0, 0),
(41, '旅行包', 4, 2, 19, 20, '1-4-41', 0, 0),
(42, '情趣内衣', 19, 3, 4, 5, '1-2-19-42', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `wzc_category_attr`
--

CREATE TABLE IF NOT EXISTS `wzc_category_attr` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attrID` int(11) unsigned NOT NULL,
  `categoryID` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `wzc_file`
--

CREATE TABLE IF NOT EXISTS `wzc_file` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goodsID` int(11) unsigned NOT NULL,
  `typeID` int(11) unsigned NOT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `size` int(11) unsigned DEFAULT '0',
  `url` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `sort` int(11) DEFAULT NULL,
  `createTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `goodsID` (`goodsID`),
  KEY `typeID` (`typeID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wzc_goods`
--

CREATE TABLE IF NOT EXISTS `wzc_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `shopID` int(11) unsigned NOT NULL,
  `categoryID` int(11) unsigned NOT NULL,
  `brandID` int(11) unsigned NOT NULL,
  `hitNum` int(11) unsigned DEFAULT '0',
  `storeNum` int(11) unsigned DEFAULT '0',
  `createTime` datetime DEFAULT NULL,
  `shopPrice` int(11) unsigned DEFAULT '0' COMMENT '单位分',
  `markePrice` int(11) unsigned DEFAULT '0' COMMENT '单位分',
  `isRecommend` tinyint(2) DEFAULT '0',
  `isHot` tinyint(2) DEFAULT '0',
  `isComment` tinyint(2) DEFAULT '0',
  `sort` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `shopID` (`shopID`),
  KEY `categoryID` (`categoryID`),
  KEY `brandID` (`brandID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wzc_goods_attr_value`
--

CREATE TABLE IF NOT EXISTS `wzc_goods_attr_value` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `attrID` int(11) unsigned NOT NULL,
  `goodsID` int(11) unsigned NOT NULL,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wzc_member`
--

CREATE TABLE IF NOT EXISTS `wzc_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `authKey` smallint(4) NOT NULL,
  `sex` tinyint(4) DEFAULT '0' COMMENT '0保密1男2女',
  `type` tinyint(4) DEFAULT '0' COMMENT '0顾客，1商家',
  `nickname` varchar(20) DEFAULT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `phone` char(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `headerImg` varchar(150) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `flag` tinyint(4) DEFAULT '0',
  `createTime` datetime DEFAULT NULL,
  `lastIP` varchar(16) DEFAULT NULL,
  `lastTime` datetime DEFAULT NULL,
  `cardID` int(11) NOT NULL DEFAULT '0' COMMENT '用户身份其他属性标识',
  `source` tinyint(4) NOT NULL DEFAULT '0' COMMENT '用户应用来源',
  PRIMARY KEY (`id`),
  KEY `status` (`status`,`flag`),
  KEY `phone` (`phone`),
  KEY `email` (`email`),
  KEY `type` (`type`,`flag`),
  KEY `cardID` (`cardID`),
  KEY `source` (`source`),
  KEY `loginName` (`username`(4))
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;

--
-- 转存表中的数据 `wzc_member`
--

INSERT INTO `wzc_member` (`id`, `username`, `password`, `authKey`, `sex`, `type`, `nickname`, `qq`, `phone`, `email`, `headerImg`, `status`, `flag`, `createTime`, `lastIP`, `lastTime`, `cardID`, `source`) VALUES
(42, 'wuzhc@163.com', '56463fdcd7819dd1911a11f71c20373a', 4578, 0, 0, '23423', '23423423', '14718070574', 'wuzhc@163.com', '23423423', 0, 1, '2016-02-23 00:00:00', '127.0.0.1', '2016-03-13 12:05:31', 0, 0),
(43, 'haha', '56463fdcd7819dd1911a11f71c20373a', 4578, 0, 0, '哈哈', '', NULL, NULL, NULL, 0, 1, '2016-02-27 00:00:00', '127.0.0.1', '2016-02-28 00:00:00', 0, 0),
(44, 'wegweggewg', '$2y$13$Qf8AGg1daNRs2x6F6AyEmuLrW', 0, 0, 0, '哈哈', '', NULL, NULL, NULL, 0, 1, '2016-02-27 00:00:00', '127.0.0.1', '2016-02-28 00:00:00', 0, 0),
(45, 'wett34t334tdsfs', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 0, '哈哈', '', NULL, NULL, NULL, 0, 1, '2016-02-27 00:00:00', '127.0.0.1', '2016-02-28 00:00:00', 0, 0),
(46, 'wetfwefgbvdfgdg', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 0, '哈哈', '', NULL, NULL, NULL, 0, 1, '2016-02-27 00:00:00', '127.0.0.1', '2016-02-28 00:00:00', 0, 0),
(47, 'gaga', '1809asd', 1809, 0, 0, '胜多负少', NULL, NULL, 'gaga@163.com', NULL, 0, 1, NULL, NULL, NULL, 0, 0),
(48, 'tata', 'bdaec1f37cca552de448f54be62b6bb6', 5662, 0, 0, '碧淑黛芙', NULL, NULL, 'tata@163.com', NULL, 0, 1, NULL, '127.0.0.1', '2016-02-29 14:26:36', 0, 0),
(49, 'bebe', '906e6f93e6814f8d80f4e3ea75d4ca72', 5483, NULL, 0, '贝贝', NULL, '14718070571', 'bebe@163.com', NULL, 0, 1, NULL, NULL, NULL, 0, 0),
(50, 'rara', 'bbb54e0a022e7ddbc0ca6630770413c2', 5559, NULL, 0, '让让', NULL, '14718070570', 'rara@163.com', NULL, 0, 1, '2016-02-27 14:08:03', '127.0.0.1', '2016-03-07 14:17:51', 0, 0),
(51, 'arar', '2603a51acb9b3ff52003c0075a69d866', 7732, NULL, 0, '安然然', NULL, '15412514121', 'arar@163.com', NULL, 0, 1, '2016-02-27 14:12:23', '127.0.0.1', '2016-02-27 14:12:23', 0, 0),
(52, 'caca', '2bc651d70b2fc25a2105c62d1656ad47', 2138, NULL, 0, '擦擦', NULL, '13611010101', 'caca@163.com', NULL, 0, 1, '2016-02-27 14:13:38', '127.0.0.1', '2016-02-27 14:13:38', 0, 0),
(53, 'trtr', 'aeeccd9754ccf2e773008eff05b1aad3', 7309, NULL, 0, 'trtr', NULL, '15647412541', 'trtr@163.com', NULL, 0, 1, '2016-02-27 14:15:29', '127.0.0.1', '2016-02-27 14:15:29', 0, 0),
(54, 'efef', '8dc3b0ceb48d2ae1941ef4da0b506394', 3909, 2, 0, '凤飞飞', NULL, '17458451213', 'efef@163.com', NULL, 0, 1, '2016-02-27 14:16:45', '127.0.0.1', '2016-02-27 14:16:45', 0, 0),
(55, 'yaya', 'e1dbc50bf2e199ba0f3d9ed74d9667a5', 2863, 2, 0, '丫丫', NULL, '14712000120', 'yaya@163.com', NULL, 0, 1, '2016-02-27 14:21:00', '127.0.0.1', '2016-02-27 14:21:00', 0, 0),
(56, 'oooo', '21ac6f484652572afa779a32095df431', 3716, 1, 0, '噢噢噢噢', NULL, '13212000121', 'oooo@163.com', NULL, 0, 1, '2016-02-27 14:22:00', '127.0.0.1', '2016-02-27 15:32:54', 0, 0),
(57, 'gege', '82b4f23351384ceab1b95f1b78315833', 7152, 1, 0, '哥哥', NULL, '14514154121', 'gege@163.com', NULL, 0, 1, '2016-02-28 13:27:47', '127.0.0.1', '2016-02-28 13:27:47', 0, 0),
(58, 'vava', 'e08082495f73251ef67cb09a110e6cee', 8360, 2, 0, 'v啊啊', NULL, '14718070576', 'vava@163.com', NULL, 0, 1, '2016-02-28 13:29:51', '127.0.0.1', '2016-02-28 13:30:09', 0, 0),
(60, 'rarara', '3c9dd59fb98cadbc93b5b08c21db4730', 1970, 1, 0, 'rarara', NULL, '14718070573', 'rarara@163.com', NULL, 0, 1, '2016-03-12 11:09:28', '127.0.0.1', '2016-03-12 11:09:28', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `wzc_shop`
--

CREATE TABLE IF NOT EXISTS `wzc_shop` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `userID` int(11) NOT NULL,
  `createTime` datetime DEFAULT NULL,
  `creditScore` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `wzc_shop`
--

INSERT INTO `wzc_shop` (`id`, `title`, `userID`, `createTime`, `creditScore`) VALUES
(1, '捂着嘴旗舰店', 42, '2016-03-01 00:00:00', 0);

-- --------------------------------------------------------

--
-- 表的结构 `wzc_text`
--

CREATE TABLE IF NOT EXISTS `wzc_text` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goodsID` int(11) unsigned NOT NULL,
  `attrID` int(11) unsigned NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `wzc_value`
--

CREATE TABLE IF NOT EXISTS `wzc_value` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `value` varchar(100) NOT NULL,
  `attrID` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 视图结构 `haha`
--
DROP TABLE IF EXISTS `haha`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `haha` AS select `wzc_categories`.`id` AS `id`,`wzc_categories`.`title` AS `title` from `wzc_categories`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
