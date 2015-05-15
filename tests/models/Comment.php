<?php

namespace tests\models;

use ericmaicon\repository\RepositoryModel;

/**
 * Class Comment
 *
 * @package tests\models
 */
class Comment extends RepositoryModel
{

    public $id;
    public $author;
    public $email;
    public $subject;
    public $body;

}
