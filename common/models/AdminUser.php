<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "admin_user".
 *
 * @property string $id
 * @property string $usercode
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 *
 * @property Blog[] $blogs
 */
class AdminUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['usercode', 'username', 'password', 'email'], 'required'],
            [['usercode'], 'string', 'max' => 20],
            [['username', 'password', 'email'], 'string', 'max' => 128],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usercode' => 'Usercode',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs()
    {
        return $this->hasMany(Blog::className(), ['author_id' => 'id']);
    }
}
