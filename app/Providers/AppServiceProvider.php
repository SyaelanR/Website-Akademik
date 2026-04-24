<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Mendefinisikan Gate untuk memeriksa apakah pengguna memiliki akses ke halaman pengaturan.
         * Hanya user dengan role 'admin' yang diizinkan.
         */
        Gate::define('view-guru', function (User $user) {
            return $user->role === 'guru';
            // return in_array($user->role, ['admin', 'editor']); //jika pengakses lebih dari satu
        });

        Gate::define('view-admin', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('view-siswa', function (User $user) {
            return $user->role === 'siswa';
        });

        Gate::define('view-adminDev', function (User $user) {
            return $user->role === 'adminDev';
        });
    }
}
