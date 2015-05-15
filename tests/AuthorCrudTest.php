<?php

namespace tests;

use tests\models\Author;
use Yii;

/**
 * Class AuthorConfigurationTest
 *
 * @package tests
 */
class AuthorConfigurationTest extends \PHPUnit_Framework_TestCase
{

    /**
     * method that test if the system saved a record
     * @expectedException \yii\base\InvalidParamException
     */
    public function testSave()
    {
        $comment = new Author();
        $comment->setAttributes([
            'name' => 'Eric',
        ]);
        $comment->save();
    }

    /**
     * method that test if the system inserted a record
     * @expectedException \yii\base\InvalidParamException
     */
    public function testInsert()
    {
        $comment = new Author();
        $comment->setAttributes([
            'name' => 'Eric',
        ]);
        $comment->insert();
    }

    /**
     * method that test if the system found a record
     * @expectedException \yii\base\InvalidParamException
     */
    public function testFind()
    {
        Author::find(['id' => 1]);
    }

    /**
     * method that test if the system found by id a record
     * @expectedException \yii\base\InvalidParamException
     */
    public function testFindOne()
    {
        Author::findOne(['id' => 1]);
    }

    /**
     * method that test if the system found all records
     * @expectedException \yii\base\InvalidParamException
     */
    public function testFindAll()
    {
        Author::findAll([]);
    }

    /**
     * method that test if the system updated a record
     * @expectedException \yii\base\InvalidParamException
     */
    public function testUpdate()
    {
        $comment = Author::findOne(['id' => 1]);
        $comment->setAttributes([
            'author' => 'Eric2',
            'email' => 'eric@ericmaicon.com.br',
            'subject' => 'Two Subject',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse at eros non sem
            blandit porttitor eu et quam. Suspendisse potentti.',
        ]);
        $comment->update();
    }

    /**
     * method that test if the system deleted a record
     * @expectedException \yii\base\InvalidParamException
     */
    public function testDelete()
    {
        $comment = Author::findOne(['id' => 1]);
        $comment->delete();
    }
}
