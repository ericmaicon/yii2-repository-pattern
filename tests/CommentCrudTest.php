<?php

namespace tests;

use tests\models\Comment;
use Yii;

/**
 * Class CommentCrudTest
 *
 * @package tests
 */
class CommentCrudTest extends \PHPUnit_Framework_TestCase
{
    /**
     * This method reads the database with a RAW SQL and get the last inserted id
     *
     * @return bool|null|string
     */
    private function getLastId()
    {
        return Yii::$app->db2->createCommand("SELECT MAX(id) FROM comment")->queryScalar();
    }

    /**
     * This method reads the database with a RAW SQL and get the total of records
     *
     * @return bool|null|string
     */
    private function getTotal()
    {
        return Yii::$app->db2->createCommand("SELECT count(1) FROM comment")->queryScalar();
    }

    /**
     * method that test if the system saved a record
     */
    public function testSave()
    {
        $comment = new Comment();
        $comment->setAttributes([
            'author' => 'Eric',
            'email' => 'eric@ericmaicon.com.br',
            'subject' => 'One Subject',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse at eros non sem
            blandit porttitor eu et quam. Suspendisse potentti.',
        ]);
        $saved = $comment->save();

        $this->assertTrue($saved);
    }

    /**
     * method that test if the system inserted a record
     */
    public function testInsert()
    {
        $comment = new Comment();
        $comment->setAttributes([
            'author' => 'Eric',
            'email' => 'eric@ericmaicon.com.br',
            'subject' => 'One Subject',
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse at eros non sem
            blandit porttitor eu et quam. Suspendisse potentti.',
        ]);
        $saved = $comment->insert();

        $this->assertTrue($saved);
    }

    /**
     * method that test if the system found a record
     */
    public function testFind()
    {
        $id = $this->getLastId();
        $comments = Comment::find(['id' => $id]);
        $comment = $comments[0];
        $this->assertEquals($comment->id, $id);
    }

    /**
     * method that test if the system found by id a record
     */
    public function testFindOne()
    {
        $id = $this->getLastId();
        $comment = Comment::findOne(['id' => $id]);
        $this->assertEquals($comment->id, $id);
    }

    /**
     * method that test if the system found all records
     */
    public function testFindAll()
    {
        $total = $this->getTotal();
        $comments = Comment::findAll([]);

        $this->assertEquals(count($comments), $total);
    }

    /**
     * method that test if the system updated a record
     */
    public function testUpdate()
    {
        $id = $this->getLastId();
        $comment = Comment::findOne(['id' => $id]);
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
     */
    public function testDelete()
    {
        $id = $this->getLastId();
        $comment = Comment::findOne(['id' => $id]);
        $comment->delete();
    }

}
