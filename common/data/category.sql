CREATE TABLE IF NOT EXISTS `zc_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `parent_id` int(11) unsigned NOT NULL COMMENT '父分类ID',
  `sort` smallint(5) NOT NULL DEFAULT '0' COMMENT '排序',
  `visibility` tinyint(1) NOT NULL DEFAULT '1' COMMENT '首页是否显示 1显示 0 不显示',
  `keywords` varchar(255) DEFAULT NULL COMMENT 'SEO关键词和检索关键词',
  `descript` varchar(255) DEFAULT NULL COMMENT 'SEO描述',
  `title` varchar(255) DEFAULT NULL COMMENT 'SEO标题title',
  `seller_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '商家ID',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`,`visibility`),
  KEY `sort` (`sort`),
  KEY `seller_id` (`seller_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='产品分类表' AUTO_INCREMENT=48 ;

--
-- 属性表 `zc_attr`
--
CREATE TABLE IF NOT EXISTS `zc_attr` (
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '属性ID',
 `name` VARCHAR(50) NOT NULL COMMENT '属性名称',
 `status` tinyint(1) NOT NULL DEFAULT  '0' COMMENT '状态,0可用，1不可用',
 `sort` smallint(5) NOT NULL DEFAULT '0' COMMENT '排序',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='属性名称' AUTO_INCREMENT=1;

--
-- 类别与属性关联表 `zc_category_attr_map`
--
CREATE TABLE IF NOT EXISTS `zc_category_attr_map` (
 `id` INT(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
 `cid` INT(11) unsigned NOT NULL COMMENT '类别ID，对应category.id',
 `aid` INT(11) unsigned NOT NULL COMMENT '属性ID,对应attribute.id',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='类别与属性关联表' AUTO_INCREMENT=1;

--
-- 属性值表 `zc_attr_value`
--
CREATE TABLE IF NOT EXISTS `zc_attr_value` (
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
 `aid` int(11) unsigned NOT NULL COMMENT '属性ID，对应attribute.id',
 `name` VARCHAR(50) NOT NULL COMMENT '属性值',
 `status` tinyint(1) NOT NULL DEFAULT  '0' COMMENT '状态,0可用，1不可用',
 `sort` smallint(5) NOT NULL DEFAULT '0' COMMENT '排序',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='属性名称' AUTO_INCREMENT=1;


--
-- 类别，属性，属性值关联表 `zc_category_attr_val_map`
--
CREATE TABLE IF NOT EXISTS `zc_category_attr_val_map` (
 `id` INT(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
 `cid` INT(11) unsigned NOT NULL COMMENT '类别ID，对应category.id',
 `aid` INT(11) unsigned NOT NULL COMMENT '属性ID,attr.id',
 `vid` INT(11) unsigned NOT NULL COMMENT '属性值ID,attr_value.id',
 `sort` smallint(5) NOT NULL DEFAULT '0' COMMENT '排序',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='属性与属性值关联表' AUTO_INCREMENT=1;

--
-- 商品与属性值关联表 `zc_good_attr_value`
--
CREATE TABLE IF NOT EXISTS `zc_good_attr_val_map` (
 `id` INT(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
 `gid` INT(11) unsigned NOT NULL COMMENT '商品ID,goods.id',
 `aid` INT(11) unsigned NOT NULL COMMENT '属性值ID，attr_value.id',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品与属性值关联表' AUTO_INCREMENT=1;

--
-- 网站设置
--
CREATE TABLE IF NOT EXISTS `zc_system_setting` (
  `id` INT (11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `set_key` VARCHAR (30) NOT NULL COMMENT '键名',
  `set_value` varchar(255) DEFAULT NULL COMMENT '值',
  `name` VARCHAR (50) NOT NULL COMMENT '名称',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='网站设置' AUTO_INCREMENT = 1;

--
-- 商品图集
--
CREATE TABLE IF NOT EXISTS `zc_goods_image` (
  `id` INT (11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `gid` INT(11) unsigned NOT NULL COMMENT '商品ID,goods.id',
  `img` varchar(255) DEFAULT NULL COMMENT '图像地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品图集' AUTO_INCREMENT = 1;

