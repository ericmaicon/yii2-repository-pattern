<?php

namespace ericmaicon\repository\model;

use Yii;
use \yii\base\Model;
use yii\di\Container;

/**
 * Class RepositoryModel
 *
 * @package ericmaicon\repository
 */
class RepositoryModel extends Model
{
    use ModelTrait;

    /**
     * This method is used to identify the model repository
     *
     * @return string|null
     */
    public static function repository()
    {
        return null;
    }

    /**
     * This method would return the repository instance related to this model
     *
     * @return \ericmaicon\repository\Repository
     */
    public static function getRepository()
    {
        $repositoryName = static::repository();

        if($repositoryName !== null) {
            return Yii::$app->repository->get($repositoryName);
        } else {
            return Yii::$app->repository->identify(static::tableName());
        }
    }

    /**
     * @inheritdoc
     * @return Query the newly created [[ActiveQuery]] instance.
     */
    public static function find($condition)
    {
        return static::getRepository()->find(get_called_class(), $condition);
    }

    /**
     * @inheritdoc
     * @return static|null ActiveRecord instance matching the condition, or `null` if nothing matches.
     */
    public static function findOne($condition)
    {
        return static::getRepository()->findOne(get_called_class(), $condition);
    }

    /**
     * @inheritdoc
     * @return static[] an array of ActiveRecord instances, or an empty array if nothing matches.
     */
    public static function findAll($condition)
    {
        return static::getRepository()->findAll(get_called_class(), $condition);
    }

    /**
     * Saves the current record.
     *
     * This method will call [[insert()]] when [[isNewRecord]] is true, or [[update()]]
     * when [[isNewRecord]] is false.
     *
     * For example, to save a customer record:
     *
     * ~~~
     * $customer = new Customer;  // or $customer = Customer::findOne($id);
     * $customer->name = $name;
     * $customer->email = $email;
     * $customer->save();
     * ~~~
     *
     *
     * @param boolean $runValidation whether to perform validation before saving the record.
     * If the validation fails, the record will not be saved to database.
     * @param array $attributeNames list of attribute names that need to be saved. Defaults to null,
     * meaning all attributes that are loaded from DB will be saved.
     * @return boolean whether the saving succeeds
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        return static::getRepository()->save($this, $runValidation, $attributeNames);
    }

    /**
     * Inserts a row into the associated database table using the attribute values of this record.
     *
     * For example, to insert a customer record:
     *
     * ~~~
     * $customer = new Customer;
     * $customer->name = $name;
     * $customer->email = $email;
     * $customer->insert();
     * ~~~
     *
     * @param boolean $runValidation whether to perform validation before saving the record.
     * If the validation fails, the record will not be inserted into the database.
     * @param array $attributes list of attributes that need to be saved. Defaults to null,
     * meaning all attributes that are loaded from DB will be saved.
     * @return boolean whether the attributes are valid and the record is inserted successfully.
     * @throws \Exception in case insert failed.
     */
    public function insert($runValidation = true, $attributes = null)
    {
        return static::getRepository()->insert($this, $runValidation, $attributes);
    }

    /**
     * Saves the changes to this active record into the associated database table.
     *
     * For example, to update a customer record:
     *
     * ~~~
     * $customer = Customer::findOne($id);
     * $customer->name = $name;
     * $customer->email = $email;
     * $customer->update();
     * ~~~
     *
     * @param boolean $runValidation whether to perform validation before saving the record.
     * If the validation fails, the record will not be inserted into the database.
     * @param array $attributeNames list of attributes that need to be saved. Defaults to null,
     * meaning all attributes that are loaded from DB will be saved.
     * @return integer|boolean the number of rows affected, or false if validation fails
     * or [[beforeSave()]] stops the updating process.
     * @throws StaleObjectException if [[optimisticLock|optimistic locking]] is enabled and the data
     * being updated is outdated.
     * @throws \Exception in case update failed.
     */
    public function update($runValidation = true, $attributeNames = null)
    {
        return static::getRepository()->update($this, $runValidation, $attributeNames);
    }

    /**
     * Deletes the table row corresponding to this active record.
     *
     * @return integer|false the number of rows deleted, or false if the deletion is unsuccessful for some reason.
     * Note that it is possible the number of rows deleted is 0, even though the deletion execution is successful.
     * @throws StaleObjectException if [[optimisticLock|optimistic locking]] is enabled and the data
     * being deleted is outdated.
     * @throws \Exception in case delete failed.
     */
    public function delete()
    {
        return static::getRepository()->delete($this);
    }

}
