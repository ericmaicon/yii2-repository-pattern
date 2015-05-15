<?php

namespace tests;

use tests\models\Sms;
use Yii;

/**
 * Class SmsCrudTest
 *
 * @package tests
 */
class SmsCrudTest extends \PHPUnit_Framework_TestCase
{
    /**
     * This method reads the database with a RAW SQL and get the last inserted id
     *
     * @return bool|null|string
     */
    private function getLastId()
    {
        return Yii::$app->db2->createCommand("SELECT MAX(id) FROM sms")->queryScalar();
    }

    /**
     * This method reads the database with a RAW SQL and get the total of records
     *
     * @return bool|null|string
     */
    private function getTotal()
    {
        return Yii::$app->db2->createCommand("SELECT count(1) FROM sms")->queryScalar();
    }

    /**
     * method that test if the system saved a record
     */
    public function testSave()
    {
        $sms = new Sms();
        $sms->setAttributes([
            'sms' => '62811112232',
        ]);
        $saved = $sms->save();

        $this->assertTrue($saved);
    }

    /**
     * method that test if the system inserted a record
     */
    public function testInsert()
    {
        $sms = new Sms();
        $sms->setAttributes([
            'sms' => '62811112232',
        ]);
        $saved = $sms->insert();

        $this->assertTrue($saved);
    }

    /**
     * method that test if the system found a record
     */
    public function testFind()
    {
        $id = $this->getLastId();
        $smsList = Sms::find(['id' => $id]);
        $sms = $smsList[0];
        $this->assertEquals($sms->id, $id);
    }

    /**
     * method that test if the system found by id a record
     */
    public function testFindOne()
    {
        $id = $this->getLastId();
        $sms = Sms::findOne(['id' => $id]);
        $this->assertEquals($sms->id, $id);
    }

    /**
     * method that test if the system found all records
     */
    public function testFindAll()
    {
        $total = $this->getTotal();
        $smsList = Sms::findAll([]);

        $this->assertEquals(count($smsList), $total);
    }

    /**
     * method that test if the system updated a record
     */
    public function testUpdate()
    {
        $id = $this->getLastId();
        $sms = Sms::findOne(['id' => $id]);
        $sms->setAttributes([
            'sms' => '62811112232',
        ]);
        $sms->update();
    }

    /**
     * method that test if the system deleted a record
     */
    public function testDelete()
    {
        $id = $this->getLastId();
        $sms = Sms::findOne(['id' => $id]);
        $sms->delete();
    }
}
