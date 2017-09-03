<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\base\Security;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $user_id
 * @property string $full_name
 * @property string $first_email
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 *
 * @property Award[] $awards
 * @property FEdu[] $fEdus
 * @property NfEdu[] $nfEdus
 * @property OrgExp[] $orgExps
 * @property Skill[] $skills
 * @property UserData[] $userDatas
 * @property WorkExp[] $workExps
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_name', 'first_email', 'password'], 'required'],
            [['full_name', 'password_token','auth_key'], 'string', 'max' => 50],
            [['first_email', 'password'], 'string', 'max' => 45],
            [['password_hash'], 'string', 'max' => 255],
            [['auth_key'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'full_name' => 'Full Name',
            'first_email' => 'Email',
            'password' => 'Password',
            'password_hash' => 'Password Hash',
            'password_token' => 'Password Token',
            'auth_key' => 'Auth Key',
            'verification_status' => 'Verification Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Insert Auth Key
     */

    // public function beforeSave($insert)
    // {
    //     if (parent::beforeSave($insert)) {
    //         if ($this->isNewRecord) {
    //             $this->auth_key = Security::generateRandomKey();
    //         }
    //         return true;
    //     }
    //     return false;
    // }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByEmail($email)
    {
      return static::findOne(['first_email' => $email]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
      public function setPassword($password)
      {
          $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($password);//Security::generatePasswordHash($password);
      }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAwards()
    {
        return $this->hasMany(Award::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFEdus()
    {
        return $this->hasMany(FEdu::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNfEdus()
    {
        return $this->hasMany(NfEdu::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrgExps()
    {
        return $this->hasMany(OrgExp::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skill::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserDatas()
    {
        return $this->hasMany(UserData::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkExps()
    {
        return $this->hasMany(WorkExp::className(), ['user_id' => 'user_id']);
    }
}
