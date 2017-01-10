<?php

namespace ZeroServer\Teamspeak;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class TeamspeakServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
        public function boot(Router $router)
    {
        //$this->package('packages/zeroserver/teamspeak', null, __DIR__);
        $this->add_routes();
        $this->add_middleware($router);
        $this->add_views();
        $this->add_publications();
        $this->add_translations();
    }

   /**
     * Include the routes.
     */
    public function add_routes()
    {
        if (! $this->app->routesAreCached()) {
            include __DIR__ . '/Http/routes.php';
        }
    }
    /**
     * Include the middleware needed.
     *
     * @param $router
     */
    public function add_middleware($router)
    {
        // Authenticate checks that the token is valid
        // from an allowed IP address
        // $router->middleware('teamspeak.auth', ApiToken::class);
    }
    /**
     * Set the path and namespace for the views.
     */
    public function add_views()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'teamspeak');
    }
    /**
     * Set the paths for migrations and assets that
     * should be published to the main application.
     */
    public function add_publications()
    {
        $this->publishes([
            __DIR__ . '/database/migrations/' => database_path('migrations'),
        ]);
    }
    /**
     * Add the packages translation files.
     */
    public function add_translations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/lang', 'teamspeak');
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Merge the config with anything in the main app
        $this->mergeConfigFrom(
            __DIR__ . '/Config/teamspeak.config.php', 'teamspeak.config');
        // Include this packages menu items
        $this->mergeConfigFrom(
            __DIR__ . '/Config/package.sidebar.php', 'package.sidebar');
        $this->app->singleton('teamspeak', function ($app) {
            $username = urlencode(config('teamspeak.config.username'));
            $password = urlencode(config('teamspeak.config.password'));
            $server = urlencode(config('teamspeak.config.server'));
            $server_port = urlencode(config('teamspeak.config.server_port'));
            $server_query_port = urlencode(config('teamspeak.config.server_query_port'));
            $nickname = urlencode(config('teamspeak.config.nickname'));

            return \TSFramework\Teamspeak::factory("serverquery://$username:$password@$server:$server_query_port/?server_port=$server_port&nickname=$nickname");
        });
    }
}
