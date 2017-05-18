<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dict_type".
 *
 * @property string $id
 * @property string $code
 * @property string $name
 *
 * @property DictItem[] $dictItems
 */
class DictType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dict_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['code'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDictItems()
    {
        return $this->hasMany(DictItem::className(), ['type_id' => 'id']);
    }
}
