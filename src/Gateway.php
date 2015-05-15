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

                if(!array_key_exists('class', $repository)) {
                    $repository['class'] = Repository::className();
                }

                $this->repositories[$name] = Yii::createObject($repository);
            }
        }
    }

    /**
     * Return the repository requested
     *
     * @param $repositoryName
     * @return \ericmaicon\repository\Repository
     */
    public function get($repositoryName)
    {
        if (!array_key_exists($repositoryName, $this->repositories)) {
            throw new InvalidParamException('The repository ' . $repositoryName . ' does not exist.');
        }

        return $this->repositories[$repositoryName];
    }

    /**
     * Check if the table exists in a repository, if it exists, return the repository
     *
     * @param $tableName
     * @return \ericmaicon\repository\Repository
     */
    public function identify($tableName)
    {
        foreach ($this->repositories as $name => $repository) {
            if($repository->hasTable($tableName)) {
                return $repository;
            }
        }

        throw new InvalidParamException('The model ' . $tableName . ' could not be recognize in any repository.');
    }
}
