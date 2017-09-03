<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "f_edu".
 *
 * @property int $f_edu_id
 * @property string $entry_year
 * @property string $graduate_year
 * @property string $level
 * @property string $school
 * @property string $major
 * @property int $user_id
 *
 * @property User $user
 */
class FormalEducation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'f_edu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['entry_year', 'graduate_year', 'level'], 'string', 'max' => 4],
            [['school', 'major'], 'string', 'max' => 45],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'f_edu_id' => 'F Edu ID',
            'entry_year' => 'Entry Year',
            'graduate_year' => 'Graduate Year',
            'level' => 'Level',
            'school' => 'School',
            'major' => 'Major',
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
