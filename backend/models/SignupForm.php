<?php
namespace backend\models;

use yii\base\Model;
use backend\models\User;
// use common\models\User;
use backend\modules\auth\models\AuthAssignment;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $fullname;
    public $manager;
    public $view_cuahang;
    public $compare_password;
    public $permission;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [['username','manager','view_cuahang','permission'], 'required'],
            ['username', 'unique', 'targetClass' => '\backend\models\User', 'message' => '{attribute} đã có trong CSDL'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username', 'match', 'not' => true, 'pattern' => '/[^a-zA-Z_-]/', 'message' => '{attribute} chỉ bao gồm các ký tự a->z, A->Z,"_", "-" và ko chứa khoảng trắng'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            [['email','fullname'], 'string', 'max' => 255],
            [['manager','view_cuahang'], 'integer'],
            ['email', 'unique', 'targetClass' => '\backend\models\User', 'message' => '{attribute} đã có trong CSDL'],

            [['password','compare_password'], 'required'],
            ['password', 'string', 'min' => 6],

            [['password','compare_password'],'string' , 'min'=> 6],
            [['password','compare_password'],'filter' , 'filter'=> 'trim'],
            [['compare_password'],'compare' , 'compareAttribute'=> 'password','message'=>'Hai mật khẩu không giống nhau'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Mật khẩu',
            'fullname' => 'Tên đầy đủ',

            'manager' => 'Quản lý',
            'view_cuahang' => 'Người xem',
            'compare_password' => 'Nhập lại mật khẩu',

        ];
    }

    public function signup()
    {
       

        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->fullname = $this->fullname;
            $user->manager = $this->manager;
            $user->view_cuahang = $this->view_cuahang;
            $user->created_at = time();
            $user->updated_at = time();
            $user->setPassword($this->password);
            $user->generateAuthKey();
                // print_r($user->id);

            // let add permission
            if ($_POST) {
                $user->save();
                $permission = $_POST['SignupForm']['permission'];
                // print_r($user->id);
                // print_r($permissionList);die;
                // foreach ($permissionList as $value) {
                $newPermission = new AuthAssignment;
                $newPermission->item_name = $permission;
                $newPermission->created_at = time();
                // if(){
                    $newPermission->user_id = $user->id;
                    $newPermission->save();
                // }
                // print_r($newPermission->getErrors());
                // print_r($user->getErrors());
                // die;
                // }
            }
            return $user;
    }

    return null;

    }
}
