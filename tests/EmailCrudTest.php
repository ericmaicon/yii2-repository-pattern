<?php

namespace tests;

use tests\models\Email;
use Yii;

/**
 * Class EmailCrudTest
 *
 * @package tests
 */
class EmailCrudTest extends \PHPUnit_Framework_TestCase
{

    /**
     * This method reads the database with a RAW SQL and get the last inserted id
     *
     * @return bool|null|string
     */
    private function getLastId()
    {
        return Yii::$app->db->createCommand("SELECT MAX(id) FROM email")->queryScalar();
    }

    /**
     * This method reads the database with a RAW SQL and get the total of records
     *
     * @return bool|null|string
     */
    private function getTotal()
    {
        return Yii::$app->db->createCommand("SELECT count(1) FROM email")->queryScalar();
    }

    /**
     * method that test if the system saved a record
     */
    public function testSave()
    {
        $email = new Email();
        $email->setAttributes([
            'email' => '62811112232',
        ]);
        $saved = $email->save();

        $this->assertTrue($saved);
    }

    /**
     * method that test if the system inserted a record
     */
    public function testInsert()
    {
        $email = new Email();
        $email->setAttributes([
            'email' => 'eric@ericmaicon.com.br',
        ]);
        $saved = $email->insert();

        $this->assertTrue($saved);
    }

    /**
     * method that test if the system found a record
     */
    public function testFind()
    {
        $id = $this->getLastId();
        $emailList = Email::find(['id' => $id]);
        $email = $emailList[0];
        $this->assertEquals($email->id, $id);
    }

    /**
     * method that test if the system found by id a record
     */
    public function testFindOne()
    {
        $id = $this->getLastId();
        $email = Email::findOne(['id' => $id]);
        $this->assertEquals($email->id, $id);
    }

    /**
     * method that test if the system found all records
     */
    public function testFindAll()
    {
        $total = $this->getTotal();
        $emailList = Email::findAll([]);

        $this->assertEquals(count($emailList), $total);
    }

    /**
     * method that test if the system updated a record
     */
    public function testUpdate()
    {
        $id = $this->getLastId();
        $email = Email::findOne(['id' => $id]);
        $email->setAttributes([
            'email' => 'eric@ericmaicon2.com.br',
        ]);
        $email->update();
    }

    /**
     * method that test if the system deleted a record
     */
    public function testDelete()
    {
        $id = $this->getLastId();
        $email = Email::findOne(['id' => $id]);
        $email->delete();
    }
}
