<?php

namespace ericmaicon\repository;

use Yii;
use yii\base\Component;
use yii\base\InvalidParamException;

class Repository extends Component implements RepositoryInterface
{
    use DatabaseTrait;

    public $tables;
    public $db;

    /**
     * @inheritdoc
     *
     * @throws \yii\base\NotSupportedException
     */
    public function init()
    {
        parent::init();

        if(!Yii::$app->has($this->db)) {
            throw new InvalidParamException('The DB need to be filled and with a valid Connection');
        }

        if($this->tables === null) {
            $schema = $this->getDb()->getSchema();
            $this->tables = $schema->tableNames;
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
        foreach($this->tables as $table) {
            if($table == $tableName || '{{%' . $table . '}}' == $tableName) {
                return true;
            }
        }

        return false;
    }

    public function getModel()
    {
        
    }
}
