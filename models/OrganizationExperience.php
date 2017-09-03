<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "org_exp".
 *
 * @property int $org_exp_id
 * @property string $year
 * @property string $information
 * @property int $user_id
 *
 * @property User $user
 */
class OrganizationExperience extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'org_exp';
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
            'org_exp_id' => 'Org Exp ID',
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
