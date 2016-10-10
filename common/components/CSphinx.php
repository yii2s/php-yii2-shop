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
 * @package common\components
 */
class CSphinx extends Component
{
    public $cl;
    public $port = SPHINX_PORT;
    public $host = SPHINX_HOST;

    public $criteria = [
        'index' => '*',
        'keyword' => '',
        'limit' => 10,
        'offset' => 0,
        'matchMaxNum' => 1000,
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
        $this->cl->SetConnectTimeout ( 3 );
        $this->cl->SetArrayResult ( true );
        $this->cl->SetMatchMode (SPH_MATCH_ANY);
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
     * 查询语句
     * @return array
     * @since 2016-10-10
     */
    public function query()
    {
        $this->cl->setLimits($this->criteria['offset'], $this->criteria['limit'], $this->criteria['matchMaxNum']);
        $result = $this->cl->Query($this->criteria['keyword'], $this->criteria['index']);
        if (false === $result) {
            return [];
        } else {
            return $this->_packagingData($result);
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
        $data['total'] = $result['total']; //total_found是匹配数，total是返回的结果数，这个结果数受到max_matches限制
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
                $data['data'][] = $temp;
            }
        }

        return $data;
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
        if (array_key_exists($name, $this->criteria)) {
            $this->criteria[$name] = $params[0];
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