<?php

namespace app\modules\email\models;

use Yii;

/**
 * This is the model class for table "email_general_setting".
 *
 * @property int $id
 * @property string $name
 * @property string|null $value
 */
class EmailGeneralSetting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'email_general_setting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['value'], 'string'],
            [['name'], 'string', 'max' => 200],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'value' => 'Value',
        ];
    }
}
