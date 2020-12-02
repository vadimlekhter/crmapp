<?php


namespace app\models\user;


use yii\base\Model;

class LoginForm extends Model
{
    /** @var $username string */
    public $username;

    /** @var $password string */
    public $password;

    /** @var $rememberMe bool */
    public $rememberMe;

    /** @var UserRecord */
    private $user;

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword']
        ];
    }

    public function getUser($username)
    {
        if (!$this->user)
            return UserRecord::findOne(compact('username'));

        return $this->user;
    }


    public function validatePassword($attributeName)
    {
        if ($this->hasErrors())
            return;

        $user = $this->getUser($this->username);
        if (!($user && $this->isCorrectHash($this->$attributeName, $user->password)))
            $this->addError('password', 'Wrong username or password');

    }

    private function isCorrectHash($password, $hash)
    {
        return \Yii::$app->security->validatePassword($password, $hash);
    }

    public function login()
    {
        if (!$this->validate()) return false;

        $user = $this->getUser($this->username);
        if (!$user) return false;

        return \Yii::$app->user->login($user, $this->rememberMe ? 24 * 60 * 60 : 0);

    }
}