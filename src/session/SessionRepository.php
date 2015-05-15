<?php

namespace ericmaicon\repository\session;

use ericmaicon\repository\BaseRepository;
use Yii;
use yii\base\Exception;

/**
 * Class SessionRepository
 *
 * @package ericmaicon\repository\session
 */
class SessionRepository extends BaseRepository
{

    /**
     * @inheritdoc
     * @throws Exception
     */
    public function find($modelClass, $condition)
    {
        throw new Exception("Method find not implemented");
    }

    /**
     * @inheritdoc
     */
    public function findOne($modelClass, $condition)
    {
        return Yii::$app->session->get($condition);
    }

    /**
     * @inheritdoc
     */
    public function findAll($modelClass, $condition)
    {
        throw new Exception("Method findAll not implemented");
    }

    /**
     * @inheritdoc
     */
    public function save($model, $runValidation = true, $attributeNames = null)
    {
        if(isset($model->id))
            return $this->insert($model, $runValidation, $attributeNames);
        else
            return $this->update($model, $runValidation, $attributeNames);
    }

    /**
     * @inheritdoc
     */
    public function insert($model, $runValidation = true, $attributes = null)
    {
        $sessionName = get_class($model);
        $model->id = Yii::$app->session->getId();
        Yii::$app->session->set($sessionName . "_" . $model->id, $model);
        return true;
    }

    /**
     * @inheritdoc
     */
    public function update($model, $runValidation = true, $attributeNames = null)
    {
        $sessionName = get_class($model);
        Yii::$app->session->set($sessionName . "_" . $model->id, $model);
        return true;
    }

    /**
     * @inheritdoc
     */
    public function delete($model)
    {
        $sessionName = get_class($model);
        Yii::$app->session->remove($sessionName . "_" . $model->id);
    }

}
