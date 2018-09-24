<?php

namespace App\Http\Middleware;

use App\User;
use Carbon\Carbon;
use Closure;
use Exception;

class ApiLogin
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
        if (!$request->api_token || !$this->CheckToken($request->api_token)) {
            return response(
                ['error' => 'access denied.'],
                404
            );
//            throw new Exception('access denied');
        }
        return $next($request);
    }

    /**
     * @param $apiToken
     * @return mixed
     */
    private function CheckToken($apiToken)
    {
        return User::where('api_token', $apiToken)
            ->first();
    }
}
