<?php

namespace tests\models;

use ericmaicon\repository\RepositoryModel;

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

}
