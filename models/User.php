<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    public $rememberMe = true;
    /**
     * {@inheritdoc}
    */

    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
    */

    public function rules()
    {
        return[
            [['name', 'email', 'password'], 'required'],
            ['email', 'email'],
            ['email', 'unique'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email', 'password'], 'string', 'max'=> 64],
        ];
    }

    /**
     * {@inheritdoc}
    */

    public function attributeLabels()
    {
        return[
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($auth_key)
    {
        return $this->auth_key === $auth_key;
    }

    public static function findByUserEmail($email)
    {
        return self::findOne([
            "email" => $email,
            "user_type" => "user"
        ]);
    }

    public function validatePassword($passwordHash)
    {
        return Yii::$app->getSecurity()->validatePassword($this->password,$passwordHash);
    }

    public function login()
    {
        $user = $this->findByUserEmail($this->email);
        if($user && $this->validatePassword($user->password))
        {
            return Yii::$app->user->login($user, $this->rememberMe ? 3000*24*30 : 0);
        }else
        {
            $this->addError('password', 'Не верный логин или пароль');
        }
    }

}
