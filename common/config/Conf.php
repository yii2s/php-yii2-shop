<?php

namespace common\config;


class Conf
{
    /** ���ݿ��� */
    const ENABLE = 0;
    /** ���ݲ����� */
    const DISABLE = 1;

    const GRADUATION_IMG = 1;
    const SHI_NEI_IMG = 2;
    const PING_MIAN_IMG = 3;
    const TAO_BAO_IMG = 4;

    /** Ĭ���ϴ�Ŀ¼ */
    const UPLOAD_DEFAULT_DIR = 'uploads';
    const THUMB_DEFAULT = 'public/common/images/thumb_default.jpg';

    /** ����Ϊ��Ĭ��ͼƬ��ʾ */
    const EMPTY_DATA = 'public/common/images/none_data.png';

    /** �Ը���IDΪ�������з���ķ���������� */
    const CATEGORIES_MAP_CACHE = 'categories_map_cache_key';

    /** ���������ķ������� */
    const CATEGORIES_BY_SORT = 'categories_by_sort_key';

    /** ���νṹ�������� */
    const CATEGORIES_TREE_CACHE = 'categories_tree_key';


}