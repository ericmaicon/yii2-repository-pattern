<?php

namespace tests\models;

use ericmaicon\repository\model\RepositoryModel;

/**
 * Class Email
 *
 * @package tests\models
 */
class Email extends RepositoryModel
{

    public static function tableName()
    {
        return 'email';
    }

    public function rules()
    {
        return [
            [['id', 'email'], 'safe'],
        ];
    }
}
