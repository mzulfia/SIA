<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work_exp".
 *
 * @property int $work_exp_id
 * @property string $start_year
 * @property string $finish_year
 * @property string $company
 * @property string $position
 * @property int $user_id
 *
 * @property User $user
 */
class WorkExperience extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work_exp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['start_year', 'finish_year'], 'string', 'max' => 4],
            [['company', 'position'], 'string', 'max' => 45],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'work_exp_id' => 'Work Exp ID',
            'start_year' => 'Start Year',
            'finish_year' => 'Finish Year',
            'company' => 'Company',
            'position' => 'Position',
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
