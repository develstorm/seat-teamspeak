<?php

namespace ZeroServer\Teamspeak;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use ZeroServer\Teamspeak\Http\Composers\TeamspeakMenu;
use ZeroServer\Teamspeak\Http\Composers\ConfigMenu;
use ZeroServer\Teamspeak\Commands\TeamspeakLogsClear;
use ZeroServer\Teamspeak\Commands\TeamspeakUpdate;
use ZeroServer\Teamspeak\Commands\TeamspeakGroupsUpdate;
use TSFramework\Teamspeak;
use Seat\Services\Settings\Seat;


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
        $this->addCommands();
        $this->add_middleware($router);
        $this->add_views();
        $this->add_view_composers();
        $this->add_publications();
        $this->add_translations();
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

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

    public function addCommands()
    {
        $this->commands([
            TeamspeakUpdate::class,
            TeamspeakGroupsUpdate::class,
            TeamspeakLogsClear::class
        ]);
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
        $router->middleware('teamspeak.auth', ApiToken::class);
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
            __DIR__ . '/Config/teamspeak.permissions.php', 'web.permissions');
        $this->mergeConfigFrom(
            __DIR__ . '/Config/teamspeak.locale.php', 'teamspeak.locale');

        // Menu Configurations
        $this->mergeConfigFrom(
            __DIR__ . '/Config/package.teamspeak.menu.php', 'package.teamspeak.menu');
        $this->mergeConfigFrom(
            __DIR__ . '/Config/package.admin.menu.php', 'package.admin.menu');

        // Include this packages menu items

        $this->app->singleton('teamspeak', function ($app) {
            $username = Seat::get('teamspeak_username');
            $password = Seat::get('teamspeak_password');
            $server = Seat::get('teamspeak_hostname');
            $server_port = Seat::get('teamspeak_server_port');
            $server_query_port = Seat::get('teamspeak_server_query');
            $nickname = 'SeAT';

            $this->app->teamspeak = \TSFramework\Teamspeak::factory("serverquery://$username:$password@$server:$server_query_port/?server_port=$server_port&nickname=$nickname");
                return $this->app->teamspeak;

        });

    }
}
