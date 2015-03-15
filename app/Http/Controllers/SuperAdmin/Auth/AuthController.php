<?php namespace UnifySchool\Http\Controllers\SuperAdmin\Auth;

use Illuminate\Contracts\Auth\Guard;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\Request;

class AuthController extends Controller
{
    protected $auth;

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getLogin()
    {
        return view('super-admin.auth.login', []);
    }


    public function postLogin(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if ($this->auth->attempt($credentials, $request->has('remember'))) {
            return redirect()->intended($this->redirectPath());
        }

        return redirect($this->loginPath())
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => $this->getFailedLoginMessage(),
            ]);
    }

    public function redirectPath()
    {
        return '/super-admin/dashboard';
    }

    public function loginPath()
    {
        return '/super-admin/auth/login';
    }

    protected function getFailedLoginMessage()
    {
        return 'These credentials do not match our records.';
    }

    public function getLogout()
    {
        $this->auth->logout();

        return redirect($this->loginPath());
    }
}
