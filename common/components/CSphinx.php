<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2016/9/13
 * Time: 8:39
 */

namespace common\components;


use SphinxClient;
use Yii;
use yii\base\Component;

include "./common/components/sphinxapi.php";

/**
 * Class CSphinx
 * you can use as follow:
 *
 * 1, Yii::$app->sphinx->index('goods')
 *              ->offset(0)
 *              ->limit(10)
 *              ->query('搜索关键字');
 *
 *
 * 2， Yii::$app->sphinx->criteria(
 *        [
 *             'index' => 'goods',
 *             'offset' => 0,
 *             'limit' => 10
 *        ]
 *      )->query();
 *
 *
 * @method CSphinx index(string $index = '')
 * @method CSphinx keyword(string $keyword = '')
 * @method CSphinx offset(int $offset = 0)
 * @method CSphinx limit(int $limit = 10)
 * @method CSphinx matchMaxNum(int $matchMaxNum = 1000)
 * @package common\components
 */
class CSphinx extends Component
{
    public $cl;
    public $port = SPHINX_PORT;
    public $host = SPHINX_HOST;

    private $_criteria = [
        'index'       => '*',
        'keyword'     => '',
        'limit'       => 10,
        'offset'      => 0,
        'matchMaxNum' => 1000,
        'filter'      => [],
        'timeout'     => 3,
        'arrResult'   => true,
        'matchMode'   => SPH_MATCH_ANY,
        'maxQueryTime'=> 0,
        'highlight'   => true
    ];

    public function __construct()
    {
        $this->cl = new SphinxClient();
        if ($this->cl == false) {
            return false;
        }

        parent::__construct();
    }

    /**
     * Initializes CSphinx.
     */
    public function init()
    {
        parent::init();

        $this->cl->SetServer($this->host, (int)$this->port);
        $this->cl->SetConnectTimeout($this->_criteria['timeout']);
        $this->cl->SetArrayResult($this->_criteria['arrResult']);
        $this->cl->SetMatchMode($this->_criteria['matchMode']);
        $this->cl->SetMaxQueryTime($this->_criteria['maxQueryTime']);
    }

    /**
     * 最后一次错误
     * @return string
     * @since 2016-10-10
     */
    public function getLastError()
    {
        return $this->cl->GetLastError();
    }

    /**
     * 最后一次警告
     * @since 2016-10-10
     */
    public function getLastWarning()
    {
        $this->cl->GetLastWarning();
    }

    /**
     * 查询条件
     * @param array $params
     * @return $this
     */
    public function criteria(array $params = [])
    {
        if (empty($params) || !is_array($params)) {
            return $this;
        }

        foreach ($params as $key => $val) {
            if (isset($this->_criteria[$key])) {
                $this->_criteria[$key] = $val;
            }
        }
        return $this;
    }

    /**
     * 查询语句
     * @param $keyword
     * @return array
     * @since 2016-10-10
     */
    public function query($keyword = null)
    {

        $this->_setLimits();
        $this->_setFilter();
        
        $result = $this->cl->Query($keyword ?: $this->_criteria['keyword'], $this->_criteria['index']);
        if (false === $result) {
            return [];
        } else {
            return $this->_packagingData($result);
        }
    }

    /**
     * 设置分页
     * @since 2016-10-10
     */
    private function _setLimits()
    {
        $this->cl->setLimits($this->_criteria['offset'], $this->_criteria['limit'], $this->_criteria['matchMaxNum']);
    }

    /**
     * 过滤属性值
     * <pre>
     * [
     *      'filter' => [
     *          'typeID' => 1,
     *          'categoryID' => [2],
     *      ],
     * ]
     * @since 2016-10-11
     */
    private function _setFilter()
    {
        if ($this->_criteria['filter'] && is_array($this->_criteria['filter'])) {
            foreach ($this->_criteria['filter'] as $attribute => $values) {
                $this->cl->SetFilter($attribute, (array)$values);
            }
        }
    }

    /**
     * 包装返回数据
     * @param $result
     * @return array
     * @since 2016-10-10
     */
    private function _packagingData($result)
    {
        $data = [];
        $data['total'] = $result['total_found']; //total_found是匹配数，total是返回的结果数，这个total结果数受到max_matches限制
        $data['time'] = $result['time'];
        $data['keyword'] = $result['words'];

        $matches = $result['matches'];
        if ($matches) {
            foreach ($matches as $match) {
                $temp = [];
                $temp['id'] = $match['id'];
                foreach ($match['attrs'] as $key => $attr) {
                    $temp[$key] = $attr;
                }

                $data['data'][] = $this->_highlight($temp);
            }
        }

        return $data;
    }

    /**
     * 高亮显示
     * @param $data
     * @return array|bool
     */
    private function _highlight($data)
    {
        if (true === $this->_criteria['highlight']) {
            $opt =  ['before_match' => '<font style=\'font-weight:bold;color:#f00\'>', 'after_match' => '</font>'];
            return $this->cl->buildExcerpts($data, $this->_criteria['index'], $this->_criteria['keyword'], $opt);
        } else {
            return $data;
        }
    }

    /**
     * 重写父类魔术方法
     * @param string $name
     * @param array $params
     * @return $this|mixed
     * @throws UnknownMethodException
     * @since 2016-10-10
     */
    public function __call($name, $params)
    {
        if (array_key_exists($name, $this->_criteria)) {
            $this->_criteria[$name] = $params[0];
            return $this;
        }

        $this->ensureBehaviors();
        foreach ($this->_behaviors as $object) {
            if ($object->hasMethod($name)) {
                return call_user_func_array([$object, $name], $params);
            }
        }
        throw new UnknownMethodException('Calling unknown method: ' . get_class($this) . "::$name()");
    }
}