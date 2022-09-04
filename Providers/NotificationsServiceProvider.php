<?php

namespace Modules\Notifications\Providers;


use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Modules\Base\Services\Components\Base\Lang;
use Modules\Base\Services\Components\Base\Share;
use Modules\Base\Services\Core\VILT;
use Modules\Notifications\Console\InstallNotifications;

require_once(__DIR__ . '/helpers.php');

class NotificationsServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Notifications';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'notifications';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));

        VILT::loadResources($this->moduleName);

        $this->commands([
            InstallNotifications::class
        ]);

        $path = str_replace("storage/", "", setting('google_firebase_config'));
        if($path){
            if(File::exists(storage_path('app/public/' . $path))) {
                $json = File::get(storage_path('app/public/' . $path));
                VILT::registerShareData(Share::make('fcm')->data([
                    "config" => json_decode($json),
                    "vapidKey" => setting('google_firebase_vapid')
                ]));
            }
        }

        VILT::registerTranslation(Lang::make('notifiactions_templates.sidebar')->label(__('Notifications Templates')));
        VILT::registerTranslation(Lang::make('user_notifications.sidebar')->label(__('Notifications')));
        VILT::registerTranslation(Lang::make('notifications_logs.sidebar')->label(__('Notifications Logs')));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'),
            $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
