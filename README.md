# Repository Design Pattern for Yii2

[![Latest Version](https://img.shields.io/github/tag/ericmaicon/yii2-repository-pattern.svg?style=flat-square&label=release)](https://github.com/ericmaicon/yii2-repository-pattern/tags)

An implementation of repository design pattern.

**Martin Fowler** described repository as:

> A Repository mediates between the domain and data mapping layers, acting like an in-memory domain object collection.

![http://martinfowler.com/eaaCatalog/repository.html](http://martinfowler.com/eaaCatalog/repositorySketch.gif)

This repository tried to fit the design pattern without another one (E.G. Active Record).

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```bash
$ composer require ericmaicon/yii2-repository-pattern:*
```

or add

```
"ericmaicon/yii2-repository-pattern": "*"
```

to the `require` section of your `composer.json` file.

## Usage

Append in your config file:

```php
'components' => [
    'repository' => [
        'class' => 'ericmaicon\repository\Gateway',
        'repositories' => [

        ]
    ]
]
```

You need to identify each repository that you have inside of repositories array. You can identify a **Database Repository** or a **Session Repository**:

**Database Repository**
```php
'test' => [
	'db' => 'db',
],
```

**Session Repository**
```php
'test3' => [
	'class' => 'ericmaicon\repository\session\SessionRepository',
	'tables' => [
    	'user'
    ]
]
```

* **Database Repositories** don't request *class* and *tables* attributes. If *tables* attribute was not filled, the repository will fetch by itself from the database. Otherwise, it is required to fill the *db* attribute to identify the related database.

The final config section:

```php
'components' => [
    'repository' => [
        'class' => 'ericmaicon\repository\Gateway',
        'repositories' => [
            'test' => [
                'db' => 'db',
            ],
            'test2' => [
                'db' => 'db2',
                'tables' => [
                    'comment'
                ]
            ],
            'test3' => [
                'class' => 'ericmaicon\repository\session\SessionRepository',
                'tables' => [
                    'user'
                ]
            ]
        ]
    ]
]
```

All repositories models need to extends **RepositoryModel**:

```php
class User extends RepositoryModel
{

    public $id;
    public $name;

}
```

You can define the model repository (Optional):

```php
class Sms extends RepositoryModel
{

    public static function repository()
    {
        return 'test2';
    }

}
```

After that, you can use to **save a record**:
```php
$sms = new Sms();
$sms->setAttributes([
	'sms' => '62811112232',
]);
$sms->save();
```

**update a record**

```php
$sms = Sms::findOne(['id' => $id]);
$sms->setAttributes([
	'sms' => '62811112232',
]);
$sms->update();
```

**delete a record**

```php
$sms = Sms::findOne(['id' => $id]);
$sms->delete();
```

**find records**:
```php
Sms::find(['id' => $id]);
```

```php
Sms::findOne(['id' => $id]);
```

```php
Sms::findAll([])
```

## Testing

```bash
$ vagrant up
$ vagrant ssh
$ cd /var/www
$ ./vendor/bin/phpunit
```

## What is missing?

* RepositoryModel does not have events like ActiveRecord one.
* DbRepository is not using ActiveRecord. To do so, the SQL part is very rudimentar.
* Define Class in config array instead of table name

## Reference used to build this repository

[https://github.com/domnikl/DesignPatternsPHP/tree/master/More/Repository](https://github.com/domnikl/DesignPatternsPHP/tree/master/More/Repository)
[http://culttt.com/2014/09/08/benefits-using-repositories/](http://culttt.com/2014/09/08/benefits-using-repositories/)
[http://codereview.stackexchange.com/questions/42498/repository-pattern-with-plain-old-php-object](http://codereview.stackexchange.com/questions/42498/repository-pattern-with-plain-old-php-object)
[http://code.tutsplus.com/tutorials/the-repository-design-pattern--net-35804](http://code.tutsplus.com/tutorials/the-repository-design-pattern--net-35804)
[http://moleseyhill.com/blog/2009/07/13/active-record-verses-repository/](http://moleseyhill.com/blog/2009/07/13/active-record-verses-repository/)
[http://moleseyhill.com/blog/2009/06/29/simple-repository-pattern/](http://moleseyhill.com/blog/2009/06/29/simple-repository-pattern/)
[http://moleseyhill.com/blog/2009/07/06/unit-testing-with-repository-pattern/](http://moleseyhill.com/blog/2009/07/06/unit-testing-with-repository-pattern/)
[http://martinfowler.com/eaaCatalog/repository.html](http://martinfowler.com/eaaCatalog/repository.html)
