<?php

namespace ZeroServer\Teamspeak;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use ZeroServer\Teamspeak\Http\Composers\TeamspeakMenu;
use ZeroServer\Teamspeak\Http\Composers\ConfigMenu;
use TSFramework\Teamspeak;


class TeamspeakServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
        public function boot(Router $router)
    {
        $this->add_routes();
        $this->add_middleware($router);
        $this->add_views();
        $this->add_view_composers();
        $this->add_publications();
        $this->add_translations();
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
//        $this->publishes([
//            __DIR__.'/Config/teamspeak.config.php' => config_path('teamspeak.config'),
//        ], 'config');
        //$this->package('Teamspeak', null, __DIR__);
        //$this->app->teamspeak->register('ts3');

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
    public function add_view_composers()
    {
        // Teamspeak menu composer
        $this->app['view']->composer([
            'teamspeak::includes.menu',
        ], TeamspeakMenu::class);
        
        $this->app['view']->composer([
            'teamspeak::admin.includes.menu',
        ], ConfigMenu::class);
    }
    public function add_publications()
    {
        $this->publishes([
            __DIR__ . '/resources/assets'     => public_path('teamspeak'),
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

    public function package()
    {


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
        $this->mergeConfigFrom(
            __DIR__ . '/Config/teamspeak.permissions.php', 'teamspeak.permissions');
        $this->mergeConfigFrom(
            __DIR__ . '/Config/teamspeak.locale.php', 'teamspeak.locale');

        // Menu Configurations
        $this->mergeConfigFrom(
            __DIR__ . '/Config/package.teamspeak.menu.php', 'package.teamspeak.menu');
        $this->mergeConfigFrom(
            __DIR__ . '/Config/package.admin.menu.php', 'package.admin.menu');

        // Include this packages menu items

        $this->app->singleton('teamspeak', function ($app) {
            $username = urlencode(config('teamspeak.config.username'));
            $password = urlencode(config('teamspeak.config.password'));
            $server = urlencode(config('teamspeak.config.server'));
            $server_port = urlencode(config('teamspeak.config.server_port'));
            $server_query_port = urlencode(config('teamspeak.config.server_query_port'));
            $nickname = urlencode(config('teamspeak.config.nickname'));

            $this->app->teamspeak = \TSFramework\Teamspeak::factory("serverquery://$username:$password@$server:$server_query_port/?server_port=$server_port&nickname=$nickname");
                return $this->app->teamspeak;

            //return \TSFramework\Teamspeak::factory("serverquery://$username:$password@$server:$server_query_port/?server_port=$server_port&nickname=$nickname");
        });

        //$loader = \Illuminate\Foundation\AliasLoader::getInstance();
        //$loader->alias('TSFramework', 'theomessin\ts-framework');
    }
}
