<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
<<<<<<< HEAD
=======
use App\Contracts\SmsSender;
use App\Services\Sms\LogSmsSender;
use App\Services\Sms\NullSmsSender;
>>>>>>> 935db85 (ЛР9: сервисы, контейнер, почта, уведомления)

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
{
    $this->app->singleton(SmsSender::class, function () {
        return match (config('services.sms.driver')) {
            'log'   => new LogSmsSender(),
            default => new NullSmsSender(),
        };
    });
}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('pagination::bootstrap-4');
        Model::preventLazyLoading(! app()->isProduction());
        DB::enableQueryLog();
        Gate::define('admin-panel', fn (User $user) => in_array($user->role, ['admin', 'editor']));
    }
}
