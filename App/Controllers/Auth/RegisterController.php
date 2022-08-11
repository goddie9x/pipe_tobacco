<?php 
namespace App\Controllers\Auth;
use Core\Controller;
use App\Models\User;
use App\Middlewares\Auth;
use App\Helper\Session;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    public function register($request)
    {
        $errors = [];
        $account = $request->account;
        $email = $request->email;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;
        $user_name = $request->user_name;
        if($account == '') {
            $errors['account']= 'Account is required';
        }
        if($email == '') {
            $errors['email']= 'Email is required';
        }
        if($password == '') {
            $errors['password']= 'Password is required';
        }
        if($password_confirmation == '') {
            $errors['password_confirmation']= 'Password confirmation is required';
        }
        if($user_name == '') {
            $errors['user_name']= 'User name is required';
        }
        if($password != $password_confirmation) {
            $errors['password_confirmation']= 'Password confirmation is not match';
        }
        if(count($errors) > 0) {
            return redirect()->back(['errors'=>$errors]);
        }
        $user = (new User())->where([
            'account' => $account,
        ])->first();
        if($user) {
            $errors['account']= 'Account is exists';
            return redirect()->back(['errors'=>$errors]);
        }
        $user = (new User())->where([
            'email' => $email
        ])->first();
        if($user) {
            $errors['email']= 'Email is exists';
            return redirect()->back(['errors'=>$errors]);
        }
        $userId = User::insert([
            'account' => $account,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'user_name' => $user_name
        ]);
        if(!$userId) {
            $errors['register']= 'Register is failed';
            return redirect()->back(['errors'=>$errors]);
        }
        $token = createJWT($userId);
        Session::set('token', $token);
        $message = 'register success';
        return redirect()->route('home',['message'=>$message]);
    }
}