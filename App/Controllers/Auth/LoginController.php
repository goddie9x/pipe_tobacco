<?php
namespace App\Controllers\Auth;
use App\Controllers\Controller;
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
        if (empty($account) || empty($password)) {
            return redirect()->route('login')->with(['errors'=>[
                'account' => 'Account is required',
                'password' => 'Password is required'
            ]]);
        }
        $user = (new User)->where(['account'=> $request->account])->first();
        if($user){
            if(password_verify($request->password, $user['password'])){
                $token = createJWT($user['user_id']);
                Session::set('token', $token);
                return redirect()->to('');
            }
        }
        return redirect()->route('login')->with(['errors'=>[
            'account' => 'Account is not found',
            'password' => 'Password is not correct'
        ]]);
    }
    public function logout()
    {
        Session::forget('token');
        echoObject($_SESSION);
        return redirect()->to('');
    }
}
