<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%wzc_categories}}".
 *
 * @property string $id
 * @property string $title
 * @property integer $pid
 * @property integer $level
 * @property string $lft
 * @property string $rgt
 * @property string $path
 * @property string $sort
 * @property integer $status
 */
class Categories extends ActiveRecord
{
    const STATUS = 0; //Ĭ��״̬
    const SORT = 0; //Ĭ������

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wzc_categories}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'level', 'lft', 'rgt'], 'required'],
            [['pid', 'level', 'lft', 'rgt', 'sort', 'status'], 'integer'],
            [['title'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'pid' => 'Pid',
            'level' => 'Level',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'sort' => 'Sort',
            'status' => 'Status',
        ];
    }

    /**
     * ��ӷ���
     * @link http://blog.csdn.net/MONKEY_D_MENG/article/details/6647488
     * @param array $data
     *      array(
     *          'pid'   => '����ID'
     *          'title' => '����',
     *          'sort'  => '����',
     *      )
     * @return bool
     * @since 2016-03-12
     */
    public function addCategory($data)
    {
        if (!($data['pid'] && $data['title'])) {
            return false;
        }
        $parentCategory = self::findOne($data['pid']);
        if (!$parentCategory) {
            return false;
        }
        $this->updateNodesAfterInsert($parentCategory->rgt);
        $lft = $parentCategory->rgt;
        $rgt = $lft + 1;
        $this->title = $data['title'];
        $this->level = $this->getNodeLevel($lft,$rgt);
        $this->lft = $lft;
        $this->rgt = $rgt;
        $this->pid = $parentCategory->id;
        $this->sort = $data['sort'] ?: self::SORT;
        $this->status = $data['status'] ?: self::STATUS;
        $this->save();
        self::updateAll(['path'=>$parentCategory->path.'-'.$this->id],'id=:id',[':id'=>$this->id]);
        return true;

    }

    /**
     * ɾ������
     * @link http://blog.csdn.net/MONKEY_D_MENG/article/details/6647488
     * @param $id
     * @return bool
     * @since 2016-03-12
     */
    public function deleteCategory($id)
    {
        if (!$id) {
            return false;
        }
        $category = self::findOne($id);
        if (!$category) {
            return false;
        }
        self::deleteAll('lft>=:lft AND rgt<=:rgt',[
            ':lft' => $category->lft,
            ':rgt' => $category->rgt,
        ]);
        $this->updateNodesAfterDelete($category->lft,$category->rgt);
        return true;
    }

    /**
     * ��������ֵ��ȡ�ڵ�Ĳ��
     * @param $lft
     * @param $rgt
     * @return int|string
     * @since 2016-03-12
     */
    public function getNodeLevel($lft,$rgt)
    {
        return self::find()->where('lft<:lft AND rgt>:rgt',[
            ':lft' => $lft,
            ':rgt' => $rgt,
        ])->count();
    }

    /**
     * ����һ���½ڵ�ʱ,�������нڵ�
     * @param $rgt
     * @since 2016-03-12
     */
    public function updateNodesAfterInsert($rgt)
    {
        self::updateAllCounters(['rgt' => 2],'rgt>=:rgt',[':rgt' => $rgt]);
        self::updateAllCounters(['lft' => 2],'lft>=:rgt',[':rgt' => $rgt]);
    }

    /**
     * ɾ��һ���½ڵ�ʱ,�������нڵ�
     * @param $lft
     * @param $rgt
     * @since 2016-03-12
     */
    public function updateNodesAfterDelete($lft,$rgt)
    {
        $value = -($rgt - $lft + 1);
        self::updateAllCounters(['rgt' => $value],'rgt>:rgt',[':rgt' => $rgt]);
        self::updateAllCounters(['lft' => $value],'lft>:lft',[':lft' => $lft]);
    }

    /**
     * ��ȡ�����б�
     * @link http://blog.csdn.net/MONKEY_D_MENG/article/details/6647488
     * @param array $args
     *      array(
     *          'id'          => '��ID', ��ȡ��ID�µ��������ࣨ������ࣩ
     *          'level'       => '�㼶', ��ȡָ���ò㼶��������
     *          'status'      => '״̬', 0��ʾ���ã�1���ã�Ĭ�Ͽ��ã�
     *          'select'      => '��ѯ�ֶ�', a string (e.g. "id, name") or an array (e.g. ['id', 'name'])
     *          'orderBy'     => '����',  e.g. path ASC
     *          'isReturnArr' => '��������', �Ƿ񷵻����飨Ĭ�Ϸ��ض���
     *      )
     * @return array|object
     * @since 2016-03-12
     */
    public function getCategoriesList($args = array())
    {
        $object = self::find();
        if ($args['id'] && is_numeric($args['id'])) {
            $category = self::findOne($args['id']);
            if ($category) {
                $object->andWhere(['>','lft',$category->lft]);
                $object->andWhere(['<','rgt',$category->rgt]);
            }
        }
        if ($args['level'] && is_numeric($args['level'])) {
            $object->andWhere('level = :level',[':level' => $args['level']]);
        }
        if ($args['status']) {
            $object->andWhere('status = :status',[':status' => $args['status']]);
        }
        if ($args['isReturnArr']) {
            $object->asArray();
        }
        if ($args['orderBy']) {
            $object->orderBy($args['orderBy']);
        }
        if ($args['select']) {
            $object->select($args['select']);
        }
        return $object->all();
    }

    /**
     * ��ȡ���ࣨ����json���ݣ�
     * @param $args
     * @return string
     * @since 2016-03-12
     */
    public function getListJson($args = array())
    {
        $result = [];
        $categories = $this->getCategoriesList($args);
        if ($categories) {
            foreach ($categories as $c) {
                $arr['id'] = $c->id;
                $arr['pId'] = $c->pid;
                $arr['name'] = $c->title;
                $result[] = $arr;
            }
        }
        return json_encode($result);
    }

    public function getList()
    {

    }
}
