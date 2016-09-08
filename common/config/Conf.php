<?php

namespace common\config;


class Conf
{
    /** 审核通过 */
    const ENABLE = 0;
    /** 审核不通过 */
    const DISABLE = 1;

    /** ???????? */
    const UPLOAD_DEFAULT_DIR = 'uploads';
    const THUMB_DEFAULT = 'public/common/images/thumb_default.jpg';
    /** ??????????????? */
    const EMPTY_DATA = 'public/common/images/none_data.png';
    /** ?????ID????????з?????????????? */
    const CATEGORIES_MAP_CACHE = 'categories_map_cache_key';
    /** ????????????????? */
    const CATEGORIES_BY_SORT = 'categories_by_sort_key';
    /** ???ν????????? */
    const CATEGORIES_TREE_CACHE = 'categories_tree_key';
    /** 品牌属性ID */
    const BRAND_ATTR_ID = 1;

    /** 下架商品 */
    const DOWN_GOODS = 2;
    /** 上架商品 */
    const UP_GOODS = 3;

    /** 水印图片 */
    const WATER_MARK = 'water_mark.png';
    /** 图片水印标识 */
    const IMG_WATER = 'water';
    /** 图片裁剪标识 */
    const IMG_CROP = 'crop';
    /** 图片缩略图标识 */
    const IMG_THUMB = 'thumb';

    /** 推荐商品 */
    const GOODS_RECOMMEND = 4;

    /** 收藏 */
    const ADD_FAVORITE = 1;
    /** 取消收藏 */
    const DEL_FAVORITE = 2;

    /** 最新商品 */
    const NEWEST_GOODS = 1;
    /** 特价 */
    const BARGAIN_PRICE = 2;
    /** 热卖 */
    const HOT_SALE = 3;
    /** 推荐 */
    const RECOMMEND = 4;



}