<?php
namespace pistol88\field\models;

use yii;

class FieldRelationValue extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return '{{%field_relation_value}}';
    }

    public function rules()
    {
        return [
            [['field_id'], 'required'],
            [['field_id', 'value'], 'integer'],
        ];
    }

    public function getfields()
    {
        return $this->hasOne(Field::className(), ['id' => 'field_id']);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'field_id' => 'Фильтр',
            'value' => 'Значение',
        ];
    }
}
