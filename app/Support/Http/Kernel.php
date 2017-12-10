<?php

namespace App\Support\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    public function bootstrap()
    {
        parent::bootstrap();

        if (config('app.debug')) {
            array_unshift($this->middleware, '\Clockwork\Support\Laravel\ClockworkMiddleware::class');
        }

        /* TODO Do we need this?
        if ($this->app['config']->get('app.throttle_api.enabled', true)) {
            $middleware_name = ThrottleRequests::class;
            $throttle_count = $this->app['config']->get('app.throttle_api.max_requests', 60);
            $throttle_minutes = $this->app['config']->get('app.throttle_api.decay_minutes', 1);

            $middleware = "$middleware_name:$throttle_count,$throttle_minutes";

            $groups = $this->app['config']->get('app.throttle_api.groups', ['api', 'oldapi', 'location', 'activate']);
            foreach ($groups as $group) {
                $this->router->prependMiddlewareToGroup($group, $middleware);
            }
        }*/
    }

    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];
}
