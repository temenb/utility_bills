<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $ds = DIRECTORY_SEPARATOR;
        $dir = scandir(dirname(__DIR__) . "{$ds}Models{$ds}Repositories");
        foreach ($dir as $file) {
            $nameEnd = strpos($file, 'Eloquent.php');
            if ($nameEnd){
                $name = substr($file, 0, $nameEnd);
                $interface = "App\\Models\\Repositories\\{$name}";
                $class = "App\\Models\\Repositories\\{$name}Eloquent";
                $this->app->bind($interface, $class);
            }
        }
    }
}
