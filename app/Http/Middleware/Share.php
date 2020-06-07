<?php

namespace App\Http\Middleware;

use App\Settings;
use App\SocialMedias;
use Closure;
use Illuminate\Support\Facades\View;

class Share
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // SETTING VIEW
        $settings = Settings::where('id', 1)->first();
        View::share('settings', $settings);

        return $next($request);
    }
}
