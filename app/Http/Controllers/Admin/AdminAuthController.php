<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/14/2015
 * Time: 5:59 PM
 */

namespace UnifySchool\Http\Controllers\Admin;


use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\AdminLoginRequest;

class AdminAuthController extends Controller
{

    protected $auth;
    protected $registrar;
    private $redirectPath;

    /**
     * Create a new authentication controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\Guard $auth
     * @param  \Illuminate\Contracts\Auth\Registrar $registrar
     */
    public function __construct(Guard $auth, Registrar $registrar)
    {
        $this->auth = $auth;
        $this->registrar = $registrar;
        $this->redirectPath = '/admin/dashboard';

        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getLogin()
    {
        $school = $this->getSchool();

        return view('admin.auth.login', ['school' => $school]);
    }


    public function postLogin(AdminLoginRequest $request)
    {
        $school = $this->getSchool();

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
        return '/admin/dashboard?school_slug=' . $this->getSchool()->slug;
    }

    public function loginPath()
    {
        return '/admin/auth/login?school_slug=' . $this->getSchool()->slug;
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