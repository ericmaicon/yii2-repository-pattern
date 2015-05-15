<?php

namespace tests\models;

use ericmaicon\repository\model\RepositoryModel;

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

    public function rules()
    {
        return [
            [['id', 'author', 'email', 'subject', 'body'], 'safe'],
        ];
    }
}
