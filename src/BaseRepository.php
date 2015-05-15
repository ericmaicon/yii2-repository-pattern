<?php

namespace ericmaicon\repository;

use Yii;
use yii\base\Component;

abstract class BaseRepository extends Component implements RepositoryInterface
{
    public $tables = [];

    /**
     * @inheritdoc
     *
     * @throws \yii\base\NotSupportedException
     */
    public function init()
    {
        parent::init();

        if (count($this->tables) < 1) {
            throw new InvalidParamException('The "tables" property needs to be filled.');
        }
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
     * Check if this repository has the $tableName table
     *
     * @param $tableName
     * @return bool
     */
    public function hasTable($tableName)
    {
        foreach ($this->tables as $table) {
            if ($table == $tableName || '{{%' . $table . '}}' == $tableName) {
                return true;
            }
        }

        return false;
    }
}
