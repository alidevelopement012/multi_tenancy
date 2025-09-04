<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Language;
use App\Models\User\SEO;
use Illuminate\Support\Carbon;
use App\Models\User\BasicExtra;
use App\Models\User\BasicSetting;
use App\Models\User\BasicExtended;
use App\Models\User\UserPermission;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\User\Menu as UserMenu;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use App\Http\Helpers\UserPermissionHelper;
use App\Models\User\Language as UserLanguage;
use App\Models\User\PageHeading;
use App\Models\User\Social as UserSocialMedia;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function changePreferences($userId)
    {
        //
    }

    public function getMenus($userMenu, $packagePermissions, $array)
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
