<?php

namespace VNCore\Horicon;

use App\User;
use Collective\Html\FormFacade as Form;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use VNCore\Horicon\Commands\InitCommand;
use VNCore\Horicon\Commands\InstallCommand;
use VNCore\Horicon\Commands\ReinitCommand;
use VNCore\Horicon\Middleware\CheckRole;
use VNCore\Horicon\Middleware\HoriconMiddleware;
use VNCore\Horicon\Models\SosContract;
use VNCore\Horicon\Models\SosContractLocation;
use VNCore\Horicon\Models\SosSupport;
use VNCore\Horicon\Models\SosUser;
use VNCore\Horicon\Observers\UserObserver;
use VNCore\Horicon\Policies\ModelPolicy;

class HoriconServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Router $router
     *
     * @return void
     */
    public function boot(Router $router)
    {
        // Create form components
        Form::component('flash', 'horicon::components.shared.flash', ['attributes' => []]);
        Form::component('errors', 'horicon::components.shared.errors', ['attributes' => []]);
        Form::component('field', 'horicon::components.form.init', ['type', 'label', 'name', 'attributes' => [], 'value']);
        Form::component('wysiwyg', 'horicon::components.shared.wysiwyg', ['attributes' => []]);

        // Custom the blade template
        Blade::if('role', function ($role) {
            return Auth::user()->hasRole($role);
        });

        // Writing Gates
        Gate::before(function ($user) {
            if ($user->hasRole('admin')) {
                return TRUE;
            }
        });
        Gate::policy(Model::class, ModelPolicy::class);

        // Load Observers
        User::observe(UserObserver::class);

        // Route Model Binding
        $router->model('sosUser', SosUser::class);
        $router->model('sosContract', SosContract::class);
        $router->model('sosContractLocation', SosContractLocation::class);
        $router->model('sosSupport', SosSupport::class);

        // Writing Middleware
        $router->aliasMiddleware('horicon', HoriconMiddleware::class);
        $router->aliasMiddleware('role', CheckRole::class);

        // Writing routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        // Load views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'horicon');

        // Init more commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                InitCommand::class,
                ReinitCommand::class,
            ]);
        }

        // Load another things
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        //$this->loadTranslationsFrom(__DIR__ . '/Translations', 'horicon');

        // Publish another things
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/horicon.php', 'horicon');
    }
}
