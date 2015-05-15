<?php

namespace ericmaicon\repository;

use \yii\base\Model;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/**
 * Class RepositoryModel
 *
 * @package ericmaicon\repository
 */
class RepositoryModel extends Model
{
    private $_attributes;

    public function repository()
    {
        return null;
    }

    public function getRepository()
    {
        $repositoryName = $this->repository();
        return issset($repositoryName !== null ? $repositoryName : Yii::$app->repository->identifyRepository($this));
    }

    public function tableName()
    {
        return '{{%' . Inflector::camel2id(StringHelper::basename(get_called_class()), '_') . '}}';
    }

    public function attributes()
    {
        return array_keys(static::getTableSchema()->columns);
    }

    public function getAttribute($name)
    {
        return isset($this->_attributes[$name]) ? $this->_attributes[$name] : null;
    }

    public function setAttribute($name, $value)
    {
        if ($this->hasAttribute($name)) {
            $this->_attributes[$name] = $value;
        } else {
            throw new InvalidParamException(get_class($this) . ' has no attribute named "' . $name . '".');
        }
    }

    public function hasAttribute($name)
    {
        return isset($this->_attributes[$name]) || in_array($name, $this->attributes());
    }

}
