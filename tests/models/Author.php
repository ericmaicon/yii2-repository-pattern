<?php

namespace tests\models;

use ericmaicon\repository\model\RepositoryModel;

/**
* Class Author
*
* @package tests\models
*/
class Author extends RepositoryModel
{

    public $id;
    public $name;

    public function rules()
    {
        return [
            [['id', 'name'], 'safe'],
        ];
    }
}
