<?php

namespace app\modules\email\models;

use Yii;

/**
 * This is the model class for table "email_user_folder".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $name
 */
class EmailUserFolder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'email_user_folder';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
        ];
    }
}
