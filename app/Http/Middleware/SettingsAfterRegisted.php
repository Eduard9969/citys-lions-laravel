<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class SettingsAfterRegisted
{
    public function handle($request, Closure $next)
    {
        if (
            Auth::user()
            && !$request->session()->get('redirect_setting')
            && in_array($request->method(), ['GET'])
        ) {
            $user = Auth::user()->toArray();
            if (empty($user['first_name']) || empty($user['last_name']))
            {
                $request->session()->put('redirect_setting', true);
                $request->session()->put('without_password', true);

                return redirect(route('user.settings'));
            }
        }

        $request->session()->remove('redirect_setting');

        return $next($request);
    }
}
