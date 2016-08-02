CREATE TABLE IF NOT EXISTS `iwebshop_category` (
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
-- 属性表 `iwebshop_attr`
--
CREATE TABLE IF NOT EXISTS `iwebshop_attr` (
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '属性ID',
 `name` VARCHAR(50) NOT NULL COMMENT '属性名称',
 `status` tinyint(1) NOT NULL DEFAULT  '0' COMMENT '状态,0可用，1不可用',
 `sort` smallint(5) NOT NULL DEFAULT '0' COMMENT '排序',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='属性名称' AUTO_INCREMENT=1;

--
-- 类别与属性关联表 `iwebshop_category_attr_map`
--
CREATE TABLE IF NOT EXISTS `iwebshop_category_attr_map` (
 `id` INT(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
 `cid` INT(11) unsigned NOT NULL COMMENT '类别ID，对应category.id',
 `aid` INT(11) unsigned NOT NULL COMMENT '属性ID,对应attribute.id',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='类别与属性关联表' AUTO_INCREMENT=1;

--
-- 属性值表 `iwebshop_attr_value`
--
CREATE TABLE IF NOT EXISTS `iwebshop_attr_value` (
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
 `aid` int(11) unsigned NOT NULL COMMENT '属性ID，对应attribute.id',
 `value` VARCHAR(50) NOT NULL COMMENT '属性值',
 `status` tinyint(1) NOT NULL DEFAULT  '0' COMMENT '状态,0可用，1不可用',
 `sort` smallint(5) NOT NULL DEFAULT '0' COMMENT '排序',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='属性名称' AUTO_INCREMENT=1;

--
-- 类别与属性关联表 `iwebshop_attr_val_map`
--
CREATE TABLE IF NOT EXISTS `iwebshop_attr_val_map` (
 `id` INT(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
 `aid` INT(11) unsigned NOT NULL COMMENT '属性ID,对应attribute.id',
 `vid` INT(11) unsigned NOT NULL COMMENT '属性值ID，attr_value.id',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='属性与属性值关联表' AUTO_INCREMENT=1;

--
-- 类别，属性，属性值关联表 `iwebshop_category_attr_val_map`
--
CREATE TABLE IF NOT EXISTS `iwebshop_category_attr_val_map` (
 `id` INT(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
 `cid` INT(11) unsigned NOT NULL COMMENT '类别ID，对应category.id',
 `avid` INT(11) unsigned NOT NULL COMMENT '属性与属性值关联表主键ID,attr_val_map.id',
 `sort` smallint(5) NOT NULL DEFAULT '0' COMMENT '排序',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='属性与属性值关联表' AUTO_INCREMENT=1;

--
-- 商品与属性值关联表 `iwebshop_good_attr_value`
--
CREATE TABLE IF NOT EXISTS `iwebshop_good_attr_val_map` (
 `id` INT(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
 `gid` INT(11) unsigned NOT NULL COMMENT '商品ID,goods.id',
 `aid` INT(11) unsigned NOT NULL COMMENT '属性值ID，attr_value.id',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品与属性值关联表' AUTO_INCREMENT=1;