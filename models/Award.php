<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "award".
 *
 * @property int $award_id
 * @property string $year
 * @property string $information
 * @property int $user_id
 *
 * @property User $user
 */
class Award extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'award';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['year'], 'string', 'max' => 4],
            [['information'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'award_id' => 'Award ID',
            'year' => 'Year',
            'information' => 'Information',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_id']);
    }
}
