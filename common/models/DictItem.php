<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dict_item".
 *
 * @property string $id
 * @property integer $value
 * @property string $display_name
 * @property integer $sequence
 * @property string $type_id
 *
 * @property DictType $type
 */
class DictItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dict_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'display_name', 'type_id'], 'required'],
            [['value', 'sequence', 'type_id'], 'integer'],
            [['display_name'], 'string', 'max' => 100],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DictType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'display_name' => 'Display Name',
            'sequence' => 'Sequence',
            'type_id' => 'Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(DictType::className(), ['id' => 'type_id']);
    }
}
