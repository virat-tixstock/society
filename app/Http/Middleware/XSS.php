<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class XSS
{
    use \RachidLaasri\LaravelInstaller\Helpers\MigrationsHelper;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (\Auth::check()) {
            $lang = Cookie::get('lang');
            $language = !empty($lang) ? $lang : \Auth::user()->lang;
            \App::setLocale($language);

            $timezone = getSettingsValByName('timezone');
            \Config::set('app.timezone', $timezone);

            if (\Auth::user()->type == 'super admin') {
                $directoryMigrations             = $this->getMigrations();
                $databaseMigrations           = $this->getExecutedMigrations();
                $total = count($directoryMigrations) - count($databaseMigrations);
                if ($total > 0) {
                    return redirect()->route('LaravelUpdater::welcome');
                }
            }
        }

        $data = $request->all();
        array_walk_recursive(
            $data,
            function (&$data) {
                // $data = strip_tags($data);
            }
        );
        $request->merge($data);
        return $next($request);
    }
}
