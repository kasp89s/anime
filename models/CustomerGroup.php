<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customergroup".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property double $groupDiscount
 * @property integer $isAutomaticGroup
 * @property integer $isActive
 * @property integer $isDefault
 * @property double $groupAccumulatedLimit
 *
 * @property Customer[] $customers
 */
class CustomerGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customergroup';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['groupDiscount', 'groupAccumulatedLimit'], 'number'],
            [['isAutomaticGroup', 'isActive', 'isDefault'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'groupDiscount' => 'Group Discount',
            'isAutomaticGroup' => 'Is Automatic Group',
            'isActive' => 'Is Active',
            'isDefault' => 'Is Default',
            'groupAccumulatedLimit' => 'Group Accumulated Limit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customer::className(), ['customerGroupId' => 'id']);
    }
}
