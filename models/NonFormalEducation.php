<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nf_edu".
 *
 * @property int $nf_edu_id
 * @property string $entry_year
 * @property string $graduate_year
 * @property string $school
 * @property string $city
 * @property int $user_id
 *
 * @property User $user
 */
class NonFormalEducation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nf_edu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['entry_year', 'graduate_year'], 'string', 'max' => 4],
            [['school', 'city'], 'string', 'max' => 45],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nf_edu_id' => 'Nf Edu ID',
            'entry_year' => 'Entry Year',
            'graduate_year' => 'Graduate Year',
            'school' => 'School',
            'city' => 'City',
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
