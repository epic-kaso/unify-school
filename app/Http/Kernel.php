<?php namespace UnifySchool\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
        'Illuminate\Cookie\Middleware\EncryptCookies',
        'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
        'Illuminate\Session\Middleware\StartSession',
        'Illuminate\View\Middleware\ShareErrorsFromSession',
        'UnifySchool\Http\Middleware\BindContext'
        //
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => 'UnifySchool\Http\Middleware\Authenticate',
        'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
        'guest' => 'UnifySchool\Http\Middleware\RedirectIfAuthenticated',
        'guest.school' => 'UnifySchool\Http\Middleware\RedirectIfAuthenticatedSchool',
        'guest.student' => 'UnifySchool\Http\Middleware\RedirectIfAuthenticatedStudent',
        'guest.unify' => 'UnifySchool\Http\Middleware\RedirectIfAuthenticatedUnify',
        'csrf' => 'UnifySchool\Http\Middleware\VerifyCsrfToken',
        'auth.school' => 'UnifySchool\Http\Middleware\AuthenticateSchool',
        'auth.student' => 'UnifySchool\Http\Middleware\AuthenticateStudent',
        'auth.unify' => 'UnifySchool\Http\Middleware\AuthenticateUnify',
        'domain_access' => 'UnifySchool\Http\Middleware\DomainAccess',
    ];

}
