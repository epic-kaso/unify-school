<?php
/**
 * Created by PhpStorm.
 * User: Ak
 * Date: 3/14/2015
 * Time: 5:59 PM
 */

namespace UnifySchool\Http\Controllers\School\Admin;


use Illuminate\Contracts\Auth\Guard;
use UnifySchool\Http\Controllers\Controller;
use UnifySchool\Http\Requests\AdminLoginRequest;

class AdminAuthController extends Controller
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
        return $this->generateUrl('/admin/dashboard');
    }

    private function generateUrl($url)
    {
        if (str_contains(\Request::getRequestUri(), $this->getSchool()->slug)) {
            return $url;
        }

        return $url . '?school_slug=' . $this->getSchool()->slug;
    }

    public function loginPath()
    {
        return $this->generateUrl('/admin/auth/login');
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