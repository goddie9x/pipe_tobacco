<?php
namespace App\Controllers\Auth;
use Core\Controller;
use App\Models\User;
use App\Middlewares\Auth;
use App\Helper\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function login($request)
    {
        $account = $request->account;
        $password = $request->password;
        $remember = (isset($request->remember)) ? true : false;
        $errors = [];
        if(empty($account)){
            $errors['account'] = 'Account is required';
        }
        if(empty($password)){
            $errors['password'] = 'Password is required';
        }
        if(!empty($errors)){
            return redirect()->back([
                'errors' => $errors
            ]);
        }
        $user = (new User)->where(['account'=> $request->account,'banned'=>0])->first();
        if($user){
            if(password_verify($request->password, $user['password'])){
                $token = createJWT($user['user_id']);  
                if($remember){
                    setcookie('token', $token, time() + (86400 * 30), "/");
                }
                Session::set('token', $token);
                return redirect()->to('');
            }
        }
        return redirect()->route('login',['errors'=>[
            'account' => 'Account is not found',
            'password' => 'Password is not correct'
        ]]);
    }
    public function logout()
    {
        Session::forget('token');
        setcookie('token', '', time() - (86400 * 30), "/");
        return redirect()->to('');
    }
}
