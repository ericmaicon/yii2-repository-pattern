<?php

namespace ericmaicon\repository;

/**
 * Interface RepositoryTypeInterface
 *
 * @package ericmaicon\repository
 */
interface RepositoryInterface
{
    public static function find();
    public static function findOne($condition);
    public static function findAll($condition);
    public function save($runValidation = true, $attributeNames = null);
    public function insert($runValidation = true, $attributes = null);
    public function update($runValidation = true, $attributeNames = null);
    public function delete();

}
