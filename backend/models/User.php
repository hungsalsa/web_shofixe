<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $fullname
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $manager
 * @property int $view_cuahang
 * @property string $cuahang_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    public $permission;
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'user';
    }

    public static function getDb()
    {
        return Yii::$app->get('db1');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['username', 'auth_key', 'password_hash', 'email','editquantity', 'created_at', 'updated_at','user_update'], 'required'],
            [['manager', 'view_cuahang', 'status', 'created_at', 'updated_at','user_update'], 'integer'],
            [['username', 'fullname', 'password_hash', 'password_reset_token', 'email', 'image'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique', 'message' => '{attribute} này đã có'],
            [['permission'], 'safe'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            ['username', 'match', 'not' => true, 'pattern' => '/[^a-zA-Z_-]/', 'message' => '{attribute} chỉ bao gồm các ký tự a->z, A->Z,"_", "-" và ko chứa khoảng trắng'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'permission' => 'Quyền hạn',
            'fullname' => 'Tên đầy đủ',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'manager' => 'Quản lý',
            'image' => 'Ảnh',
            'editquantity' => 'Chỉnh sửa giá',
            'view_cuahang' => 'Người xem cửa hàng',
            'cuahang_id' => 'Làm việc tại',
            'status' => 'Kích hoạt',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'user_update' => 'Người sửa',
        ];
    }

    public function getUpdate()
    {
        return $this->hasOne(User::className(), ['id' => 'user_update']);
    }

    public function validateCurrentPassword(){
        if (!$this->verifyPassword($this->currentPassword)) {
            $this->addError("currentPassword","Mật khẩu cũ không đúng");
        }
    }

    public function verifyPassword($password)
    {
        $dbpassword = static::findOne(['username'=>Yii::$app->user->identity->username,'status'=>self::STATUS_ACTIVE])->password_hash;
        return Yii::$app->security->validatePassword($password,$dbpassword);
    }
    
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

}
