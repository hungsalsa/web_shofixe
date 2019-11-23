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
    public $compare_password;
    public $permission;
    public $status;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [['username','permission','status'], 'required'],
            ['username', 'unique', 'targetClass' => '\backend\models\User', 'message' => '{attribute} đã có trong CSDL'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username', 'match', 'not' => true, 'pattern' => '/[^a-z0-9A-Z_-]/', 'message' => '{attribute} chỉ bao gồm các ký tự a->z, A->Z,"_", "-" và ko chứa khoảng trắng'],

            ['email', 'trim'],
            // ['email', 'required'],
            // ['email', 'email'],
            [['email','fullname'], 'string', 'max' => 255],
            [['manager'], 'integer'],
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
            'permission' => 'Quyền Account',
            'manager' => 'Quản lý',
            'status' => 'Kích hoạt',
            'compare_password' => 'Nhập lại mật khẩu',

        ];
    }

    public function signup()
    {
       

        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = 'test'.time().'@gmail.com';
            $user->fullname = $this->fullname;
            $user->manager = 0;
            $user->status = $this->status;
            // $user->manager = $this->manager;
            $user->created_at = time();
            $user->updated_at = time();
            $user->setPassword($this->password);
            $user->generateAuthKey();
                // print_r($user->id);

            // let add permission
            if ($_POST) {
                $user->save();
                // pr($user->errors);
                // print_r($user->id);
                // print_r($permissionList);die;
                // foreach ($permissionList as $value) {
                if($user->status==10){
                    $newPermission = new AuthAssignment;
                    $permission = $_POST['SignupForm']['permission'];
                    $newPermission->item_name = $permission;
                    $newPermission->created_at = time();
                    $newPermission->created_at = time();
                    $newPermission->user_id = $user->id;
                    $newPermission->save();
                    // dbg($newPermission->errors);
                }
               
            }
            return $user;
    }

    return null;

    }
}
