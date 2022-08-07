<?php
namespace App\Controller\Auth;
use App\Middlewares\Auth;
use App\Models\User;
class ForgotPasswordController extends Controller
{
    public function index()
    {
        Auth::handleLogged();
        $this->view('auth.forgot-password');
    }
    public function forgotPassword($request)
    {
        $account = $request->account;
        $email = $request->email;
        $user = User::where([
            'account' => $account,
            'email' => $email,
        ])->first();
        $message;
        if($user){
            $token = createJWT($user->user_id);
            $_SESSION['token'] = $token;
            return redirect('/auth/reset-password');
        }
        $message = 'account or email not found';
        return view('auth.forgot-password', compact('message'));
    }
    public function logout()
    {
        unset($_SESSION['token']);
        header('Location: /login');
    }
}