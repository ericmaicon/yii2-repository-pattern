<?php

namespace ericmaicon\repository;

use Yii;
use yii\base\Component;
use yii\base\InvalidParamException;

/**
 * Class Gateway
 *
 * @package ericmaicon\repository
 */
class Gateway extends Component
{
    public $repositories = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        foreach ($this->repositories as $name => $repository) {
            if (!$repository instanceof RepositoryInterface) {
                $this->repositories[$name] = Yii::createObject($repository);
            }
        }
    }

    public function identify($model)
    {
        if (!($model instanceof RepositoryModel)) {
            throw new InvalidParamException('Invalid parameter. It needs to be an instance of RepositoryModel');
        }

        $tableName = $model->tableName();

        foreach ($this->repositories as $name => $repository) {
            if($repository->hasTable($tableName)) {
                return $repository;
            }
        }

        throw new InvalidParamException('The model ' . $tableName . ' could not be recognize in any repository.');
    }
}
