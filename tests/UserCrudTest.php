<?php

namespace tests;

use tests\models\User;
use Yii;

/**
 * Class UserCrudTest
 *
 * @package tests
 */
class UserCrudTest extends \PHPUnit_Framework_TestCase
{
    public static $lastId;

    /**
     * method that test if the system saved a record
     */
    public function testSave()
    {
        $user = new User();
        $user->load([
            'name' => 'Eric',
        ]);
        $saved = $user->save();

        $this->assertTrue($saved);
    }

    /**
     * method that test if the system inserted a record
     */
    public function testInsert()
    {
        $user = new User();
        $user->load([
            'name' => 'Eric',
        ]);
        $saved = $user->insert();
        static::$lastId = $user->id;

        $this->assertTrue($saved);
    }

    /**
     * method that test if the system found a record
     * @expectedException \yii\base\Exception
     */
    public function testFind()
    {
        $id = static::$lastId;
        User::find(['id' => $id]);
    }

    /**
     * method that test if the system found by id a record
     */
    public function testFindOne()
    {
        $id = static::$lastId;
        $user = User::findOne($id);
//        $this->assertEquals($user->id, $id);
    }

    /**
     * method that test if the system found all records
     * @expectedException \yii\base\Exception
     */
    public function testFindAll()
    {
        User::findAll([]);
    }

    /**
     * method that test if the system updated a record
     */
    public function testUpdate()
    {
        $id = static::$lastId;
//        $user = User::findOne(['id' => $id]);
//        $user->load([
//            'name' => 'John',
//        ]);
//        $user->update();
    }

    /**
     * method that test if the system deleted a record
     */
    public function testDelete()
    {
        $id = static::$lastId;
//        $user = User::findOne(['id' => $id]);
//        $user->delete();
    }
}
