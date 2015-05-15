<?php

namespace ericmaicon\repository\db;

use ericmaicon\repository\BaseRepository;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class DbRepository extends BaseRepository
{
    public $db;

    /**
     * @inheritdoc
     *
     * @throws \yii\base\NotSupportedException
     */
    public function init()
    {
        if(count($this->tables) < 1) {
            $schema = $this->getDb()->getSchema();
            $this->tables = $schema->tableNames;
        }

        if(!Yii::$app->has($this->db)) {
            throw new InvalidParamException('The DB need to be filled and with a valid Connection');
        }

        parent::init();
    }

    /**
     * Return the repository Connection
     *
     * @return \yii\db\Connection
     * @throws \yii\base\InvalidConfigException
     */
    public function getDb()
    {
        return Yii::$app->get($this->db);
    }

    /**
     * @inheritdoc
     * @return Query the newly created [[ActiveQuery]] instance.
     */
    public function find($modelClass, $condition)
    {
        $tableName = $modelClass::tableName();

        $modelList = (new Query())
            ->from($tableName)
            ->where($condition)
            ->all($this->getDb());

        $returnArray = [];
        foreach($modelList as $model) {
            $modelInstance = new $modelClass;
            $modelInstance->setAttributes($model);
            $returnArray[] = $modelInstance;
        }

        return $returnArray;
    }

    /**
     * @inheritdoc
     */
    public function findOne($modelClass, $condition)
    {
        $tableName = $modelClass::tableName();

        $model = (new Query())
            ->from($tableName)
            ->where($condition)
            ->one($this->getDb());

        $modelInstance = new $modelClass;
        $modelInstance->setAttributes($model);

        return $modelInstance;
    }

    /**
     * @inheritdoc
     */
    public function findAll($modelClass, $condition)
    {
        $tableName = $modelClass::tableName();

        $modelList = (new Query())
            ->from($tableName)
            ->where($condition)
            ->all($this->getDb());

        $returnArray = [];
        foreach($modelList as $model) {
            $modelInstance = new $modelClass;
            $modelInstance->setAttributes($model);
            $returnArray[] = $modelInstance;
        }

        return $returnArray;
    }

    /**
     * @inheritdoc
     */
    public function save($model, $runValidation = true, $attributeNames = null)
    {
        $keys = $model->primaryKey();
        $isNewRecord = true;
        foreach($keys as $key) {
            $isNewRecord = ($model->$key === null);
        }

        if($isNewRecord)
            return $this->insert($model, $runValidation, $attributeNames);
        else
            return $this->update($model, $runValidation, $attributeNames);
    }

    /**
     * @inheritdoc
     */
    public function insert($model, $runValidation = true, $attributes = null)
    {
        if ($runValidation && !$model->validate($attributes)) {
            Yii::info('Model not inserted due to validation error.', __METHOD__);
            return false;
        }

        static::getDb()->createCommand()->insert($model->tableName(), $model->attributes)->execute();
        return true;
    }

    /**
     * @inheritdoc
     */
    public function update($model, $runValidation = true, $attributeNames = null)
    {
        if ($runValidation && !$model->validate($attributeNames)) {
            Yii::info('Model not updated due to validation error.', __METHOD__);
            return false;
        }

        $values = $model->attributes;

        $keys = $model->primaryKey();
        foreach ($keys as $name) {
            unset($values[$name]);
        }

        static::getDb()->createCommand()->update($model->tableName(), $values)->execute();
        return true;
    }

    /**
     * @inheritdoc
     */
    public function delete($model)
    {
        $condition = $this->getDeleteCondition($model, true);
        static::getDb()->createCommand()->delete($model->tableName(), $condition)->execute();
        return true;
    }

    /**
     * This method is present on yii\base\ActiveRecord as getOldPrimaryKey()
     *
     * @param \ericmaicon\repository\model\RepositoryModel $model
     * @param boolean $asArray
     * @return array|null
     * @throws Exception
     */
    private function getDeleteCondition($model, $asArray = false)
    {
        $keys = $model->primaryKey();
        if (empty($keys)) {
            throw new Exception(get_class($this) . ' does not have a primary key. You should either define a primary key for the corresponding table or override the primaryKey() method.');
        }
        if (!$asArray && count($keys) === 1) {
            return isset($model->attributes[$keys[0]]) ? $model->attributes[$keys[0]] : null;
        } else {
            $values = [];
            foreach ($keys as $name) {
                $values[$name] = isset($model->attributes[$name]) ? $model->attributes[$name] : null;
            }

            return $values;
        }
    }

}
