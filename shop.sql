-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-09-08 17:42:42
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- 表的结构 `task_18689`
--

CREATE TABLE IF NOT EXISTS `task_18689` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `price` text,
  `thumb` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_account_log`
--

CREATE TABLE IF NOT EXISTS `zc_account_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) unsigned DEFAULT '0' COMMENT '管理员ID',
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '用户id',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0增加,1减少',
  `event` tinyint(3) NOT NULL COMMENT '操作类型，意义请看accountLog类',
  `time` datetime NOT NULL COMMENT '发生时间',
  `amount` decimal(15,2) NOT NULL COMMENT '金额',
  `amount_log` decimal(15,2) NOT NULL COMMENT '每次增减后面的金额记录',
  `note` text COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='账户余额日志表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_address`
--

CREATE TABLE IF NOT EXISTS `zc_address` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `accept_name` varchar(20) NOT NULL COMMENT '收货人姓名',
  `zip` varchar(6) DEFAULT NULL COMMENT '邮编',
  `telphone` varchar(20) DEFAULT NULL COMMENT '联系电话',
  `country` int(11) unsigned DEFAULT NULL COMMENT '国ID',
  `province` int(11) unsigned NOT NULL COMMENT '省ID',
  `city` int(11) unsigned NOT NULL COMMENT '市ID',
  `area` int(11) unsigned NOT NULL COMMENT '区ID',
  `address` varchar(250) NOT NULL COMMENT '收货地址',
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机',
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否默认,0:为非默认,1:默认',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='收货信息表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_admin`
--

CREATE TABLE IF NOT EXISTS `zc_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `admin_name` varchar(20) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `role_id` int(11) unsigned NOT NULL COMMENT '角色ID',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `email` varchar(255) DEFAULT NULL COMMENT 'Email',
  `last_ip` varchar(30) DEFAULT NULL COMMENT '最后登录IP',
  `last_time` datetime DEFAULT NULL COMMENT '最后登录时间',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '删除状态 1删除,0正常',
  PRIMARY KEY (`id`),
  KEY `admin_name` (`admin_name`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员用户表' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_admin_role`
--

CREATE TABLE IF NOT EXISTS `zc_admin_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '角色名称',
  `rights` text COMMENT '权限',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '删除状态 1删除,0正常',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='后台角色分组表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_ad_manage`
--

CREATE TABLE IF NOT EXISTS `zc_ad_manage` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '广告ID',
  `name` varchar(50) NOT NULL COMMENT '广告名称',
  `type` tinyint(1) NOT NULL COMMENT '广告类型 1:img 2:flash 3:文字 4:code',
  `position_id` int(11) unsigned DEFAULT '0' COMMENT '广告位ID',
  `link` varchar(255) DEFAULT NULL COMMENT '链接地址',
  `order` smallint(5) NOT NULL DEFAULT '0' COMMENT '排列顺序',
  `start_time` date DEFAULT NULL COMMENT '开始时间',
  `end_time` date DEFAULT NULL COMMENT '结束时间',
  `content` text COMMENT '图片、flash路径，文字，code等',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `goods_cat_id` int(11) unsigned DEFAULT '0' COMMENT '绑定的商品分类ID',
  PRIMARY KEY (`id`),
  KEY `position_id` (`position_id`),
  KEY `order` (`order`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='广告记录表' AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_ad_position`
--

CREATE TABLE IF NOT EXISTS `zc_ad_position` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '广告位ID',
  `name` varchar(30) NOT NULL COMMENT '广告位名称',
  `width` varchar(255) NOT NULL COMMENT '广告位宽度,px或者%',
  `height` varchar(255) NOT NULL COMMENT '广告位高度,px或者%',
  `fashion` tinyint(1) NOT NULL COMMENT '1:轮显;2:随即',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1:开启; 0: 关闭',
  PRIMARY KEY (`id`),
  KEY `name` (`name`,`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='广告位记录表' AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_announcement`
--

CREATE TABLE IF NOT EXISTS `zc_announcement` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '公告标题',
  `content` text COMMENT '公告内容',
  `time` datetime NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='公告消息表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_areas`
--

CREATE TABLE IF NOT EXISTS `zc_areas` (
  `area_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL COMMENT '上一级的id值',
  `area_name` varchar(50) NOT NULL COMMENT '地区名称',
  `sort` int(10) unsigned NOT NULL DEFAULT '99' COMMENT '排序',
  PRIMARY KEY (`area_id`),
  KEY `parent_id` (`parent_id`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='地区信息' AUTO_INCREMENT=659004403 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_article`
--

CREATE TABLE IF NOT EXISTS `zc_article` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `category_id` int(11) unsigned NOT NULL COMMENT '分类ID',
  `create_time` datetime NOT NULL COMMENT '发布时间',
  `keywords` varchar(255) DEFAULT NULL COMMENT '关键词',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `visibility` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示 0:不显示,1:显示',
  `top` tinyint(1) NOT NULL DEFAULT '0' COMMENT '置顶',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `style` tinyint(1) NOT NULL DEFAULT '0' COMMENT '标题字体 0正常 1粗体,2斜体',
  `color` varchar(7) DEFAULT NULL COMMENT '标题颜色',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`),
  KEY `category_id` (`category_id`,`visibility`),
  KEY `visibility` (`visibility`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_article_category`
--

CREATE TABLE IF NOT EXISTS `zc_article_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父分类',
  `issys` tinyint(1) NOT NULL DEFAULT '0' COMMENT '系统分类',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `path` varchar(255) DEFAULT NULL COMMENT '路径',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `sort` (`sort`),
  KEY `issys` (`issys`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章分类' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_attr`
--

CREATE TABLE IF NOT EXISTS `zc_attr` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '属性ID',
  `name` varchar(50) NOT NULL COMMENT '属性名称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态,0可用，1不可用',
  `sort` smallint(5) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='属性名称' AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_attribute`
--

CREATE TABLE IF NOT EXISTS `zc_attribute` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '属性ID',
  `model_id` int(11) unsigned DEFAULT NULL COMMENT '模型ID',
  `type` tinyint(1) DEFAULT NULL COMMENT '输入控件的类型,1:单选,2:复选,3:下拉,4:输入框',
  `name` varchar(50) DEFAULT NULL COMMENT '名称',
  `value` text COMMENT '属性值(逗号分隔)',
  `search` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否支持搜索0不支持1支持',
  PRIMARY KEY (`id`),
  KEY `model_id` (`model_id`,`search`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='属性表' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_attr_value`
--

CREATE TABLE IF NOT EXISTS `zc_attr_value` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `aid` int(11) unsigned NOT NULL COMMENT '属性ID，对应attribute.id',
  `name` varchar(50) NOT NULL COMMENT '属性值',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态,0可用，1不可用',
  `sort` smallint(5) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='属性名称' AUTO_INCREMENT=1038 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_auth_assignment`
--

CREATE TABLE IF NOT EXISTS `zc_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `zc_auth_item`
--

CREATE TABLE IF NOT EXISTS `zc_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `zc_auth_item_child`
--

CREATE TABLE IF NOT EXISTS `zc_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `zc_auth_rule`
--

CREATE TABLE IF NOT EXISTS `zc_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `zc_bill`
--

CREATE TABLE IF NOT EXISTS `zc_bill` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `seller_id` int(11) unsigned NOT NULL COMMENT '商家ID',
  `apply_time` datetime DEFAULT NULL COMMENT '申请结算时间',
  `pay_time` datetime DEFAULT NULL COMMENT '支付结算时间',
  `admin_id` int(11) unsigned DEFAULT NULL COMMENT '管理员ID',
  `is_pay` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未结算,1:已结算',
  `apply_content` text COMMENT '申请结算文本',
  `pay_content` text COMMENT '支付结算文本',
  `start_time` date DEFAULT NULL COMMENT '结算起始时间',
  `end_time` date DEFAULT NULL COMMENT '结算终止时间',
  `log` text COMMENT '结算明细',
  `order_ids` text COMMENT 'order表主键ID，结算的ID',
  PRIMARY KEY (`id`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商家货款结算单表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_brand`
--

CREATE TABLE IF NOT EXISTS `zc_brand` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '品牌ID',
  `vid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '品牌名称',
  `logo` varchar(255) DEFAULT NULL COMMENT 'logo地址',
  `url` varchar(255) DEFAULT NULL COMMENT '网址',
  `description` text COMMENT '描述',
  `sort` smallint(5) NOT NULL DEFAULT '0' COMMENT '排序',
  `category_ids` varchar(255) DEFAULT NULL COMMENT '品牌分类,逗号分割id',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`),
  KEY `category_ids` (`category_ids`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='品牌表' AUTO_INCREMENT=1021 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_brand_category`
--

CREATE TABLE IF NOT EXISTS `zc_brand_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(255) NOT NULL COMMENT '分类名称',
  `goods_category_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商品分类ID',
  PRIMARY KEY (`id`),
  KEY `goods_category_id` (`goods_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='品牌分类表' AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_category`
--

CREATE TABLE IF NOT EXISTS `zc_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `parent_id` int(11) unsigned NOT NULL COMMENT '父分类ID',
  `sort` smallint(5) NOT NULL DEFAULT '0' COMMENT '排序',
  `visibility` tinyint(1) NOT NULL DEFAULT '0' COMMENT '首页是否显示 0显示 1 不显示',
  `keywords` varchar(255) DEFAULT NULL COMMENT 'SEO关键词和检索关键词',
  `descript` varchar(255) DEFAULT NULL COMMENT 'SEO描述',
  `title` varchar(255) DEFAULT NULL COMMENT 'SEO标题title',
  `seller_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商家ID',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`,`visibility`),
  KEY `sort` (`sort`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='产品分类表' AUTO_INCREMENT=646 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_category_attr_map`
--

CREATE TABLE IF NOT EXISTS `zc_category_attr_map` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `cid` int(11) unsigned NOT NULL COMMENT '类别ID，对应category.id',
  `aid` int(11) unsigned NOT NULL COMMENT '属性ID,对应attribute.id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='类别与属性关联表' AUTO_INCREMENT=6627 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_category_attr_val_map`
--

CREATE TABLE IF NOT EXISTS `zc_category_attr_val_map` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `cid` int(11) unsigned NOT NULL COMMENT '类别ID，对应category.id',
  `aid` int(11) NOT NULL,
  `vid` int(11) unsigned NOT NULL COMMENT '属性与属性值关联表主键ID,attr_val_map.id',
  `sort` smallint(5) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='属性与属性值关联表' AUTO_INCREMENT=6647 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_collection_doc`
--

CREATE TABLE IF NOT EXISTS `zc_collection_doc` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) unsigned NOT NULL COMMENT '订单号',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `amount` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `time` datetime NOT NULL COMMENT '时间',
  `payment_id` int(11) unsigned NOT NULL COMMENT '支付方式ID',
  `admin_id` int(11) unsigned DEFAULT NULL COMMENT '管理员id',
  `pay_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '支付状态，0:准备，1:支付成功',
  `note` text COMMENT '收款备注',
  `if_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未删除 1:删除',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `if_del` (`if_del`),
  KEY `payment_id` (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='收款单' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_commend_goods`
--

CREATE TABLE IF NOT EXISTS `zc_commend_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `commend_id` int(11) unsigned NOT NULL COMMENT '推荐类型ID 1:最新商品 2:特价商品 3:热卖排行 4:推荐商品',
  `goods_id` int(11) unsigned NOT NULL COMMENT '商品ID',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `commend_id` (`commend_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='推荐类商品' AUTO_INCREMENT=2873 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_comment`
--

CREATE TABLE IF NOT EXISTS `zc_comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) unsigned NOT NULL COMMENT '商品ID',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `order_no` varchar(20) NOT NULL COMMENT '订单编号',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `time` datetime NOT NULL COMMENT '购买时间',
  `comment_time` date NOT NULL COMMENT '评论时间',
  `contents` text COMMENT '评论内容',
  `point` tinyint(1) NOT NULL DEFAULT '0' COMMENT '评论的分数',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '评论状态：0：未评论 1:已评论',
  `seller_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商家ID',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `user_id` (`user_id`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品评论表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_delivery`
--

CREATE TABLE IF NOT EXISTS `zc_delivery` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL COMMENT '快递名称',
  `description` varchar(50) DEFAULT NULL COMMENT '快递描述',
  `area_groupid` text COMMENT '配送区域id',
  `firstprice` text COMMENT '配送地址对应的首重价格',
  `secondprice` text COMMENT '配送地区对应的续重价格',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '配送类型 0先付款后发货 1先发货后付款 2自提点',
  `first_weight` int(11) unsigned NOT NULL COMMENT '首重重量(克)',
  `second_weight` int(11) unsigned NOT NULL COMMENT '续重重量(克)',
  `first_price` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '首重价格',
  `second_price` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '续重价格',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '开启状态',
  `sort` smallint(5) NOT NULL DEFAULT '99' COMMENT '排序',
  `is_save_price` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否支持物流保价 1支持保价 0  不支持保价',
  `save_rate` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '保价费率',
  `low_price` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '最低保价',
  `price_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '费用类型 0统一设置 1指定地区费用',
  `open_default` tinyint(1) NOT NULL DEFAULT '1' COMMENT '启用默认费用 1启用 0 不启用',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除 0:未删除 1:删除',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='配送方式表' AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_delivery_doc`
--

CREATE TABLE IF NOT EXISTS `zc_delivery_doc` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '发货单ID',
  `order_id` int(11) unsigned NOT NULL COMMENT '订单ID',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `admin_id` int(11) unsigned DEFAULT '0' COMMENT '管理员ID',
  `seller_id` int(11) unsigned DEFAULT '0' COMMENT '商户ID',
  `name` varchar(255) NOT NULL COMMENT '收货人',
  `postcode` varchar(6) DEFAULT NULL COMMENT '邮编',
  `telphone` varchar(20) DEFAULT NULL COMMENT '联系电话',
  `country` int(11) unsigned DEFAULT NULL COMMENT '国ID',
  `province` int(11) unsigned NOT NULL COMMENT '省ID',
  `city` int(11) unsigned NOT NULL COMMENT '市ID',
  `area` int(11) unsigned NOT NULL COMMENT '区ID',
  `address` varchar(250) NOT NULL COMMENT '收货地址',
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机',
  `time` datetime NOT NULL COMMENT '创建时间',
  `freight` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '运费',
  `delivery_code` varchar(255) NOT NULL COMMENT '物流单号',
  `delivery_type` varchar(255) NOT NULL COMMENT '物流方式',
  `note` text COMMENT '管理员添加的备注信息',
  `if_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未删除 1:已删除',
  `freight_id` int(11) unsigned DEFAULT NULL COMMENT '货运公司ID',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `freight_id` (`freight_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='发货单' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_delivery_extend`
--

CREATE TABLE IF NOT EXISTS `zc_delivery_extend` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `delivery_id` int(11) unsigned NOT NULL COMMENT '配送方式关联ID',
  `area_groupid` text COMMENT '单独配置地区id',
  `firstprice` text COMMENT '单独配置地区对应的首重价格',
  `secondprice` text COMMENT '单独配置地区对应的续重价格',
  `first_weight` int(11) unsigned NOT NULL COMMENT '首重重量(克)',
  `second_weight` int(11) unsigned NOT NULL COMMENT '续重重量(克)',
  `first_price` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '默认首重价格',
  `second_price` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '默认续重价格',
  `is_save_price` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否支持物流保价 1支持保价 0  不支持保价',
  `save_rate` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '保价费率',
  `low_price` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '最低保价',
  `price_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '费用类型 0统一设置 1指定地区费用',
  `open_default` tinyint(1) NOT NULL DEFAULT '1' COMMENT '启用默认费用 1启用 0 不启用',
  `seller_id` int(11) unsigned NOT NULL COMMENT '商家ID',
  PRIMARY KEY (`id`),
  KEY `delivery_id` (`delivery_id`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商家配送方式扩展表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_discussion`
--

CREATE TABLE IF NOT EXISTS `zc_discussion` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) unsigned NOT NULL COMMENT '商品ID',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `time` datetime NOT NULL COMMENT '评论时间',
  `contents` text COMMENT '评论内容',
  `is_check` tinyint(1) NOT NULL DEFAULT '0' COMMENT '审核状态,0未审核 1已审核',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品讨论表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_email_registry`
--

CREATE TABLE IF NOT EXISTS `zc_email_registry` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(80) NOT NULL COMMENT 'Email',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`(15))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Email订阅表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_expresswaybill`
--

CREATE TABLE IF NOT EXISTS `zc_expresswaybill` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL COMMENT '快递单模板名字',
  `config` text COMMENT '序列化的快递单结构数据',
  `background` varchar(255) DEFAULT NULL COMMENT '背景图片路径',
  `width` smallint(5) unsigned DEFAULT '900' COMMENT '背景图片路径',
  `height` smallint(5) unsigned DEFAULT '600' COMMENT '背景图片路径',
  `is_close` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 1关闭,0正常',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='快递单模板' AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_favorite`
--

CREATE TABLE IF NOT EXISTS `zc_favorite` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `rid` int(11) unsigned NOT NULL COMMENT '商品ID',
  `time` datetime NOT NULL COMMENT '收藏时间',
  `summary` varchar(255) DEFAULT NULL COMMENT '备注',
  `cat_id` int(11) unsigned NOT NULL COMMENT '商品分类',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `cat_id` (`cat_id`),
  KEY `rid` (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='收藏夹表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_find_password`
--

CREATE TABLE IF NOT EXISTS `zc_find_password` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `hash` char(32) NOT NULL COMMENT 'hash值',
  `addtime` int(11) NOT NULL COMMENT '申请找回的时间',
  PRIMARY KEY (`id`),
  KEY `hash` (`hash`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='找回密码' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_freight_company`
--

CREATE TABLE IF NOT EXISTS `zc_freight_company` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `freight_type` varchar(255) NOT NULL COMMENT '货运类型',
  `freight_name` varchar(255) NOT NULL COMMENT '货运公司名称',
  `url` varchar(255) NOT NULL COMMENT '网址',
  `sort` smallint(5) NOT NULL DEFAULT '99' COMMENT '排序',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未删除1删除',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='货运公司' AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_goods`
--

CREATE TABLE IF NOT EXISTS `zc_goods` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  `cid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '商品名称',
  `goods_no` varchar(20) DEFAULT NULL COMMENT '商品的货号',
  `model_id` int(11) unsigned DEFAULT NULL COMMENT '模型ID',
  `sell_price` decimal(15,2) NOT NULL COMMENT '销售价格',
  `market_price` decimal(15,2) DEFAULT NULL COMMENT '市场价格',
  `cost_price` decimal(15,2) DEFAULT NULL COMMENT '成本价格',
  `up_time` datetime DEFAULT NULL COMMENT '上架时间',
  `down_time` datetime DEFAULT NULL COMMENT '下架时间',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `store_nums` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `img` varchar(255) DEFAULT NULL COMMENT '原图',
  `ad_img` varchar(255) DEFAULT NULL COMMENT '宣传图',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '商品状态 0正常 1已删除 2下架 3申请上架',
  `content` text COMMENT '商品描述',
  `keywords` varchar(255) DEFAULT NULL COMMENT 'SEO关键词',
  `description` varchar(255) DEFAULT NULL COMMENT 'SEO描述',
  `search_words` varchar(50) DEFAULT NULL COMMENT '产品搜索词库,逗号分隔',
  `weight` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '重量',
  `point` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `unit` varchar(10) DEFAULT NULL COMMENT '计量单位',
  `category_id` int(11) DEFAULT NULL COMMENT '分类ID',
  `visit` int(11) NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `favorite` int(11) NOT NULL DEFAULT '0' COMMENT '收藏次数',
  `sort` smallint(5) NOT NULL DEFAULT '99' COMMENT '排序',
  `spec_array` text COMMENT '序列化存储规格,key值为规则ID，value为此商品具有的规格值',
  `exp` int(11) NOT NULL DEFAULT '0' COMMENT '经验值',
  `comments` int(11) NOT NULL DEFAULT '0' COMMENT '评论次数',
  `sale` int(11) NOT NULL DEFAULT '0' COMMENT '销量',
  `grade` int(11) NOT NULL DEFAULT '0' COMMENT '评分总数',
  `seller_id` int(11) unsigned DEFAULT '0' COMMENT '卖家ID',
  `is_share` tinyint(1) NOT NULL DEFAULT '0' COMMENT '共享商品 0不共享 1共享',
  PRIMARY KEY (`id`),
  KEY `is_del` (`is_del`),
  KEY `sort` (`sort`),
  KEY `sale` (`sale`),
  KEY `grade` (`grade`),
  KEY `sell_price` (`sell_price`),
  KEY `name` (`name`),
  KEY `goods_no` (`goods_no`),
  KEY `is_share` (`is_share`),
  KEY `brand_id` (`category_id`,`is_del`),
  KEY `brand_id_2` (`category_id`,`sell_price`),
  KEY `brand_id_3` (`category_id`,`grade`),
  KEY `brand_id_4` (`category_id`,`sale`),
  KEY `store_nums` (`store_nums`,`is_del`),
  KEY `seller_id` (`seller_id`,`is_del`),
  KEY `seller_id_2` (`seller_id`,`sell_price`),
  KEY `seller_id_3` (`seller_id`,`grade`),
  KEY `seller_id_4` (`seller_id`,`sale`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品信息表' AUTO_INCREMENT=8837 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_goods_attribute`
--

CREATE TABLE IF NOT EXISTS `zc_goods_attribute` (
  `id` int(11) unsigned NOT NULL,
  `goods_id` int(11) unsigned NOT NULL COMMENT '商品ID',
  `attribute_id` int(11) unsigned DEFAULT NULL COMMENT '属性ID',
  `attribute_value` varchar(255) DEFAULT NULL COMMENT '属性值',
  `model_id` int(11) unsigned DEFAULT NULL COMMENT '模型ID',
  `order` smallint(5) NOT NULL DEFAULT '99' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `attribute_id` (`attribute_id`,`attribute_value`),
  KEY `order` (`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='属性值表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_goods_attr_val_map`
--

CREATE TABLE IF NOT EXISTS `zc_goods_attr_val_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) unsigned NOT NULL COMMENT '商品ID,goods.id',
  `aid` int(11) unsigned NOT NULL COMMENT '属性ID',
  `vid` int(11) NOT NULL COMMENT '属性值ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品与属性值关联表' AUTO_INCREMENT=9886 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_goods_car`
--

CREATE TABLE IF NOT EXISTS `zc_goods_car` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `content` text COMMENT '购物内容',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='购物车';

-- --------------------------------------------------------

--
-- 表的结构 `zc_goods_ext_attr`
--

CREATE TABLE IF NOT EXISTS `zc_goods_ext_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '属性名称',
  `value` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '属性值',
  `uid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `status` smallint(1) DEFAULT '0' COMMENT '0正常,1已删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_goods_image`
--

CREATE TABLE IF NOT EXISTS `zc_goods_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gid` int(11) unsigned NOT NULL COMMENT '商品ID,goods.id',
  `img` varchar(255) DEFAULT NULL COMMENT '图像地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商品图集' AUTO_INCREMENT=36 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_goods_photo`
--

CREATE TABLE IF NOT EXISTS `zc_goods_photo` (
  `id` char(32) NOT NULL COMMENT '图片的md5值',
  `img` varchar(255) DEFAULT NULL COMMENT '原始图片路径',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='图片表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_goods_photo_relation`
--

CREATE TABLE IF NOT EXISTS `zc_goods_photo_relation` (
  `id` int(11) unsigned NOT NULL,
  `goods_id` int(11) unsigned NOT NULL COMMENT '商品ID',
  `photo_id` char(32) NOT NULL DEFAULT '' COMMENT '图片ID,图片的md5值',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `photo_id` (`photo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='相册商品关系表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_group_price`
--

CREATE TABLE IF NOT EXISTS `zc_group_price` (
  `id` int(11) unsigned NOT NULL,
  `goods_id` int(11) unsigned NOT NULL COMMENT '产品ID',
  `product_id` int(11) unsigned DEFAULT NULL COMMENT '货品ID',
  `group_id` int(11) unsigned NOT NULL COMMENT '用户组ID',
  `price` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '价格',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `group_id` (`group_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='记录某件商品对于某组会员的价格关系表，优先权大于组设定的折扣率';

-- --------------------------------------------------------

--
-- 表的结构 `zc_guide`
--

CREATE TABLE IF NOT EXISTS `zc_guide` (
  `order` smallint(5) unsigned NOT NULL COMMENT '排序',
  `name` varchar(255) NOT NULL COMMENT '导航名字',
  `link` varchar(255) NOT NULL COMMENT '链接地址',
  PRIMARY KEY (`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='首页导航栏';

-- --------------------------------------------------------

--
-- 表的结构 `zc_help`
--

CREATE TABLE IF NOT EXISTS `zc_help` (
  `id` int(11) unsigned NOT NULL,
  `cat_id` int(11) unsigned DEFAULT NULL COMMENT '帮助分类，如果为0则代表着是下面的帮助单页',
  `sort` smallint(5) NOT NULL DEFAULT '99' COMMENT '顺序',
  `name` varchar(50) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `dateline` int(11) NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`),
  KEY `cat_id` (`cat_id`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='帮助内容';

-- --------------------------------------------------------

--
-- 表的结构 `zc_help_category`
--

CREATE TABLE IF NOT EXISTS `zc_help_category` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(10) NOT NULL COMMENT '标题',
  `sort` smallint(5) NOT NULL COMMENT '顺序',
  `position_left` tinyint(1) NOT NULL COMMENT '是否在帮助内容、列表页面的左侧显示',
  `position_foot` tinyint(1) NOT NULL COMMENT '是否在整站页面下方显示',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`),
  KEY `position_left` (`position_left`),
  KEY `position_foot` (`position_foot`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='帮助分类';

-- --------------------------------------------------------

--
-- 表的结构 `zc_keyword`
--

CREATE TABLE IF NOT EXISTS `zc_keyword` (
  `word` varchar(15) NOT NULL COMMENT '关键词',
  `goods_nums` int(11) NOT NULL DEFAULT '1' COMMENT '产品数量',
  `hot` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为热门',
  `order` smallint(5) NOT NULL DEFAULT '99' COMMENT '关键词排序',
  PRIMARY KEY (`word`),
  KEY `hot` (`hot`),
  KEY `order` (`order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='关键词';

-- --------------------------------------------------------

--
-- 表的结构 `zc_log_error`
--

CREATE TABLE IF NOT EXISTS `zc_log_error` (
  `id` int(11) unsigned NOT NULL,
  `file` varchar(200) NOT NULL COMMENT '文件',
  `line` smallint(5) unsigned NOT NULL COMMENT '出错文件行数',
  `content` varchar(255) NOT NULL COMMENT '内容',
  `datetime` datetime NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='错误日志表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_log_operation`
--

CREATE TABLE IF NOT EXISTS `zc_log_operation` (
  `id` int(11) unsigned NOT NULL,
  `author` varchar(80) NOT NULL COMMENT '操作人员',
  `action` varchar(200) NOT NULL COMMENT '动作',
  `content` text COMMENT '内容',
  `datetime` datetime NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='日志操作记录';

-- --------------------------------------------------------

--
-- 表的结构 `zc_log_sql`
--

CREATE TABLE IF NOT EXISTS `zc_log_sql` (
  `id` int(11) unsigned NOT NULL,
  `content` varchar(255) NOT NULL COMMENT '执行的SQL语句',
  `runtime` decimal(15,2) unsigned NOT NULL COMMENT '语句执行时间(秒)',
  `datetime` datetime NOT NULL COMMENT '发生的时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='SQL日志记录';

-- --------------------------------------------------------

--
-- 表的结构 `zc_marketing_sms`
--

CREATE TABLE IF NOT EXISTS `zc_marketing_sms` (
  `id` int(11) unsigned NOT NULL,
  `content` varchar(255) NOT NULL COMMENT '短信内容',
  `send_nums` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发送成功数',
  `time` datetime NOT NULL COMMENT '发送时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='营销短信';

-- --------------------------------------------------------

--
-- 表的结构 `zc_member`
--

CREATE TABLE IF NOT EXISTS `zc_member` (
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

-- --------------------------------------------------------

--
-- 表的结构 `zc_merch_ship_info`
--

CREATE TABLE IF NOT EXISTS `zc_merch_ship_info` (
  `id` int(11) unsigned NOT NULL,
  `ship_name` varchar(255) NOT NULL COMMENT '发货点名称',
  `ship_user_name` varchar(255) NOT NULL COMMENT '发货人姓名',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别 0:女 1:男',
  `country` int(11) DEFAULT NULL COMMENT '国id',
  `province` int(11) NOT NULL COMMENT '省id',
  `city` int(11) NOT NULL COMMENT '市id',
  `area` int(11) NOT NULL COMMENT '地区id',
  `postcode` varchar(6) DEFAULT NULL COMMENT '邮编',
  `address` varchar(255) NOT NULL COMMENT '具体地址',
  `mobile` varchar(20) NOT NULL COMMENT '手机',
  `telphone` varchar(20) DEFAULT NULL COMMENT '电话',
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1为默认地址，0则不是',
  `note` text COMMENT '备注',
  `addtime` datetime NOT NULL COMMENT '保存时间',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0为删除，1为显示',
  `seller_id` int(11) unsigned NOT NULL COMMENT '商家ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商家发货点信息';

-- --------------------------------------------------------

--
-- 表的结构 `zc_message`
--

CREATE TABLE IF NOT EXISTS `zc_message` (
  `id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `content` text COMMENT '内容',
  `time` datetime NOT NULL COMMENT '发送时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员消息';

-- --------------------------------------------------------

--
-- 表的结构 `zc_migration`
--

CREATE TABLE IF NOT EXISTS `zc_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `zc_model`
--

CREATE TABLE IF NOT EXISTS `zc_model` (
  `id` int(11) unsigned NOT NULL COMMENT '模型ID',
  `name` varchar(50) NOT NULL COMMENT '模型名称',
  `spec_ids` text COMMENT '规格ID逗号分隔',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='模型表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_notify_registry`
--

CREATE TABLE IF NOT EXISTS `zc_notify_registry` (
  `id` int(11) unsigned NOT NULL,
  `goods_id` int(11) unsigned NOT NULL COMMENT '商品ID',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `email` varchar(255) DEFAULT NULL COMMENT 'emaill',
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机',
  `register_time` datetime NOT NULL COMMENT '登记时间',
  `notify_time` datetime DEFAULT NULL COMMENT '通知时间',
  `notify_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未通知1仅邮件通知2仅短信通知3已邮件、短信通知',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='到货通知表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_oauth`
--

CREATE TABLE IF NOT EXISTS `zc_oauth` (
  `id` smallint(5) unsigned NOT NULL,
  `name` varchar(80) NOT NULL COMMENT '名称',
  `config` text COMMENT '配置信息',
  `file` varchar(80) NOT NULL COMMENT '接口文件名称',
  `description` varchar(80) DEFAULT NULL COMMENT '描述',
  `is_close` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否关闭;0开启,1关闭',
  `logo` varchar(80) DEFAULT NULL COMMENT 'logo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='认证方案';

-- --------------------------------------------------------

--
-- 表的结构 `zc_oauth_user`
--

CREATE TABLE IF NOT EXISTS `zc_oauth_user` (
  `id` int(11) unsigned NOT NULL,
  `oauth_user_id` varchar(80) NOT NULL COMMENT '第三方平台的用户唯一标识',
  `oauth_id` smallint(5) unsigned NOT NULL COMMENT 'oauth表关联平台id',
  `user_id` int(11) unsigned NOT NULL COMMENT '系统内部的用户id',
  `datetime` datetime NOT NULL COMMENT '绑定时间',
  PRIMARY KEY (`id`),
  KEY `oauth_user_id` (`oauth_user_id`,`oauth_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='oauth开发平台绑定用户表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_online_recharge`
--

CREATE TABLE IF NOT EXISTS `zc_online_recharge` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL COMMENT '用户id',
  `recharge_no` varchar(20) NOT NULL COMMENT '充值单号',
  `account` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '充值金额',
  `time` datetime NOT NULL COMMENT '时间',
  `payment_name` varchar(80) NOT NULL COMMENT '充值方式名称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '充值状态 0:未成功 1:充值成功',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='在线充值表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_order`
--

CREATE TABLE IF NOT EXISTS `zc_order` (
  `id` int(11) unsigned NOT NULL,
  `order_no` varchar(20) NOT NULL COMMENT '订单号',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `pay_type` int(11) NOT NULL COMMENT '用户支付方式ID,当为0时表示货到付款',
  `distribution` int(11) DEFAULT NULL COMMENT '用户选择的配送ID',
  `status` tinyint(1) DEFAULT '1' COMMENT '订单状态 1生成订单,2支付订单,3取消订单(客户触发),4作废订单(管理员触发),5完成订单,6退款,7部分退款',
  `pay_status` tinyint(1) DEFAULT '0' COMMENT '支付状态 0：未支付; 1：已支付;',
  `distribution_status` tinyint(1) DEFAULT '0' COMMENT '配送状态 0：未发送,1：已发送,2：部分发送',
  `accept_name` varchar(20) NOT NULL COMMENT '收货人姓名',
  `postcode` varchar(6) DEFAULT NULL COMMENT '邮编',
  `telphone` varchar(20) DEFAULT NULL COMMENT '联系电话',
  `country` int(11) DEFAULT NULL COMMENT '国ID',
  `province` int(11) DEFAULT NULL COMMENT '省ID',
  `city` int(11) DEFAULT NULL COMMENT '市ID',
  `area` int(11) DEFAULT NULL COMMENT '区ID',
  `address` varchar(250) DEFAULT NULL COMMENT '收货地址',
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机',
  `payable_amount` decimal(15,2) DEFAULT '0.00' COMMENT '应付商品总金额',
  `real_amount` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '实付商品总金额',
  `payable_freight` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '总运费金额',
  `real_freight` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '实付运费',
  `pay_time` datetime DEFAULT NULL COMMENT '付款时间',
  `send_time` datetime DEFAULT NULL COMMENT '发货时间',
  `create_time` datetime DEFAULT NULL COMMENT '下单时间',
  `completion_time` datetime DEFAULT NULL COMMENT '订单完成时间',
  `invoice` tinyint(1) NOT NULL DEFAULT '0' COMMENT '发票：0不索要1索要',
  `postscript` varchar(255) DEFAULT NULL COMMENT '用户附言',
  `note` text COMMENT '管理员备注',
  `if_del` tinyint(1) DEFAULT '0' COMMENT '是否删除1为删除',
  `insured` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '保价',
  `pay_fee` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '支付手续费',
  `invoice_title` varchar(100) DEFAULT NULL COMMENT '发票抬头',
  `taxes` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '税金',
  `promotions` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '促销优惠金额',
  `discount` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '订单折扣或涨价',
  `order_amount` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '订单总金额',
  `prop` varchar(255) DEFAULT NULL COMMENT '使用的道具id',
  `accept_time` varchar(80) DEFAULT NULL COMMENT '用户收货时间',
  `exp` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '增加的经验',
  `point` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '增加的积分',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0普通订单,1团购订单,2限时抢购',
  `trade_no` varchar(255) DEFAULT NULL COMMENT '支付平台交易号',
  `takeself` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '自提点ID',
  `checkcode` varchar(255) DEFAULT NULL COMMENT '自提方式的验证码',
  `active_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '促销活动ID',
  `seller_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商家ID',
  `is_checkout` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否给商家结算货款 0:未结算 1:已结算',
  PRIMARY KEY (`id`),
  KEY `if_del` (`if_del`),
  KEY `order_no` (`order_no`),
  KEY `user_id` (`user_id`),
  KEY `seller_id` (`seller_id`),
  KEY `status` (`status`),
  KEY `order_amount` (`order_amount`),
  KEY `completion_time` (`completion_time`),
  KEY `send_time` (`send_time`),
  KEY `create_time` (`create_time`),
  KEY `distribution_status` (`distribution_status`),
  KEY `pay_status` (`pay_status`),
  KEY `accept_name` (`accept_name`),
  KEY `is_checkout` (`is_checkout`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_order_goods`
--

CREATE TABLE IF NOT EXISTS `zc_order_goods` (
  `id` int(11) unsigned NOT NULL,
  `order_id` int(11) unsigned NOT NULL COMMENT '订单ID',
  `goods_id` int(11) unsigned NOT NULL COMMENT '商品ID',
  `img` varchar(255) NOT NULL COMMENT '商品图片',
  `product_id` int(11) unsigned DEFAULT '0' COMMENT '货品ID',
  `goods_price` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '商品原价',
  `real_price` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '实付金额',
  `goods_nums` int(11) NOT NULL DEFAULT '1' COMMENT '商品数量',
  `goods_weight` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '重量',
  `goods_array` text COMMENT '商品和货品名称name和规格value串json数据格式',
  `is_send` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已发货 0:未发货;1:已发货;2:已经退货',
  `delivery_id` int(11) NOT NULL DEFAULT '0' COMMENT '配送单ID',
  `seller_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商家ID',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单商品表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_order_log`
--

CREATE TABLE IF NOT EXISTS `zc_order_log` (
  `id` int(11) unsigned NOT NULL,
  `order_id` int(11) unsigned DEFAULT NULL COMMENT '订单id',
  `user` varchar(20) DEFAULT NULL COMMENT '操作人：顾客或admin或seller',
  `action` varchar(20) DEFAULT NULL COMMENT '动作',
  `addtime` datetime DEFAULT NULL COMMENT '添加时间',
  `result` varchar(10) DEFAULT NULL COMMENT '操作的结果',
  `note` varchar(100) DEFAULT NULL COMMENT '备注',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单日志表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_payment`
--

CREATE TABLE IF NOT EXISTS `zc_payment` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '支付名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:线上、2:线下',
  `class_name` varchar(50) NOT NULL COMMENT '支付类名称',
  `description` text COMMENT '描述',
  `logo` varchar(255) NOT NULL COMMENT '支付方式logo图片路径',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '安装状态 0启用 1禁用',
  `order` smallint(5) NOT NULL DEFAULT '99' COMMENT '排序',
  `note` text COMMENT '支付说明',
  `poundage` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '手续费',
  `poundage_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '手续费方式 1百分比 2固定值',
  `config_param` text COMMENT '配置参数,json数据对象',
  `client_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:PC端 2:移动端 3:通用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='支付方式表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_plugin`
--

CREATE TABLE IF NOT EXISTS `zc_plugin` (
  `id` int(11) unsigned NOT NULL COMMENT '插件ID',
  `name` varchar(255) NOT NULL COMMENT '插件名称',
  `class_name` varchar(255) NOT NULL COMMENT '插件类库名称',
  `config_param` text COMMENT '配置参数',
  `description` text COMMENT '描述说明',
  `is_open` tinyint(1) NOT NULL DEFAULT '1' COMMENT '安装状态 0禁用 1启用',
  `sort` smallint(5) NOT NULL DEFAULT '99' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `class_name` (`class_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='插件表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_point_log`
--

CREATE TABLE IF NOT EXISTS `zc_point_log` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL COMMENT '用户id',
  `datetime` datetime NOT NULL COMMENT '发生时间',
  `value` int(11) NOT NULL COMMENT '积分增减 增加正数 减少负数',
  `intro` varchar(50) NOT NULL COMMENT '积分改动说明',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='积分增减记录表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_products`
--

CREATE TABLE IF NOT EXISTS `zc_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goods_id` int(11) unsigned NOT NULL COMMENT '货品ID',
  `products_no` varchar(20) NOT NULL COMMENT '货品的货号(以商品的货号加横线加数字组成)',
  `spec_array` text COMMENT 'json规格数据',
  `store_nums` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `market_price` decimal(15,2) DEFAULT '0.00' COMMENT '市场价格',
  `sell_price` decimal(15,2) DEFAULT '0.00' COMMENT '销售价格',
  `cost_price` decimal(15,2) DEFAULT '0.00' COMMENT '成本价格',
  `weight` decimal(15,2) DEFAULT '0.00' COMMENT '重量',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='货品表' AUTO_INCREMENT=43 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_promotion`
--

CREATE TABLE IF NOT EXISTS `zc_promotion` (
  `id` int(11) unsigned NOT NULL,
  `start_time` datetime NOT NULL COMMENT '开始时间',
  `end_time` datetime NOT NULL COMMENT '结束时间',
  `sort` smallint(5) NOT NULL COMMENT '顺序',
  `condition` text NOT NULL COMMENT '活动生效条件 当type=0<促销规则消费额度>,当type=1<限时抢购商品ID>,type=2<特价商品分类ID>,type=3<特价商品ID>,type=4<特价商品品牌ID>',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '活动类型 0:购物车促销规则 1:商品限时抢购 2:商品分类特价 3:商品单品特价 4:商品品牌特价',
  `award_value` varchar(255) DEFAULT NULL COMMENT '奖励值 type=0<奖励值>,type=1<抢购价格>,type=2,3,4<特价折扣>',
  `name` varchar(20) NOT NULL COMMENT '活动名称',
  `intro` text COMMENT '活动介绍',
  `award_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '奖励方式:0商品限时抢购 1减金额 2奖励折扣 3赠送积分 4赠送代金券 5赠送赠品 6免运费 7,商品特价',
  `is_close` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否关闭 0:否 1:是',
  `user_group` text COMMENT '允许参与活动的用户组,all表示所有用户组',
  `seller_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商家ID',
  PRIMARY KEY (`id`),
  KEY `type` (`type`,`seller_id`),
  KEY `start_time` (`start_time`,`end_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='记录促销活动的表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_prop`
--

CREATE TABLE IF NOT EXISTS `zc_prop` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '道具名称',
  `card_name` varchar(32) DEFAULT NULL COMMENT '道具的卡号',
  `card_pwd` varchar(32) DEFAULT NULL COMMENT '道具的密码',
  `start_time` datetime NOT NULL COMMENT '开始时间',
  `end_time` datetime NOT NULL COMMENT '结束时间',
  `value` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '面值',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '道具类型 0:代金券',
  `condition` varchar(255) DEFAULT NULL COMMENT '条件数据 type=0时,表示ticket的表id,模型id',
  `is_close` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否关闭 0:正常,1:关闭,2:下订单未支付时临时锁定',
  `img` varchar(255) DEFAULT NULL COMMENT '道具图片',
  `is_userd` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否被使用过 0:未使用,1:已使用',
  `is_send` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否被发送过 0:否 1:是',
  `seller_id` int(11) unsigned DEFAULT '0' COMMENT '所属商户ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='道具表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_quick_naviga`
--

CREATE TABLE IF NOT EXISTS `zc_quick_naviga` (
  `id` int(11) unsigned NOT NULL,
  `admin_id` int(11) unsigned NOT NULL COMMENT '管理员id',
  `naviga_name` varchar(255) NOT NULL COMMENT '导航名称',
  `url` varchar(255) NOT NULL COMMENT '导航链接',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否删除1为删除',
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员快速导航';

-- --------------------------------------------------------

--
-- 表的结构 `zc_refer`
--

CREATE TABLE IF NOT EXISTS `zc_refer` (
  `id` int(11) unsigned NOT NULL,
  `question` text NOT NULL COMMENT '咨询内容',
  `user_id` int(11) unsigned DEFAULT NULL COMMENT '咨询人会员ID，非会员为空',
  `goods_id` int(11) unsigned NOT NULL COMMENT '产品ID',
  `answer` text COMMENT '回复内容',
  `admin_id` int(11) unsigned DEFAULT '0' COMMENT '回复的管理员ID',
  `seller_id` int(11) unsigned DEFAULT '0' COMMENT '回复的商户ID',
  `status` tinyint(1) DEFAULT '0' COMMENT '0：待回复 1已回复',
  `time` datetime DEFAULT NULL COMMENT '咨询时间',
  `reply_time` datetime DEFAULT NULL COMMENT '回复时间',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `goods_id` (`goods_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='咨询表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_refundment_doc`
--

CREATE TABLE IF NOT EXISTS `zc_refundment_doc` (
  `id` int(11) unsigned NOT NULL,
  `order_no` varchar(20) NOT NULL DEFAULT '' COMMENT '订单号',
  `order_id` int(11) unsigned NOT NULL COMMENT '订单id',
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `amount` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '退款金额',
  `time` datetime DEFAULT NULL COMMENT '时间',
  `admin_id` int(11) unsigned DEFAULT NULL COMMENT '管理员id',
  `pay_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '退款状态,0:申请退款 1:退款失败 2:退款成功',
  `content` text COMMENT '申请退款原因',
  `dispose_time` datetime DEFAULT NULL COMMENT '处理时间',
  `dispose_idea` text COMMENT '处理意见',
  `if_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未删除 1:删除',
  `order_goods_id` text COMMENT '订单与商品关联ID集合',
  `seller_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商家ID',
  `way` varchar(20) NOT NULL DEFAULT '' COMMENT '退款方式,balance:用户余额 other:其他方式 origin:原路退回',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `if_del` (`if_del`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='退款单';

-- --------------------------------------------------------

--
-- 表的结构 `zc_regiment`
--

CREATE TABLE IF NOT EXISTS `zc_regiment` (
  `id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '团购标题',
  `start_time` datetime NOT NULL COMMENT '开始时间',
  `end_time` datetime NOT NULL COMMENT '结束时间',
  `store_nums` int(11) NOT NULL DEFAULT '0' COMMENT '库存量',
  `sum_count` int(11) NOT NULL DEFAULT '0' COMMENT '已销售量',
  `limit_min_count` int(11) NOT NULL DEFAULT '0' COMMENT '每人限制最少购买数量',
  `limit_max_count` int(11) NOT NULL DEFAULT '0' COMMENT '每人限制最多购买数量',
  `intro` varchar(255) DEFAULT NULL COMMENT '介绍',
  `is_close` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否关闭',
  `regiment_price` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '团购价格',
  `sell_price` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '原来价格',
  `goods_id` int(11) unsigned NOT NULL COMMENT '关联商品id',
  `img` varchar(255) DEFAULT NULL COMMENT '商品图片',
  `sort` smallint(5) NOT NULL DEFAULT '99' COMMENT '排序',
  `seller_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商家ID',
  PRIMARY KEY (`id`),
  KEY `is_close` (`is_close`,`start_time`,`end_time`),
  KEY `goods_id` (`goods_id`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='团购';

-- --------------------------------------------------------

--
-- 表的结构 `zc_relation`
--

CREATE TABLE IF NOT EXISTS `zc_relation` (
  `id` int(11) unsigned NOT NULL,
  `goods_id` int(11) unsigned NOT NULL COMMENT '商品ID',
  `article_id` int(11) unsigned NOT NULL COMMENT '文章ID',
  PRIMARY KEY (`id`),
  KEY `goods_id` (`goods_id`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章商品关系表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_right`
--

CREATE TABLE IF NOT EXISTS `zc_right` (
  `id` int(10) NOT NULL,
  `name` varchar(80) NOT NULL COMMENT '权限名字',
  `right` text COMMENT '权限码(控制器+动作)',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '删除状态 1删除,0正常',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限资源码';

-- --------------------------------------------------------

--
-- 表的结构 `zc_search`
--

CREATE TABLE IF NOT EXISTS `zc_search` (
  `id` int(11) unsigned NOT NULL,
  `keyword` varchar(255) NOT NULL COMMENT '搜索关键字',
  `num` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '搜索次数',
  PRIMARY KEY (`id`),
  KEY `keyword` (`keyword`(12))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='搜索关键字';

-- --------------------------------------------------------

--
-- 表的结构 `zc_seller`
--

CREATE TABLE IF NOT EXISTS `zc_seller` (
  `id` int(11) unsigned NOT NULL,
  `seller_name` varchar(80) NOT NULL COMMENT '商家登录用户名',
  `password` char(32) NOT NULL COMMENT '商家密码',
  `create_time` datetime DEFAULT NULL COMMENT '加入时间',
  `login_time` datetime DEFAULT NULL COMMENT '最后登录时间',
  `is_vip` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否是特级商家',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未删除,1:已删除',
  `is_lock` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未锁定,1:已锁定',
  `true_name` varchar(80) NOT NULL COMMENT '商家真实名称',
  `email` varchar(255) NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `mobile` varchar(20) NOT NULL COMMENT '手机号码',
  `phone` varchar(20) NOT NULL COMMENT '座机号码',
  `paper_img` varchar(255) DEFAULT NULL COMMENT '执照证件照片',
  `cash` decimal(15,2) DEFAULT NULL COMMENT '保证金',
  `country` int(11) unsigned DEFAULT NULL COMMENT '国ID',
  `province` int(11) unsigned NOT NULL COMMENT '省ID',
  `city` int(11) unsigned NOT NULL COMMENT '市ID',
  `area` int(11) unsigned NOT NULL COMMENT '区ID',
  `address` varchar(255) NOT NULL COMMENT '地址',
  `account` text COMMENT '收款账号信息',
  `server_num` varchar(20) DEFAULT NULL COMMENT '客服号码',
  `home_url` varchar(255) DEFAULT NULL COMMENT '企业URL网站',
  `sort` smallint(5) NOT NULL DEFAULT '99' COMMENT '排序',
  `tax` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '税率',
  `seller_message_ids` text COMMENT '商户消息ID',
  `grade` int(11) NOT NULL DEFAULT '0' COMMENT '评分总数',
  `sale` int(11) NOT NULL DEFAULT '0' COMMENT '总销量',
  `comments` int(11) NOT NULL DEFAULT '0' COMMENT '评论次数',
  PRIMARY KEY (`id`),
  UNIQUE KEY `seller_name` (`seller_name`),
  KEY `seller_name_2` (`seller_name`,`password`),
  KEY `true_name` (`true_name`),
  KEY `is_vip` (`is_vip`),
  KEY `is_del` (`is_del`),
  KEY `is_lock` (`is_lock`),
  KEY `email` (`email`),
  KEY `sort` (`sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商家表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_seller_message`
--

CREATE TABLE IF NOT EXISTS `zc_seller_message` (
  `id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `content` text COMMENT '内容',
  `time` datetime NOT NULL COMMENT '发送时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商家消息';

-- --------------------------------------------------------

--
-- 表的结构 `zc_spec`
--

CREATE TABLE IF NOT EXISTS `zc_spec` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '规格名称',
  `value` text COMMENT '规格值',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '显示类型 1文字 2图片',
  `note` varchar(255) DEFAULT NULL COMMENT '备注说明',
  `is_del` tinyint(1) DEFAULT '0' COMMENT '是否删除1删除',
  `seller_id` int(11) DEFAULT '0' COMMENT '商家ID',
  PRIMARY KEY (`id`),
  KEY `is_del` (`is_del`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='规格表' AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_spec_photo`
--

CREATE TABLE IF NOT EXISTS `zc_spec_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) DEFAULT NULL COMMENT '图片地址',
  `name` varchar(100) DEFAULT NULL COMMENT '图片名称',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='规格图片表' AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_suggestion`
--

CREATE TABLE IF NOT EXISTS `zc_suggestion` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `time` datetime DEFAULT NULL COMMENT '提问时间',
  `admin_id` int(11) unsigned DEFAULT NULL COMMENT '管理员ID',
  `re_content` text COMMENT '回复内容',
  `re_time` datetime DEFAULT NULL COMMENT '回复时间',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='意见箱表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_takeself`
--

CREATE TABLE IF NOT EXISTS `zc_takeself` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL COMMENT '名称',
  `sort` smallint(5) NOT NULL DEFAULT '99' COMMENT '排序',
  `province` int(11) NOT NULL COMMENT '省份ID',
  `city` int(11) NOT NULL COMMENT '城市ID',
  `area` int(11) NOT NULL COMMENT '地区ID',
  `address` varchar(255) NOT NULL COMMENT '地址',
  `phone` varchar(30) DEFAULT NULL COMMENT '座机号码',
  `mobile` varchar(30) DEFAULT NULL COMMENT '手机号码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品物流自提地点';

-- --------------------------------------------------------

--
-- 表的结构 `zc_task`
--

CREATE TABLE IF NOT EXISTS `zc_task` (
  `id` int(11) NOT NULL,
  `title` text,
  `price` text,
  `thumb` text,
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1成功，2失败',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `zc_ticket`
--

CREATE TABLE IF NOT EXISTS `zc_ticket` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(50) NOT NULL COMMENT '代金券名称',
  `value` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '代金券面额值',
  `start_time` datetime DEFAULT NULL COMMENT '开始时间',
  `end_time` datetime DEFAULT NULL COMMENT '结束时间',
  `point` smallint(5) NOT NULL DEFAULT '0' COMMENT '兑换优惠券所需积分,如果是0表示禁止兑换',
  `seller_id` int(11) unsigned DEFAULT '0' COMMENT '卖家ID',
  PRIMARY KEY (`id`),
  KEY `start_time` (`start_time`,`end_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='代金券类型表';

-- --------------------------------------------------------

--
-- 表的结构 `zc_user`
--

CREATE TABLE IF NOT EXISTS `zc_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_id` int(11) DEFAULT '0',
  `nickname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `phone` (`phone`),
  KEY `card_id` (`card_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `zc_user_group`
--

CREATE TABLE IF NOT EXISTS `zc_user_group` (
  `id` int(11) unsigned NOT NULL COMMENT '用户组ID',
  `group_name` varchar(20) NOT NULL COMMENT '组名',
  `discount` decimal(15,2) NOT NULL DEFAULT '100.00' COMMENT '折扣率',
  `minexp` int(11) DEFAULT NULL COMMENT '最小经验',
  `maxexp` int(11) DEFAULT NULL COMMENT '最大经验',
  `message_ids` varchar(255) DEFAULT NULL COMMENT '消息ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户组';

-- --------------------------------------------------------

--
-- 表的结构 `zc_withdraw`
--

CREATE TABLE IF NOT EXISTS `zc_withdraw` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL COMMENT '用户ID',
  `time` datetime NOT NULL COMMENT '时间',
  `amount` decimal(15,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `name` varchar(255) NOT NULL COMMENT '开户姓名',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '-1失败,0未处理,1处理中,2成功',
  `note` varchar(255) DEFAULT NULL COMMENT '用户备注',
  `re_note` varchar(255) DEFAULT NULL COMMENT '回复备注信息',
  `is_del` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0未删除,1已删除',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='提现记录';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE IF NOT EXISTS `zc_exend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `band` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pinhao` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pinming` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `danwei` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guige` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gongyi` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gongyingshang` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pricetotal` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chuchangjia` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kucun` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kucun79` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kucun49` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kucun19` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fenlei` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `miaoshu` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `zc_exprice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gongyingshang` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `xinpinghao` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jiupinghao` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gongyingshangxinghao` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guige` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `danwei` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `priceTotal` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `daohuoriqi` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `beizhu` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
