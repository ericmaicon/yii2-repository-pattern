<?php

namespace ericmaicon\repository;

/**
 * Interface RepositoryTypeInterface
 *
 * @package ericmaicon\repository
 */
interface RepositoryInterface
{

    /**
     * @param $modelClass
     * @param $condition
     * @return mixed
     */
    public function find($modelClass, $condition);

    /**
     * Method to fetch one record
     *
     * @param $modelClass
     * @param $condition
     * @return mixed
     */
    public function findOne($modelClass, $condition);

    /**
     * Method to fetch all records
     *
     * @param $modelClass
     * @param $condition
     * @return mixed
     */
    public function findAll($modelClass, $condition);

    /**
     * Method that save (insert or update) in a specific repository
     *
     * @param \ericmaicon\repository\model\RepositoryModel $model
     * @param bool $runValidation
     * @param null $attributeNames
     * @return mixed
     */
    public function save($model, $runValidation = true, $attributeNames = null);

    /**
     * Method that insert a record in a specific repository
     *
     * @param \ericmaicon\repository\model\RepositoryModel $model
     * @param bool $runValidation
     * @param null $attributes
     * @return mixed
     */
    public function insert($model, $runValidation = true, $attributes = null);

    /**
     * Method that update a record in a specific repository
     *
     * @param \ericmaicon\repository\model\RepositoryModel $model
     * @param bool $runValidation
     * @param null $attributeNames
     * @return mixed
     */
    public function update($model, $runValidation = true, $attributeNames = null);

    /**
     * Method that delete a record in a specific repository
     *
     * @param \ericmaicon\repository\model\RepositoryModel $model
     * @return mixed
     */
    public function delete($model);

}
