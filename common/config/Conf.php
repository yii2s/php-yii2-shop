<?php

namespace common\config;


class Conf
{
    /** 内容可用 */
    const ENABLE = 0;
    /** 内容不可用 */
    const DISABLE = 1;

    const GRADUATION_IMG = 1;
    const SHI_NEI_IMG = 2;
    const PING_MIAN_IMG = 3;
    const TAO_BAO_IMG = 4;

    /** 默认上传目录 */
    const UPLOAD_DEFAULT_DIR = 'uploads';
    const THUMB_DEFAULT = 'public/common/images/thumb_default.jpg';

    /** 数据为空默认图片提示 */
    const EMPTY_DATA = 'public/common/images/none_data.png';

    /** 以父类ID为键名进行分组的分类关联数组 */
    const CATEGORIES_MAP_CACHE = 'categories_map_cache_key';

    /** 经过排序后的分类数组 */
    const CATEGORIES_BY_SORT = 'categories_by_sort_key';

    /** 树形结构分类数组 */
    const CATEGORIES_TREE_CACHE = 'categories_tree_key';


}