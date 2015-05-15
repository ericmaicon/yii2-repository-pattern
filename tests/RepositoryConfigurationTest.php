<?php

namespace tests;

use Yii;

/**
 * Class RepositoryConfigurationTest
 *
 * @package tests
 */
class RepositoryConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testWidget()
    {
    }

    /**
     * @expectedException \yii\base\InvalidConfigException
     */
    public function testWidgetExceptionIsRaisedWhenUrlIsEmpty()
    {
    }
}
