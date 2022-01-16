<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    private $errors= [];
    protected $redirectTo = '/dashboard';

    public function showLoginForm(){
        return view('backend.auth.login');
    }

    /**
     * Override
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function complainer_login_check(Request $request)
    {

        $request->validate([
            'user_name' => 'required',
            'password' => 'required'
        ]);

        $auth = User::where('user_name','=', $request->user_name)->first();
        if ($auth) {
            if (Hash::check($request->password, $auth->password)) {
                session([
                     'user_id' =>$auth->user_id,
                     'user_name' =>$auth->user_name,
                     'role_id' =>$auth->role_id,
                ]);
                //dd(session()->get());
                if ($auth) {
                    return redirect('/dashboard');
                }else{
                    return redirect('/complainer-login');
                }

            }else{
                return redirect('/complainer-login')
                ->withInput($request->only('user_name'))
                ->with('failed', 'Password do not match.');
            }
        }else{
            return back()->with('failed','No Account For This Name');
        }
    }
    

    protected function guard()
    {
        return Auth::guard('guest');
    }
    /**
     * Override
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }
}
