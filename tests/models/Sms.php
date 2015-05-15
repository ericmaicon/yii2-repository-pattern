<?php

namespace tests\models;

use ericmaicon\repository\model\RepositoryModel;

/**
 * Class Sms
 *
 * @package tests\models
 */
class Sms extends RepositoryModel
{

    public static function repository()
    {
        return 'test2';
    }
    public function rules()
    {
        return [
            [['id', 'sms'], 'safe'],
        ];
    }

}
