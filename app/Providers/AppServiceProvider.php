<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::directive('svg', function ($arguments) {
            return "<?php echo \App\Support\SvgLoader::load($arguments); ?>";
        });
        \Blade::directive('heading', function ($arguments) {
            return '<div class="row section-heading"><div class="col-12 text-center"><h2>Join Our Discord</h2></div></div>';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
